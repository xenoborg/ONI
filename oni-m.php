<?php

require_once("functions.php");
include('Spyc.php');

$connection = connect_db(host, id, pwd, db);

$referer = $_SERVER['HTTP_REFERER'];
$action = clean_strings($connection, $_POST["action"]);

if ($action == "save") {
    
$squaresUsed = $_POST["squares"];
$temperatureType = $_POST["temptype"];
$buildings = array();
$otherEntities = array();
    

//print_r($squaresUsed);    
    
//function method1($a,$b) 
 // {
   // return ($a <= $b) ? -1 : 1;
  //}
  
    
$locationX = array();
$locationY = array();
$locationX2 = array();
$locationY2 = array();
    
for ($a=0; $a < count($squaresUsed); $a++) {
for ($b=1; $b <= count($squaresUsed[$a][0]); $b++) {
if ($a == 0 || $a == 2 || $a == 4 || $a == 6 || $a == 8 || $a == 10 || $a == 11 || $a == 13 || $a == 14) { 

    
if ($itemID != $squaresUsed[$a][0][$b]) { $itemID = $squaresUsed[$a][0][$b]; 
                   // usort($squaresUsed[$a][1], "method1");                   
$location = explode("|", $squaresUsed[$a][1][$b]);
if ($squaresUsed[$a][1][$b] != "") {
array_push($locationX, $location[0]);
array_push($locationY, $location[1]);
    
if (is_array($final[$squaresUsed[$a][1][$b]]) != 1) { $final[$squaresUsed[$a][1][$b]] = array(); }
    
array_push($final[$squaresUsed[$a][1][$b]], ['item' => $squaresUsed[$a][2][$b], 'connection' => $squaresUsed[$a][3][$b], 'material' => $squaresUsed[$a][8][$b], 'rotate' => $squaresUsed[$a][9][$b], 'flip' => $squaresUsed[$a][10][$b], 'temperature' => $squaresUsed[$a][11][$b], 'mass' => $squaresUsed[$a][12][$b]]);
    
$save = 1;  
}
}
if ($squaresUsed[$a][1][$b] != "") {
    $location = explode("|", $squaresUsed[$a][1][$b]);

array_push($locationX2, $location[0]);
array_push($locationY2, $location[1]);
}
}
}    
}
  
//print_r($final);
if ($save == 1) {
     //print_r($squaresUsed); 
$minX = min($locationX2);
$minY = min($locationY2);
$sizeX = ((max($locationX2) - min($locationX2)) / 30) + 1; 
$sizeY = ((max($locationY2) - min($locationY2)) / 30) + 1;   
    
if (check($sizeX) == 0) { $startX = (($sizeX - 1) / 2); } else { $startX = ($sizeX / 2) - 1; }
if (check($sizeY) == 0) { $startY = (($sizeY - 1) / 2); } else { $startY = ($sizeY / 2) - 1; }
    
$startX = 0 - $startX;
$startY = 0 - $startY;    
    
$endX = $startX + $sizeX;
$endY = $startY + $sizeY;

    
    
//if ($startX == 0) { $startX = 1; }    
//if ($startY == 0) { $startY = 1; }    

    
//echo $x." ".$y;
    
//for ($a=0; $a <= count($squaresUsed[0]); $a++) {
//for ($b=1; $b <= count($squaresUsed[$a][0]); $b++) {
//if ($a == 0 || $a == 2 || $a == 4 || $a == 6 || $a == 8 || $a == 10 || $a == 11) {

    
//if ($itemID != $squaresUsed[$a][0][$b]) { $itemID = $squaresUsed[$a][0][$b]; 

//if ($squaresUsed[$a][1][$b] != "") {
//$location = explode("|", $squaresUsed[$a][1][$b]);
    
//$tempX = $startX + (($location[0] - $minX) / 30);
//$tempY = $startY + (($location[1] - $minY) / 30);
//array_push($buildings, ['id' => $squaresUsed[$a][2][$b], 'location_x' => $tempX, 'location_y' => $tempY, 'element' => $squaresUsed[$a][8][$b]]);


    
//}
//}
//}

//}    
//}    
//print_r($buildings); 
//echo $startX." ".$endX." <br />";
//echo $startY." ".$endY." <br />";
    
$cells = array();
    
$x = $minX; $y = $minY;
    
//$temperature = 293.149994;
    
for ($a=$startY; $a<$endY; $a++) {
    $x = $minX;
for ($b=$startX; $b<$endX; $b++) {
$cell = 0;
$locationY = ($a * -1);
    //print_r($final[$x."|".$y]);
    if (is_array($final[$x."|".$y]) == 1) { 
        //print_r($final[$x."|".$y]);
    for ($c=0; $c<count($final[$x."|".$y]); $c++) {
        
        //$locationY = ($a * -1) + 1;
        
        $id = yamlID($final[$x."|".$y][$c]["item"]);
        $element = yamlID($final[$x."|".$y][$c]["material"]);
        //$mass = intval(get_buildingMass($final[$x."|".$y][$c]["item"]));
        $temperature = temperatureConvert($final[$x."|".$y][$c]["temperature"], $temperatureType);
        $mass = floatval($final[$x."|".$y][$c]["mass"]);
        $connections = floatval($final[$x."|".$y][$c]["connection"]);
    
        if (strpos($final[$x."|".$y][$c]["item"], 'Natural Tile ') !== false || strpos($final[$x."|".$y][$c]["item"], 'Liquids ') !== false || strpos($final[$x."|".$y][$c]["item"], 'Gases ') !== false) {
        
            array_push($cells, ['element' => $id, 'mass' => $mass, 'temperature' => $temperature, 'location_x' => $b, 'location_y' => $locationY]); $cell = 1;
        }
        else if (strpos($final[$x."|".$y][$c]["item"], 'Geysers ') !== false) {
                        array_push($otherEntities, ['id' => $id, 'location_x' => $b, 'location_y' => $locationY, 'element' => 'IgneousRock', 'temperature' => $temperature]);
        }
        else if (strpos($final[$x."|".$y][$c]["item"], 'Plants ') !== false) {
            
            array_push($otherEntities, ['id' => $id, 'location_x' => $b, 'location_y' => $locationY, 'element' => 'Creature', 'temperature' => $temperature, 'units' => 1, 'type' => 'Other']);
            
            $amounts = plantCheck($final[$x."|".$y][$c]["item"]);
            if (count($amounts) > 0) {
            $otherEntities[count($otherEntities)-1]['amounts'] = array(); 
                
            for ($d=0;$d<count($amounts);$d++) {
            if ($amounts[$d] == 1) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'Maturity', 'value' => 0.1]; }    
             if ($amounts[$d] == 2) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'AirPressure', 'value' => 0.1]; }       
            if ($amounts[$d] == 3) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'Temperature', 'value' => $temperature]; }
            if ($amounts[$d] == 4) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'OldAge']; }    
            if ($amounts[$d] == 5) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'Fertilization']; }    
            if ($amounts[$d] == 6) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'Irrigation']; }    
            if ($amounts[$d] == 7) { $otherEntities[count($otherEntities)-1]['amounts'][] = ['id' => 'Illumination']; }    
            }
            
        }
            $cell = 1;
        }
        else {
            
        $left = check57TiledBuilding($final[$x."|".$y][$c]["item"]);
            
        $locationX = $b - $left;
            
        array_push($buildings, ['id' => $id, 'location_x' => $locationX, 'location_y' => $locationY, 'element' => $final[$x."|".$y][$c]["material"], 'temperature' => $temperature]);
            
        if ($connections != 0) { 
        
        $buildings[count($buildings)-1]['connections'] = $connections; 
        
        }
        
        if ($final[$x."|".$y][$c]["rotate"] != 0) { 
        
        $buildings[count($buildings)-1]['rotationOrientation'] = "R".$final[$x."|".$y][$c]["rotate"]; 
        
        }
        
        else if ($final[$x."|".$y][$c]["flip"] == -1) { 
        
        $buildings[count($buildings)-1]['rotationOrientation'] = "FlipH";     
        }
        
        $cell = checkCell($id);
    if ($cell == 1) { array_push($cells, ['element' => $final[$x."|".$y][$c]["material"], 'mass' => $mass, 'temperature' => $temperature, 'location_x' => $b, 'location_y' => $locationY]); }
        }
                                
    //'storage' => [], 'rottable' => array('rotAmount' => 0), 'amounts' => [], 'other_values' => []]); 
        
                                
    }
                                
                    }
    if ($cell == 0) {
array_push($cells, ['element' => 'Oxygen', 'mass' => 0, 'temperature' => 0, 'location_x' => $b, 'location_y' => $locationY]);    
    }
