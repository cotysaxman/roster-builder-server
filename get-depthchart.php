<?php
/**
 * Created by PhpStorm.
 * User: Coty-Saxman
 * Date: 7/6/2015
 * Time: 2:17 PM
 */
header('Access-Control-Allow-Origin: *');

$teamName = $_GET['team'];
//Get the whole page
$req = file_get_contents('http://www.ourlads.com/nfldepthcharts/depthchart/'.$teamName);

//Parse coaching data
$coachTemp = explode('<div id="tcoach">', $req);
$coachRaw = explode('</div>', $coachTemp[1]);
$coachCells = explode('<td>', $coachRaw[0]);
$hcTemp = explode('<b>', $coachCells[2]);
$hcTemp2 = explode('</b>', $hcTemp[1]);
$hc = $hcTemp2[0];
$ocTemp = explode('<b>', $coachCells[4]);
$ocTemp2 = explode('</b>', $ocTemp[1]);
$oc = $ocTemp2[0];
$dcTemp = explode('<b>', $coachCells[6]);
$dcTemp2 = explode('</b>', $dcTemp[1]);
$dc = $dcTemp2[0];
$stTemp = explode('<b>', $coachCells[8]);
$stTemp2 = explode('</b>', $stTemp[1]);
$st = $stTemp2[0];
$coachOut = array("coaches" => array("HC" => $hc, "OC" => $oc, "DC" => $dc, "ST" => $st));
$coachOut = json_encode($coachOut);

$url = 'https://boiling-fire-929.firebaseio.com/roster-builder/'.$teamName.'.json?x-http-method-override=PATCH';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $coachOut);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($coachOut))
);
$api_response = curl_exec($ch);

//Parse player data
$playTemp = explode('<table cellspacing="0" cellpadding="2" rules="all" border="1" id="gvChart">', $req);
$play = explode('</table>', $playTemp[1]);
$play = $play[0];
//explode strings
$p0  = '<b>LWR  </b>';
$p1  = '<b>RWR  </b>';
$p2  = '<b>LT   </b>';
$p3  = '<b>LG   </b>';
$p4  = '<b>C    </b>';
$p5  = '<b>RG   </b>';
$p6  = '<b>RT   </b>';
$p7  = '<b>TE   </b>';
$p8  = '<b>QB   </b>';
$p9  = '<b>RB   </b>';
$p10 = '<b>FB   </b>';
$p11 = '<b>LDE  </b>';
$p12 = '<b>LDT  </b>';
$p13 = '<b>RDT  </b>';
$p14 = '<b>RDE  </b>';
$p15 = '<b>SLB  </b>';
$p16 = '<b>MLB  </b>';
$p17 = '<b>WLB  </b>';
$p18 = '<b>LCB  </b>';
$p19 = '<b>FS   </b>';
$p20 = '<b>SS   </b>';
$p21 = '<b>RCB  </b>';
$p22 = '<b>P    </b>';
$p23 = '<b>PK   </b>';
$p24 = '<b>LS   </b>';
$p25 = '<b>H    </b>';
$p26 = '<b>PR   </b>';
$p27 = '<b>KR   </b>';
$p28 = '<b>SUS  </b>';
$p29 = '<b>RET  </b>';
$p30 = 'javascript:return sp(0);';

$depthChart = array();

