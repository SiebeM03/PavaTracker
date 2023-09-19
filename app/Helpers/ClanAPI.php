<?php

namespace App\Helpers;

use App\Exceptions\ApiException;
use App\Models\Clan;

class ClanAPI extends API
{
    /**<p>Returns a Clan object with given <i>$clanTag</i></p>
     * @param string $clanTag
     * @return Clan
     * @throws ApiException
     */
    public static function getClanByTag(string $clanTag): Clan
    {
        $foundClan = Clan::where('tag', $clanTag)->first();
        if (!isset($foundClan)) {
            $foundClan = self::saveClanInfo($clanTag);
        }
        return $foundClan;
    }

    /**
     * <p>Requests data from the API <br/> Creates or updates the clan in our database <br/> Returns <i>$data</i> received from the API </p>
     * @param string $clanTag
     * @return Clan
     * @throws ApiException
     */
    public static function saveClanInfo(string $clanTag): Clan
    {
        $url = "https://api.clashofclans.com/v1/clans/" . urlencode($clanTag);
        $data = self::apiCall($url);

        return Clan::updateOrCreate(
            [
                'tag' => $data["tag"],
            ],
            [
                'name' => $data["name"],
                'description' => $data["description"],
                'badge_url_m' => $data["badgeUrls"]["medium"],
                'type' => $data["type"],
                'public_war_log' => $data["isWarLogPublic"],
                'war_wins' => $data["warWins"],
                'war_ties' => ( $data["warTies"] ?? null),
                'war_losses' => ($data["warLosses"] ?? null),
                'war_win_streak' => $data["warWinStreak"],
            ]);
    }
}
