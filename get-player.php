<?php
/**
 * Created by PhpStorm.
 * User: Coty-Saxman
 * Date: 7/6/2015
 * Time: 2:33 PM
 */
header('Access-Control-Allow-Origin: *');

$playerData = array();

$id = $_GET['id'];

$req = file_get_contents('http://www.ourlads.com/nfldepthcharts/player/' . $id);
$req = substr($req, strpos($req, '<span id="lNumber" class="pt_') + 29);

$team = substr($req, 0, strpos($req, '"'));
$playerData['Team'] = $team;

$teamSpotrac = "";
switch($team) {
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

$numChunk = substr($req, 0, strpos($req, '</span>'));
$num = filter_var($numChunk, FILTER_SANITIZE_NUMBER_INT);
$playerData['Number'] = $num;

$req = substr($req, strpos($req, '</span><span id="lPlayer" class="') + 33);
$name = substr($req, strpos($req, '>') + 1, (strpos($req, '<') - strpos($req, '>')) - 1);
$playerData['Name'] = $name;

$nameSpotrac = $name;
switch($nameSpotrac) {
    case "Carey Spear":
        $nameSpotrac = "casey-spear";
        break;
    case "K'Waun Williams":
        $nameSpotrac = "kwuan-williams";
        break;
    default:
        $firstName = substr($nameSpotrac, 0, strpos($nameSpotrac, ' '));
        if ($firstName == strtoupper($firstName)) { //all caps
            $dottedFirstName = $firstName[0].'.'.$firstName[1].'.';
            $nameSpotrac = str_replace($firstName, $dottedFirstName, $nameSpotrac);
        }
        $nameSpotrac = strtolower($nameSpotrac);
        $nameSpotrac = str_replace("'", "", $nameSpotrac);
        $nameSpotrac = str_replace(" ", "-", $nameSpotrac);
        break;
}
$playerSpotrac = 'http://www.spotrac.com/nfl/'.$teamSpotrac.'/'.$nameSpotrac.'/';
$playerData['Spotrac URL'] = $playerSpotrac;

$req = substr($req, strpos($req, '<span id="lPos">') + 16);
$pos = substr($req, 0, strpos($req, ' '));
$playerData['Position'] = $pos;

$req = substr($req, strpos($req, 'id="lCollege"'));
$req = substr($req, strpos($req, '><b>') + 4);
$college = substr($req, 0, strpos($req, '<'));
$playerData['College'] = $college;

$req = substr($req, strpos($req, 'id="lHeight"'));
$req = substr($req, strpos($req, '><b>') + 4);
$height = substr($req, 0, strpos($req, ' '));
$playerData['Height'] = $height;

$req = substr($req, strpos($req, 'id="lWt"'));
$req = substr($req, strpos($req, '><b>') + 4);
$weight = substr($req, 0, strpos($req, '<'));
$playerData['Weight'] = $weight;

$req = substr($req, strpos($req, 'id="lDOB"'));
$req = substr($req, strpos($req, '><b>') + 4);
$dob = substr($req, 0, strpos($req, '<'));
$playerData['DOB'] = $dob;

$req = substr($req, strpos($req, 'id="lAge"'));
$req = substr($req, strpos($req, '><b>') + 4);
$age = substr($req, 0, strpos($req, '<'));
$playerData['Age'] = $age;

$req = substr($req, strpos($req, 'id="lOrigTeam"'));
$req = substr($req, strpos($req, '><b>') + 4);
$origTeam = substr($req, 0, strpos($req, '<'));
$playerData['Original Team'] = $origTeam;

$req = substr($req, strpos($req, 'id="lNFLEntry"'));
$req = substr($req, strpos($req, '><b>') + 4);
$nflEntry = substr($req, 0, strpos($req, '<'));
$playerData['NFL Entry'] = $nflEntry;

$req = substr($req, strpos($req, 'id="lNFLExp"'));
$req = substr($req, strpos($req, '><b>') + 4);
$nflExp = substr($req, 0, strpos($req, '<'));
$playerData['NFL Exp'] = $nflExp;

$req = substr($req, strpos($req, 'id="lKey"'));
$req = substr($req, strpos($req, '><b>') + 4);
$key = substr($req, 0, strpos($req, '<'));
$playerData['Depth Chart Key'] = $key;

$req = substr($req, strpos($req, 'id="lStatus"'));
$req = substr($req, strpos($req, '><b>') + 4);
$status = substr($req, 0, strpos($req, '<'));
$playerData['Status'] = $status;

//SPOTRAC PARSING

$req = file_get_contents($playerSpotrac);

$franchiseStr = 'title="Franchise">$';
if(strpos($req, $franchiseStr) == FALSE) {
    $suspendedString = ' option-reserve-suspended"><span class=" info" title="Reserve Suspended"';
    $suspendedNewStr = '"><span class=" info" ';
    $req = str_replace($suspendedString, $suspendedNewStr, $req);
    $curSalStr = '<td class="salaryAmt result current-year "><span class=" info" >$';
    $req = substr($req, strpos($req, $curSalStr) + strlen($curSalStr));
    $currentSalary = substr($req, 0, strpos($req, '<'));
    $currentSalary = str_replace(',', '', $currentSalary);
    $playerData['Current Salary'] = $currentSalary;

    if(strpos($req, '<td class="salaryAmt dead current-year "><span class=" info" title=">-</span></td>') == FALSE) {
        $deadMoneyStr = 'Post June 1: $';
        $req = substr($req, strpos($req, $deadMoneyStr) + strlen($deadMoneyStr));
        $deadMoneyJ = substr($req, 0, strpos($req, '"'));
        $deadMoneyJ = str_replace(',', '', $deadMoneyJ);
        $playerData['June 1st Dead Money'] = $deadMoneyJ;

        $req = substr($req, strpos($req, '$') + 1);
        $deadMoneyT = substr($req, 0, strpos($req, '<'));
        $deadMoneyT = str_replace(',', '', $deadMoneyT);
        $playerData['Total Dead Money'] = $deadMoneyT;
        $playerData['Future Dead Money'] = $deadMoneyT - $deadMoneyJ;
    } else {
        $playerData['June 1st Dead Money'] = 0;
        $playerData['Total Dead Money'] = 0;
        $playerData['Future Dead Money'] = 0;
    }
} else {
    $req = substr($req, strpos($req, $franchiseStr) + strlen($franchiseStr));
    $currentSalary = substr($req, 0, strpos($req, '</span>'));
    $currentSalary = str_replace(',', '', $currentSalary);
    $playerData['Current Salary'] = $currentSalary;
    $playerData['June 1st Dead Money'] = 0;
    $playerData['Total Dead Money'] = 0;
    $playerData['Future Dead Money'] = 0;
}


$output = array($id => $playerData);
$outputJSON = json_encode($output);

print_r($output);

$url = 'https://boiling-fire-929.firebaseio.com/roster-builder/players/.json?x-http-method-override=PATCH';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $outputJSON);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($outputJSON))
);
$api_response = curl_exec($ch);

echo $api_response;


?>
