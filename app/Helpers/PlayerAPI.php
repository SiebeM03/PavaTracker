<?php

namespace App\Helpers;

use App\Exceptions\ApiException;
use App\Models\Clan;
use App\Models\Player;

class PlayerAPI extends API
{
    /**<p>Returns a Clan object with given <i>$clanTag</i></p>
     * @param string $playerTag
     * @return Player
     * @throws ApiException
     */
    public static function getPlayerByTag(string $playerTag): Player
    {
        $foundPlayer = Player::where('tag', $playerTag)->first();
        if (!isset($playerTag)) {
            try {
                $foundPlayer = self::savePlayerInfo($playerTag);
            } catch (ApiException $e) {
            }
        }
        return $foundPlayer;
    }

    /**
     * @param Player $player <p>Player object for which the clan is requested</p>
     * @return Clan|null null if not in clan
     */
    public static function getPlayerClan(Player $player): ?Clan
    {
        $url = "https://api.clashofclans.com/v1/players/" . urlencode($player->tag);
        try {
            $data = self::apiCall($url);
            if (isset($data['clan'])) {
                return ClanAPI::getClanByTag($data['clan']['tag']);
            }
            return null;    // player has no clan
        } catch (ApiException $exception) {
            dump($exception);
            return null;
        }
    }

    /**
     * <p>Requests data from the API if $data is not given <br/> Create/update all actual clan members (found by API) <br/> Update <i>clan_id</i> for all members in database that are not in given clan anymore</p>
     * @param Clan $clan Clan object for which members should be created/updated
     * @param array|null $data Json data from API
     * @return array $data
     * @throws ApiException
     */
    public static function saveClanMembersInfo(Clan $clan, array $data = null): array
    {
        if (!$data) {
            $url = "https://api.clashofclans.com/v1/clans/" . urlencode($clan->tag) . "/members";
            $data = self::apiCall($url);
        }

        // Update all clan members found in database (they probably left clan)
        $currentMemberTags = array_column($data["items"], 'tag');   // get all actual member tags from API
        $databaseMembers = Player::where('clan_id', $clan->id)->get(); // get all members from database
        foreach ($databaseMembers as $databaseMember) {
            // if $databaseMember is not in $currentMemberTags the must have left the clan -> update their clan_id
            if (!in_array($databaseMember->tag, $currentMemberTags)) {
                $player = self::savePlayerInfo($databaseMember->tag);
                $databaseMember->update([
                    'clan_id' => ($player->clan_id ?? null),
                ]);
            }
        }

        // Update all clan members found with API
        foreach ($data["items"] as $member) {
            Player::updateOrCreate(
                [
                    'tag' => $member['tag'],
                ],
                [
                    'clan_id' => $clan->id,
                    'name' => $member['name'],
                    'role' => $member['role'] == 'admin' ? 'elder' : $member['role'],
                    'trophies' => $member['trophies'],
                    'versus_trophies' => $member['versusTrophies'],
                    'donations' => $member['donations'],
                    'donations_received' => $member['donationsReceived'],
                ]
            );
        }

        return $data;
    }

    /**
     * @param string $playerTag
     * @return Player
     * @throws ApiException
     */
    public static function savePlayerInfo(string $playerTag, $data = null): Player
    {
        if ($data == null) {
            $url = 'https://api.clashofclans.com/v1/players/' . urlencode($playerTag);
            $data = self::apiCall($url);
        }
        return Player::updateOrCreate(
            [
                'tag' => $data["tag"],
            ],
            [
                'clan_id' => (isset($data['clan']) ? ClanAPI::getClanByTag($data['clan']['tag'])->id : null),
                'name' => $data['name'],
                'town_hall' => $data['townHallLevel'] . (isset($data['townHallWeaponLevel']) ? '_' . $data['townHallWeaponLevel'] : ''),
                //'role' => $data['role'] == 'admin' ? 'elder' : $data['role'],
                'role' => (isset($data['role']) ? ($data['role'] == 'admin' ? 'elder' : $data['role']) : null),
                'trophies' => $data['trophies'],
                'versus_trophies' => $data['versusTrophies'],
                'donations' => $data['donations'],
                'donations_received' => $data['donationsReceived'],
            ]
        );
    }

    /**
     * @param string $playerTag
     * @param string $apiToken
     * @return string
     * @throws ApiException
     */
    public static function validateApiToken(string $playerTag, string $apiToken): string
    {
        $url = 'https://api.clashofclans.com/v1/players/' . urlencode($playerTag) . '/verifytoken';

        $data = self::apiCall($url, true, ['apiToken' => ['token' => $apiToken]]);
        return $data['status'];
    }

    /**
     * @param $playerTag
     * @param $userId
     * @return Player
     * @throws ApiException
     */
    public static function updateUserId($playerTag, $userId): Player
    {
        $player = self::savePlayerInfo($playerTag);
        $player->update(['user_id' => $userId]);
        return $player;
    }


    public static function getClanGamePoints(string $playerTag)
    {
        $url = 'https://api.clashofclans.com/v1/players/' . urlencode($playerTag);
        $data = self::apiCall($url);
        $player = self::savePlayerInfo($playerTag, $data);
        $achievements = collect($data['achievements']);

        $clanGamesAchievement = $achievements->first(function ($achievement) {
            return $achievement['name'] === 'Games Champion';
        });

        return $clanGamesAchievement['value'];
    }
}
