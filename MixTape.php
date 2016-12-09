<?php

namespace codazoda\music;

class MixTape
{

    /**
     * Pick a random year for the decade and a random song from that list.
     *
     * @param  String $decade  A decade to pick from such as 1980, 1990, 2000.
     * @param  String $list    A Billboard list such as 'hot-100' or 'r-b-hip-hop-songs'
     * @return Array           An array for this pick including the url, random pick number we selected, and song title.
     */
    public function randomPick($decade, $list = 'hot-100')
    {
        // $decade must be 4 digits
        $shortDecade = substr($decade, 0, 3);
        $year = $shortDecade . mt_rand(0, 9);
        $currentYear = date('Y');
        if ($year > $currentYear) {
            $year = $currentYear;
        }
        $archiveUrl = "http://www.billboard.com/archive/charts/{$year}/{$list}";
        $song = $this->getSong($archiveUrl);
        // Trim and decode the returned song
        $song['song'] = html_entity_decode(trim($song['song']));
        // Write
        $pick = array(
            'url' => $archiveUrl,
            'pick' => $song['pick'],
            'song' => $song['song']
        );
        return $pick;
    }

    /**
     * Get a random song from a billboard archive URL
     *
     * @param  String $url  The URL to fetch the list of songs from
     * @return Array        An array containing the song and the random pick number we selected
     */
    private function getSong($url)
    {
        $page = file_get_contents($url);
        $matches = array();
        //<td class="views-field views-field-field-chart-item-song" rowspan="3">
        //Hello
        //</td>
        preg_match_all('/<td class="views-field views-field-field-chart-item-song" ( rowspan="[0-9][0-9]?")*>(.*?)<\/td>/is', $page, $matches);
        
        $songCount = count($matches[2]);
        $pick = mt_rand(1, $songCount-1);
        $song = $matches[2][$pick];

        return array(
            'pick' => $pick,
            'song' => $song
        );
    }
}
