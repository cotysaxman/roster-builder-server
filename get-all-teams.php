<?php
/**
 * Created by PhpStorm.
 * User: Coty-Saxman
 * Date: 7/9/2015
 * Time: 6:05 PM
 */

$teams = array('ARZ', 'ATL', 'BAL', 'BUF',
               'CAR', 'CHI', 'CIN', 'CLE',
               'DAL', 'DEN', 'DET', 'GB',
               'HOU', 'IND', 'JAX', 'KC',
               'MIA', 'MIN', 'NE',  'NO',
               'NYG', 'NYJ', 'OAK', 'PHI',
               'PIT', 'SD',  'SF',  'SEA',
               'STL', 'TB',  'TEN', 'WAS');

foreach($teams as $t) {
    $url = 'http://nflrosterbuilder.byethost7.com/get-roster.php?team='.$t;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $api_response = curl_exec($ch);
    curl_close($ch);

    echo $api_response;
}

?>