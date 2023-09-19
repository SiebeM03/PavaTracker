<?php

namespace App\Helpers;

use App\Exceptions\ApiException;
use App\Models\ClanLabel;
use Storage;

class LabelsAPI extends API
{
    /**
     * <p>Save all possible clan labels to database </p>
     * <p>Used in {@link /database/migrations/2023_09_12_214441_create_clan_labels_table.php}'s up() function</p>
     * @return array $data
     * @throws ApiException
     */
    public static function saveClanLabels(): array
    {
        $url = "https://api.clashofclans.com/v1/labels/clans";
        $data = self::apiCall($url);
        if (isset($data["reason"])) {
            return $data;
        }

        foreach ($data["items"] as $label) {
            ClanLabel::updateOrCreate([
                'id' => $label["id"],
                'name' => $label["name"],
                'url_s' => $label["iconUrls"]["small"],
                'url_m' => $label["iconUrls"]["medium"],
            ]);
        }
        return $data;
    }


    public static function saveThIcons()
    {
        $thIcons = [
            'th1' => 'https://static.wikia.nocookie.net/clashofclans/images/f/fd/Town_Hall1.png/revision/latest/scale-to-width-down/100?cb=20170827034930',
            'th2' => 'https://static.wikia.nocookie.net/clashofclans/images/7/7d/Town_Hall2.png/revision/latest/scale-to-width-down/100?cb=20170827050036',
            'th3' => 'https://static.wikia.nocookie.net/clashofclans/images/d/dd/Town_Hall3.png/revision/latest/scale-to-width-down/100?cb=20170827050050',
            'th4' => 'https://static.wikia.nocookie.net/clashofclans/images/e/e7/Town_Hall4.png/revision/latest/scale-to-width-down/100?cb=20170827050104',
            'th5' => 'https://static.wikia.nocookie.net/clashofclans/images/a/a3/Town_Hall5.png/revision/latest/scale-to-width-down/100?cb=20170827050118',
            'th6' => 'https://static.wikia.nocookie.net/clashofclans/images/5/52/Town_Hall6.png/revision/latest/scale-to-width-down/100?cb=20170827050220',
            'th7' => 'https://static.wikia.nocookie.net/clashofclans/images/7/75/Town_Hall7.png/revision/latest/scale-to-width-down/100?cb=20170827051024',
            'th8' => 'https://static.wikia.nocookie.net/clashofclans/images/f/fa/Town_Hall8.png/revision/latest/scale-to-width-down/100?cb=20170827051039',
            'th9' => 'https://static.wikia.nocookie.net/clashofclans/images/e/e0/Town_Hall9.png/revision/latest/scale-to-width-down/100?cb=20170827045259',
            'th10' => 'https://static.wikia.nocookie.net/clashofclans/images/5/5c/Town_Hall10.png/revision/latest/scale-to-width-down/110?cb=20170827040043',
            'th11' => 'https://static.wikia.nocookie.net/clashofclans/images/9/96/Town_Hall11.png/revision/latest/scale-to-width-down/105?cb=20210410001514',
            'th12' => 'https://static.wikia.nocookie.net/clashofclans/images/7/7c/Town_Hall12-5.png/revision/latest/scale-to-width-down/110?cb=20180603203336',
            'th13' => 'https://static.wikia.nocookie.net/clashofclans/images/1/10/Town_Hall13-5.png/revision/latest/scale-to-width-down/120?cb=20200831024428',
            'th14' => 'https://static.wikia.nocookie.net/clashofclans/images/1/1c/Town_Hall14-5.png/revision/latest/scale-to-width-down/110?cb=20210413000854',
            'th15' => 'https://static.wikia.nocookie.net/clashofclans/images/e/e6/Town_Hall15-5.png/revision/latest/scale-to-width-down/115?cb=20221120065456',
        ];


        foreach ($thIcons as $th) {
            Storage::put("/public/th_icons/" . array_search($th, $thIcons) . ".png", file_get_contents(value($th)));
        }
    }

}