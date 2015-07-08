<?php
/**
 * Created by PhpStorm.
 * User: Coty-Saxman
 * Date: 7/6/2015
 * Time: 4:09 PM
 */
header('Access-Control-Allow-Origin: *');

$teamName = $_GET['team'];
//Get the whole page
$req = file_get_contents('http://www.ourlads.com/nfldepthcharts/alpharoster/'.$teamName);

$req = substr($req, strpos($req, 'Active Players'));
$req = substr($req, 0, strpos($req, '</table>'));

$tempIds = explode('javascript:return sp(', $req);

$roster = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xId = substr($x, 0, strpos($x, ')'));
        array_push($roster, $xId);
    }
}

$teamSpotrac = "";
switch($teamName) {
    case "ARZ":
        $teamSpotrac = "arizona-cardinals";
        break;
    case "ATL":
        $teamSpotrac = "atlanta-falcons";
        break;
    case "BAL":
        $teamSpotrac = "baltimore-ravens";
        break;
    case "BUF":
        $teamSpotrac = "buffalo-bills";
        break;
    case "CAR":
        $teamSpotrac = "carolina-panthers";
        break;
    case "CHI":
        $teamSpotrac = "chicago-bears";
        break;
    case "CIN":
        $teamSpotrac = "cincinnati-bengals";
        break;
    case "CLE":
        $teamSpotrac = "cleveland-browns";
        break;
    case "DAL":
        $teamSpotrac = "dallas-cowboys";
        break;
    case "DEN":
        $teamSpotrac = "denver-broncos";
        break;
    case "DET":
        $teamSpotrac = "detroit-lions";
        break;
    case "GB":
        $teamSpotrac = "green-bay-packers";
        break;
    case "HOU":
        $teamSpotrac = "houston-texans";
        break;
    case "IND":
        $teamSpotrac = "indianapolis-colts";
        break;
    case "JAX":
        $teamSpotrac = "jacksonville-jaguars";
        break;
    case "KC":
        $teamSpotrac = "kansas-city-chiefs";
        break;
    case "MIA":
        $teamSpotrac = "miami-dolphins";
        break;
    case "MIN":
        $teamSpotrac = "minnesota-vikings";
        break;
    case "NE":
        $teamSpotrac = "new-england-patriots";
        break;
    case "NO":
        $teamSpotrac = "new-orleans-saints";
        break;
    case "NYG":
        $teamSpotrac = "new-york-giants";
        break;
    case "NYJ":
        $teamSpotrac = "new-york-jets";
        break;
    case "OAK":
        $teamSpotrac = "oakland-raiders";
        break;
    case "PHI":
        $teamSpotrac = "philadelphia-eagles";
        break;
    case "PIT":
        $teamSpotrac = "pittsburgh-steelers";
        break;
    case "SD":
        $teamSpotrac = "san-diego-chargers";
        break;
    case "SF":
        $teamSpotrac = "san-francisco-49ers";
        break;
    case "SEA":
        $teamSpotrac = "seattle-seahawks";
        break;
    case "STL":
        $teamSpotrac = "st.-louis-rams";
        break;
    case "TB":
        $teamSpotrac = "tampa-bay-buccaneers";
        break;
    case "TEN":
        $teamSpotrac = "tennessee-titans";
        break;
    case "WAS":
        $teamSpotrac = "washington-redskins";
        break;
}
$teamSpotracURL = 'http://www.spotrac.com/nfl/'.$teamSpotrac.'/';

$st = file_get_contents($teamSpotracURL);
$deadCapStr = 'Dead Cap:</span></span>';
$st = substr($st, strpos($st, $deadCapStr) + strlen($deadCapStr));
$start = strpos($st, '$') + 1;
$end = strpos($st, '</a>');
$st = substr($st, $start, $end - $start);
$st = str_replace(',', '', $st);


$roster = array("roster" => $roster);
$roster['Dead Money'] = $st;

$rosterJSON = json_encode($roster);



$url = 'https://boiling-fire-929.firebaseio.com/roster-builder/'.$teamName.'.json?x-http-method-override=PATCH';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $rosterJSON);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($rosterJSON))
);
$api_response = curl_exec($ch);

echo $api_response;
?>