<?php

namespace codazoda\music;

class MixTape
{

    /**
     * Pick 16 songs from years that I like for a personal mix tape.
     *
     * @return Array  An array of 15 picks including the url, random pick number we selected, and the song title.
     */
    public function getPicks()
    {
        // Gather a bunch of picks from certain years
        $picks = array(
            $this->randomPick('1980'),
            $this->randomPick('1980'),
            $this->randomPick('1980'),
            $this->randomPick('1990'),
            $this->randomPick('1990'),
            $this->randomPick('1990'),
            $this->randomPick('2000'),
            $this->randomPick('2000'),
            $this->randomPick('2000'),
            $this->randomPick('2010'),
            $this->randomPick('2010'),
            $this->randomPick('2010'),
            $this->randomPick('1980'),
            $this->randomPick('1990'),
            $this->randomPick('2000'),
            $this->randomPick('2010')
        );
        shuffle($picks);
        return $picks;
    }

    /**
     * Pick a random year for the decade and a random song from that list.
     *
     * @param  String $decade  A decade to pick from such as 1980, 1990, 2000.
     * @return Array           An array for this pick including the url, random pick number we selected, and song title.
     */
    public function randomPick($decade)
    {
        // $decade must be 4 digits
        $shortDecade = substr($decade, 0, 3);
        $year = $shortDecade . mt_rand(0, 9);
        $currentYear = date('Y');
        if ($year > $currentYear) {
            $year = $currentYear;
        }
        $archiveUrl = "http://www.billboard.com/archive/charts/{$year}/hot-100";
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