//split end
$play = substr($play, strpos($play, $p0));
$temp = explode($p1, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LWR"] = $tempArray;
unset($tempArray);
//flanker
$play = substr($play, strpos($play, $p1));
$temp = explode($p2, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RWR"] = $tempArray;
unset($tempArray);
//left tackle
$play = substr($play, strpos($play, $p2));
$temp = explode($p3, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LT"] = $tempArray;
unset($tempArray);
//left guard
$play = substr($play, strpos($play, $p3));
$temp = explode($p4, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LG"] = $tempArray;
unset($tempArray);
//center
$play = substr($play, strpos($play, $p4));
$temp = explode($p5, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["C"] = $tempArray;
unset($tempArray);
//right guard
$play = substr($play, strpos($play, $p5));
$temp = explode($p6, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RG"] = $tempArray;
unset($tempArray);
//right tackle
$play = substr($play, strpos($play, $p6));
$temp = explode($p7, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RT"] = $tempArray;
unset($tempArray);
//inline tight end
$play = substr($play, strpos($play, $p7));
$temp = explode($p7, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["TE"] = $tempArray;
unset($tempArray);
//move tight end
$play = substr($play, strpos($play, $p7));
$temp = explode($p8, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["TE2"] = $tempArray;
unset($tempArray);
//quarterback
$play = substr($play, strpos($play, $p8));
$temp = explode($p9, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["QB"] = $tempArray;
unset($tempArray);
//running back
$play = substr($play, strpos($play, $p9));
$temp = explode($p10, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RB"] = $tempArray;
unset($tempArray);
//fullback
$play = substr($play, strpos($play, $p10));
$temp = explode($p11, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["FB"] = $tempArray;
unset($tempArray);

//left defensive end
$play = substr($play, strpos($play, $p11));
$temp = explode($p12, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LDE"] = $tempArray;
unset($tempArray);
//left defensive tackle
$play = substr($play, strpos($play, $p12));
$temp = explode($p13, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LDT"] = $tempArray;
unset($tempArray);
//right defensive tackle
$play = substr($play, strpos($play, $p13));
$temp = explode($p14, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RDT"] = $tempArray;
unset($tempArray);
//right defensive end
$play = substr($play, strpos($play, $p14));
$temp = explode($p15, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RDE"] = $tempArray;
unset($tempArray);
//SAM
$play = substr($play, strpos($play, $p15));
$temp = explode($p16, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["SAM"] = $tempArray;
unset($tempArray);
//MIKE=
$play = substr($play, strpos($play, $p16));
$temp = explode($p17, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["MIKE"] = $tempArray;
unset($tempArray);
//WILL
$play = substr($play, strpos($play, $p17));
$temp = explode($p18, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["WILL"] = $tempArray;
unset($tempArray);
//left corner
$play = substr($play, strpos($play, $p18));
$temp = explode($p19, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LCB"] = $tempArray;
unset($tempArray);
//free safety
$play = substr($play, strpos($play, $p19));
$temp = explode($p20, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["FS"] = $tempArray;
unset($tempArray);
//strong safety
$play = substr($play, strpos($play, $p20));
$temp = explode($p21, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["SS"] = $tempArray;
unset($tempArray);
//right corner
$play = substr($play, strpos($play, $p21));
$temp = explode($p22, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RCB"] = $tempArray;
unset($tempArray);
//punter
$play = substr($play, strpos($play, $p22));
$temp = explode($p23, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["P"] = $tempArray;
unset($tempArray);
//kicker
$play = substr($play, strpos($play, $p23));
$temp = explode($p24, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["K"] = $tempArray;
unset($tempArray);
//long snapper
$play = substr($play, strpos($play, $p24));
$temp = explode($p25, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["LS"] = $tempArray;
unset($tempArray);
//holder=
$play = substr($play, strpos($play, $p25));
$temp = explode($p26, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["H"] = $tempArray;
unset($tempArray);
//punt returner
$play = substr($play, strpos($play, $p26));
$temp = explode($p27, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["PR"] = $tempArray;
unset($tempArray);
//kick returner
$play = substr($play, strpos($play, $p27));
$temp = explode($p28, $play);
$tempIds = explode('javascript:return sp(', $temp[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["KR"] = $tempArray;
unset($tempArray);
//suspended
$temp1 = substr($play, strpos($play, $p28));
$temp2 = explode($p30, $temp1);
$tempIds = explode('javascript:return sp(', $temp2[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["SUS"] = $tempArray;
unset($tempArray);
//retired
$temp1 = substr($play, strpos($play, $p29));
$temp2 = explode($p30, $temp1);
$tempIds = explode('javascript:return sp(', $temp2[0]);
$tempArray = array();
foreach ($tempIds as $x){
    if(strpos($x, ')') > 1) {
        $xIdT = explode(')', $x);
        $xId = $xIdT[0];
        array_push($tempArray, $xId);
    }
}
$depthChart["RET"] = $tempArray;
unset($tempArray);

$outDepthChart = array("depth-chart" => $depthChart);
$outDepthChart = json_encode($outDepthChart);

$url = 'https://boiling-fire-929.firebaseio.com/roster-builder/'.$teamName.'.json?x-http-method-override=PATCH';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $outDepthChart);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($outDepthChart))
);
$api_response = curl_exec($ch);

echo $api_response;
?>