$x = $x + 30;
}   
$y = $y + 30;
}
    
//print_r($cells);    
    
$area = $sizeX * $sizeY;
    
    /*
$array['name'] = $title;
$array['info'] = ['size' => array('X' => $x, 'Y' => $y), 'area' => $area];
$array['cells'] = [['element' => $element, 'mass' => $mass, 'temperature' => $temperature, 'location_x' => $locationX, 'location_y' => $locationY]];
$array['buildings'] = [['location_x' => $locationX, 'element' => $element, 'temperature' => $temperature, 'storage' => [], 'rottable' => array('rotAmount' => 0), 'amounts' => [], 'other_values' => []]];
*/
//print_r($array);
    
//print_r($squaresUsed);

    
$array['name'] = $title;
$array['info'] = ['size' => array('X' => $sizeX, 'Y' => $sizeY), 'area' => $area];
$array['cells'] = $cells;
$array['buildings'] = $buildings;   
    
$array['pickupables'] = [];
$array['elementalOres'] = [];
$array['otherEntities'] = $otherEntities;
    
$yaml = Spyc::YAMLDump($array);
    
while (true) {
 $filename = rand() . '.yaml';
 if (!file_exists(sys_get_temp_dir() . $filename)) break;
}
    
file_put_contents("yaml/".$filename, $yaml);
echo "yaml/".$filename;    
       
}

    
}


?>