<?php

require_once("functions.php");

$buildings = get_buildings($buildingID, $buildingTypeID);

$first = 1;    
    
for ($a=0;$a<count($buildings["buildingID"]);$a++) {
    
$buildingTypeName = strtolower($buildings["buildingTypeName"][$a]);   
if ($buildingTypeID != $buildings["buildingTypeID"][$a]) { $buildingTypeID = $buildings["buildingTypeID"][$a]; 
    
if ($first != 1) { $html .= '</div>'; } else { $first = 0; }
    
$html .= '<div id="buildingType'.$buildingTypeName.'" class="buildingtype">';   
}   
    
$buildingConnections = get_buildingConnections($buildings["buildingID"][$a]);
$connections = "";
if (is_array($buildingConnections["buildingID"])) {
for ($b=0;$b<count($buildingConnections["buildingID"]);$b++) {
if ($b != 0) { $connections .= ","; }
$connections .= $buildingConnections["buildingConnectionType"][$b]."/".$buildingConnections["buildingConnectionX"][$b]."x".$buildingConnections["buildingConnectionY"][$b];
}
}

$buildingName = str_replace(" ", "-", $buildings["buildingName"][$a]); $buildingName = strtolower($buildingName); $buildingSize = explode("x", $buildings["buildingSize"][$a]); $buildingW = intval($buildingSize[0]) * 30; $buildingH = intval($buildingSize[1]) * 30;
    
$html .= '<button class="buildings" onclick="setBuilding(this.value);" value="'.$buildingName.'|'.$buildings["buildingName"][$a].'|'.$buildings["buildingSize"][$a].'|'.$buildings["buildingFlip"][$a].'|'.$buildings["buildingRotate"][$a].'|'.$connections.'|'.$buildings["buildingLayer"][$a].'|'.$buildings["buildingConstruction"][$a].'|'.$buildings["buildingDisplay"][$a].'|"><img id="'.$buildingName.'-menu" src="'.$buildingTypeName.'/menu/'.$buildingName.'.jpg"></button>';   

    
$image .= '<img id="'.$buildingName.'" src="'.$buildingTypeName.'/'.$buildingName.'.png" style="width: '.$buildingW.'px; height: '.$buildingH.'px; display: none; position: absolute; z-index: 15; pointer-events: none;">';
    
 if ($buildings["buildingName"][$a] == "Transit Tube" || $buildings["buildingName"][$a] == "Wire" || $buildings["buildingName"][$a] == "Heavi-Watt Wire" || $buildings["buildingName"][$a] == "Conductive Wire" || $buildings["buildingName"][$a] == "Heavi-Watt Conductive Wire" || $buildings["buildingName"][$a] == "Liquid Pipe" || $buildings["buildingName"][$a] == "Insulated Liquid Pipe" || $buildings["buildingName"][$a] == "Radiant Liquid Pipe" || $buildings["buildingName"][$a] == "Gas Pipe" || $buildings["buildingName"][$a] == "Insulated Gas Pipe" || $buildings["buildingName"][$a] == "Radiant Gas Pipe" || $buildings["buildingName"][$a] == "Automation Wire" || $buildings["buildingName"][$a] == "Automation Ribbon") {
    
for ($b=1; $b<=15; $b++) {
$image .= '<img id="'.$buildingName.'-'.$b.'" src="'.$buildingTypeName.'/'.$buildingName.'-'.$b.'.png" style="width: '.$buildingW.'px; height: '.$buildingH.'px; display: none; position: absolute; z-index: 15; pointer-events: none;">';
}
}
    
}   
 
$html .= '</div>';
    
$solids = array();    
    
$solids[0] = array(array("Fertilizer",300),array("Phosphorite",1840));
$solids[1] = array(array("Crushed Rock",1840));
$solids[2] = array(array("Ceramic",2000),array("Fossil",1000),array("Granite",1840),array("Graphite",600),array("Igneous Rock",1840),array("Mafic Rock",1840),array("Obsidian",1840),array("Sandstone",1840),array("Sedimentary Rock",1840));
$solids[3] = array(array("Bleach Stone",500),array("Coal",4000),array("Lime",1840),array("Oxylite",500),array("Phosphorus",1000),array("Refined Carbon",4000),array("Rust",1840),array("Salt",2000),array("Sucrose",2000));
$solids[4] = array(array("Clay",1840),array("Dirt",1840));
$solids[5] = array(array("Regolith",1000),array("Sand",1840));
$solids[6] = array(array("Brine Ice",1100),array("Crushed Ice",20),array("Ice",1100),array("Polluted Ice",800),array("Snow",20),array("Solid Carbon Dioxide",2000),array("Solid Chlorine",1000),array("Solid Crude Oil",1840),array("Solid Ethanol",200),array("Solid Hydrogen",1000),array("Solid Mercury",1000),array("Solid Methane",750),array("Solid Naphtha",1840),array("Solid Oxygen",1000),array("Solid Petroleum",1840),array("Solid Propane",1000));
$solids[7] = array(array("Enriched Uranium",200),array("Glass",1840),array("Insulation",1800),array("Plastic",913),array("Solid Super Coolant",1840),array("Solid Visco-Gel",150),array("Steel",10000),array("Thermium",1800));
$solids[8] = array(array("Aluminum Ore",500),array("Cobalt Ore",6300),array("Copper Ore",1840),array("Electrum",1840),array("Gold Amalgam",1840),array("Iron Ore",1840),array("Pyrite",1840),array("Uranium Ore",200),array("Wolframite",1840));
$solids[9] = array(array("Algae",300),array("Mud",1840),array("Polluted Dirt",1840),array("Polluted Mud",1840),array("Resin",1850),array("Slime",300));
$solids[10] = array(array("Abyssalite",3200),array("Corium",200),array("Diamond",1840),array("Solid Nuclear Waste",9970),array("Sulfur",2000)); 
$solids[11] = array(array("Fullerene",50),array("Isoresin",50),array("Niobium",50));
$solids[12] = array(array("Aluminum",1000),array("Cobalt",8900),array("Copper",3870),array("Depleted Uranium",200),array("Gold",9970),array("Iron",7870),array("Lead",2000),array("Tungsten",1000));
$solids[13] = array(array("Neutronium",20000));
$solids[14] = array(array("Bitumen",1840),array("Radium",200));
for ($a=0;$a<count($solids);$a++) {
    
$naturalTileMats .= '<div class="materialsBox" style="width: 100px;">';
for ($b=0;$b<count($solids[$a]);$b++) {
    
$tileName = str_replace(" ", "-", $solids[$a][$b][0]); $tileName = strtolower($tileName);
    
$naturalTileMats .= '<button type="button" class="button left" onclick="setBuilding(this.value); materialOptions(1);';
$naturalTileMats .= " materialSelect('".$solids[$a][$b][0]."')";
$naturalTileMats .= '" value="natural-tile-'.$tileName.'|Natural Tile '.$solids[$a][$b][0].'|1x1|0|0||13|8||'.$solids[$a][$b][1].'"><img src="special/natural-tile-'.$tileName.'.png" /><span>'.$solids[$a][$b][0].'</span></button>'; 
    
$naturalTile .= '<img id="natural-tile-'.$tileName.'" src="special/natural-tile-'.$tileName.'.png" style="width: 30px; height: 30px; display: none; position: absolute; z-index: 15; pointer-events: none;">';   
    
    
}    
    $naturalTileMats .= '</div>';
}
     
$liquids[0] = array(array("Brine",1200),array("Crude Oil",870),array("Ethanol",1000),array("Magma",1840),array("Nuclear Waste",1000),array("Petroleum",740),array("Polluted Water",1000),array("Salt Water",1100),array("Super Coolant",910),array("Visco-Gel",100),array("Water",1000));

$liquids[1] = array(array("Liquid Carbon Dioxide",2000),array("Liquid Chlorine",1000),array("Liquid Hydrogen",1000),array("Liquid Oxygen",500),array("Liquid Propane",1000),array("Methane",1000));
    
$liquids[2] = array(array("Liquid Cobalt",7870),array("Liquid Copper",3870),array("Liquid Gold",9970),array("Liquid Iron",7870),array("Liquid Niobium",3870),array("Liquid Steel",3870),array("Liquid Tungsten",3870),array("Molten Aluminum",7870),array("Molten Lead",9970));
    
$liquids[3] = array(array("Liquid Carbon",4000),array("Liquid Phosphorus",1000),array("Liquid Resin",920),array("Liquid Sucrose",740),array("Liquid Sulfur",740),array("Liquid Uranium",9970),array("Molten Glass",1840),array("Molten Salt",740),array("Naphtha",740));
    
for ($a=0;$a<count($liquids);$a++) {
$liquidMats .= '<div class="materialsBox" style="width: 100px;">';
    
for ($b=0;$b<count($liquids[$a]);$b++) {
    
$liquidName = str_replace(" ", "-", $liquids[$a][$b][0]); $liquidName = strtolower($liquidName);
    
$liquidMats .= '<button type="button" class="button left" onclick="setBuilding(this.value); materialOptions(1);';
$liquidMats .= " materialSelect('".$liquids[$a][$b][0]."')";
$liquidMats .= '" value="liquids-'.$liquidName.'|Liquids '.$liquids[$a][$b][0].'|1x1|0|0||13|9||'.$liquids[$a][$b][1].'"><img src="special/liquids-'.$liquidName.'.png" /><span>'.$liquids[$a][$b][0].'</span></button>'; 
    
$liquid .= '<img id="liquids-'.$liquidName.'" src="special/liquids-'.$liquidName.'.png" style="width: 30px; height: 30px; display: none; position: absolute; z-index: 15; pointer-events: none;">';   
    
    
}    
$liquidMats .= '</div>';
}
    
    
$gases[0] = array("Oxygen","Polluted Oxygen");   
$gases[1] = array("Carbon Dioxide","Chlorine","Hydrogen","Natural Gas","Propane","Sour Gas","Steam");   
$gases[2] = array("Gas Ethanol","Gas Super Coolant","Nuclear Fallout");   
$gases[3] = array("Gas Aluminum","Gas Cobalt","Gas Copper","Gas Gold","Gas Iron","Gas Lead","Gas Niobium","Gas Steel","Gas Tungsten");   
$gases[4] = array("Gas Carbon","Gas Phosphorus","Gas Sulfur","Rock Gas","Salt Gas"); 
    
for ($a=0;$a<count($gases);$a++) {
$gasMats .= '<div class="materialsBox" style="width: 100px;">';
    
for ($b=0;$b<count($gases[$a]);$b++) {
    
$gasName = str_replace(" ", "-", $gases[$a][$b]); $gasName = strtolower($gasName);
    
$gasMats .= '<button type="button" class="button left" onclick="setBuilding(this.value); materialOptions(1);';
$gasMats .= " materialSelect('".$gases[$a][$b]."')";
$gasMats .= '" value="gases-'.$gasName.'|Gases '.$gases[$a][$b].'|1x1|0|0||13|9||2"><img src="special/gases-'.$gasName.'.png" /><span>'.$gases[$a][$b].'</span></button>'; 
    
$gas .= '<img id="gases-'.$gasName.'" src="special/gases-'.$gasName.'.png" style="width: 30px; height: 30px; display: none; position: absolute; z-index: 15; pointer-events: none;">';   
    
    
}    
$gasMats .= '</div>';
}   
    
$geysers[0] = array("Carbon Dioxide Geyser","Cool Salt Slush Geyser","Cool Slush Geyser","Leaky Oil Fissure","Polluted Water Vent","Salt Water Geyser","Sulfur Geyser","Water Geyser");
    
$geysers[1] = array("Carbon Dioxide Vent","Chlorine Gas Vent","Cool Steam Vent","Hot Polluted Oxygen Vent","Hydrogen Vent","Infectious Polluted Oxygen Vent","Natural Gas Geyser","Steam Vent");
    
$geysers[2] = array("Minor Volcano","Volcano");
$geysers[3] = array("Aluminum Volcano","Cobalt Volcano","Copper Volcano","Gold Volcano","Iron Volcano","Niobium Volcano","Tungsten Volcano");
  
for ($a=0;$a<count($geysers);$a++) {
$geyserMats .= '<div class="materialsBox" style="width: 100px;">';
    
if ($a==0) { $width = 4; $height = 2; }
else if ($a==1) { $width = 2; $height = 4; } 
else { $width = 3; $height = 3; }
for ($b=0;$b<count($geysers[$a]);$b++) {
    
$geyserName = str_replace(" ", "-", $geysers[$a][$b]); $geyserName = strtolower($geyserName);
    
$geyserMats .= '<button type="button" class="button left" onclick="setBuilding(this.value); materialOptions(1);';
$geyserMats .= " materialSelect('".$geysers[$a][$b]."')";
$geyserMats .= '" value="geysers-'.$geyserName.'|Geysers '.$geysers[$a][$b].'|'.$width.'x'.$height.'|0|0||0|9||"><img src="special/geysers-'.$geyserName.'.png" /><span>'.$geysers[$a][$b].'</span></button>'; 
    
$bWidth = $width * 30; $bHeight = $height * 30;
    
$geyser .= '<img id="geysers-'.$geyserName.'" src="special/geysers-'.$geyserName.'.png" style="width: '.$bWidth.'px; height: '.$bHeight.'px; display: none; position: absolute; z-index: 15; pointer-events: none;">';   
    
    
}    
$geyserMats .= '</div>';
}   
    
$plants[0] = array(array("Arbor Tree","3"),array("Balm Lily","2"),array("Bristle Blossom","2"),array("Buried Muckroot","1"),array("Dasha Saltvine","2"),array("Dusk Cap","2"),array("Gas Grass","3"),array("Hexalent","2"),array("Mealwood","2"),array("Nosh Sprout","2"),array("Oxyfern","2"),array("Pincha Pepper","3"),array("Sleet Wheat","1"),array("Thimble Reed","3"),array("Waterweed","2"),array("Wheezewort","2"));
$plants[1] = array(array("Bluff Briar","1"),array("Buddy Budd","1"),array("Jumping Joya","1"),array("Mirth Leaf","1"),array("Sporechid","1"));
$plants[2] = array(array("Bog Bucket","2"),array("Grubfruit Plant","2"),array("Saturn Critter Trap","2"),array("Spindly Grubfruit Plant","2"),array("Swamp Chard","1"));
$plants[3] = array(array("Bliss Burst","1"),array("Mellow Mallow","1"));
    
    
for ($a=0;$a<count($plants);$a++) {
$plantMats .= '<div class="materialsBox" style="width: 100px;">';
    
for ($b=0;$b<count($plants[$a]);$b++) {
    
$plantName = str_replace(" ", "-", $plants[$a][$b][0]); $plantName = strtolower($plantName);
    
$plantMats .= '<button type="button" class="button left" onclick="setBuilding(this.value); materialOptions(1);';
$plantMats .= " materialSelect('".$plants[$a][$b][0]."')";
$plantMats .= '" value="plants-'.$plantName.'|Plants '.$plants[$a][$b][0].'|1x'.$plants[$a][$b][1].'|0|0||0|9||"><img src="special/plants-'.$plantName.'.png" /><span>'.$plants[$a][$b][0].'</span></button>'; 
    
$bHeight = $plants[$a][$b][1] * 30;
    
$plant .= '<img id="plants-'.$plantName.'" src="special/plants-'.$plantName.'.png" style="width: 30px; height: '.$bHeight.'px; display: none; position: absolute; z-index: 15; pointer-events: none;">';   
    
    
}    
$plantMats .= '</div>';
}  

?>
<!doctype html>
<html>
<link href="reset.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="iconselect.css" >
<link rel="stylesheet" type="text/css" href="blueprints.css" >
<script src="jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="1.12.1-jquery-ui.js"></script>
<script src="functions-layers.js"></script>
<script type="text/javascript" src="iconselect.js"></script>
<script type="text/javascript" src="iscroll.js"></script>

<body oncontextmenu="return false;">
  
<div id="main">
    
<div id="left">
<div id="base" onclick="displayMenu('base');" class="menu button"><img src="base/menu/base-menu.png" /></div> 
<div id="oxygen" onclick="displayMenu('oxygen');" class="menu button"><img src="oxygen/menu/oxygen-menu.png" /></div>
<div id="power" onclick="displayMenu('power');" class="menu button"><img src="power/menu/power-menu.png" /></div>  
<div id="food" onclick="displayMenu('food');" class="menu button"><img src="food/menu/food-menu.png" /></div>
<div id="plumbing" onclick="displayMenu('plumbing');" class="menu button"><img src="plumbing/menu/plumbing-menu.png" /></div> 
<div id="ventilation" onclick="displayMenu('ventilation');" class="menu button"><img src="ventilation/menu/ventilation-menu.png" /></div>
<div id="refinement" onclick="displayMenu('refinement');" class="menu button"><img src="refinement/menu/refinement-menu.png" /></div> 
<div id="medicine" onclick="displayMenu('medicine');" class="menu button"><img src="medicine/menu/medicine-menu.png" /></div>
<div id="furniture" onclick="displayMenu('furniture');" class="menu button"><img src="furniture/menu/furniture-menu.png" /></div>  
<div id="stations" onclick="displayMenu('stations');" class="menu button"><img src="stations/menu/stations-menu.png" /></div>
<div id="utilities" onclick="displayMenu('utilities');" class="menu button"><img src="utilities/menu/utilities-menu.png" /></div>
<div id="automation" onclick="displayMenu('automation');" class="menu button"><img src="automation/menu/automation-menu.png" /></div>
<div id="shipping" onclick="displayMenu('shipping');" class="menu button"><img src="shipping/menu/shipping-menu.png" /></div> 
<div id="rocketry" onclick="displayMenu('rocketry');" class="menu button"><img src="rocketry/menu/rocketry-menu.png" /></div>
<div id="radiation" onclick="displayMenu('radiation');" class="menu button"><img src="radiation/menu/radiation-menu.png" /></div>
<div id="special" onclick="displayMenu('special');" class="menu button"><img src="special/menu/special-menu.png" /></div>
</div>
    
<div id="middle">
<?php echo $html; ?> 
</div>

<div id="materials1" class="materialsArea materialsBox">
<button type="button" class="button left materials SandStone" onclick="materialSelect('SandStone');"><img src="materials/sandstone.png" /><span>Sandstone</span></button>   
<button type="button" class="button right materials IgneousRock" onclick="materialSelect('IgneousRock');"><img src="materials/igneous-rock.png" /><span>Igneous Rock</span></button>   
<button type="button" class="button left materials Granite" onclick="materialSelect('Granite');"><img src="materials/granite.png" /><span>Granite</span></button>   
<button type="button" class="button right materials SedimentaryRock" onclick="materialSelect('SedimentaryRock');"><img src="materials/sedimentary-rock.png" /><span>Sedimentary Rock</span></button>   
<button type="button" class="button left materials Obsidian" onclick="materialSelect('Obsidian');"><img src="materials/obsidian.png" /><span>Obsidian</span></button>   
<button type="button" class="button right materials Fossil" onclick="materialSelect('Fossil');"><img src="materials/fossil.png" /><span>Fossil</span></button>   
<button type="button" class="button left materials Ceramic" onclick="materialSelect('Ceramic');"><img src="materials/ceramic.png" /><span>Ceramic</span></button>   
<button type="button" class="button right materials MaficRock" onclick="materialSelect('MaficRock');"><img src="materials/mafic-rock.png" /><span>Mafic Rock</span></button>   
<button type="button" class="button left materials Isoresin" onclick="materialSelect('Isoresin');"><img src="materials/isoresin.png" /><span>Isoresin</span></button>   
<button type="button" class="button right materials SuperInsulator" onclick="materialSelect('SuperInsulator');"><img src="materials/insulation.png" /><span>Insulation</span></button>    
<div class="clear"></div>  
</div>
      
<div id="materials2" class="materialsArea">
<div class="materialsBox">
<button type="button" class="button left materials Cuprite" onclick="materialSelect('Cuprite');"><img src="materials/copper-ore.png" /><span>Copper Ore</span></button>  
<button type="button" class="button right materials SolidMercury" onclick="materialSelect('SolidMercury');"><img src="materials/mercury.png" /><span>Mercury</span></button> 
<button type="button" class="button left materials Electrum" onclick="materialSelect('Electrum');"><img src="materials/electrum.png" /><span>Electrum</span></button>
<button type="button" class="button right materials AluminiumOre" onclick="materialSelect('AluminiumOre');"><img src="materials/aluminium-ore.png" /><span>Aluminium Ore</span></button>
<button type="button" class="button left materials FoolsGold" onclick="materialSelect('FoolsGold');"><img src="materials/pyrite.png" /><span>Pyrite</span></button> 
<button type="button" class="button right materials IronOre" onclick="materialSelect('IronOre');"><img src="materials/iron-ore.png" /><span>Iron Ore</span></button>
<button type="button" class="button left materials GoldAmalgam" onclick="materialSelect('GoldAmalgam');"><img src="materials/gold-amalgam.png" /><span>Gold Amalgam</span></button>        
<button type="button" class="button right materials Wolframite" onclick="materialSelect('Wolframite');"><img src="materials/wolframite.png" /><span>Wolframite</span></button>
<div class="clear"></div> 
</div>
<div class="materialsBox">
<button type="button" class="button left materials Steel" onclick="materialSelect('Steel');"><img src="materials/steel.png" /><span>Steel</span></button>
<button type="button" class="button right materials Niobium" onclick="materialSelect('Niobium');"><img src="materials/niobium.png" /><span>Niobium</span></button>
<button type="button" class="button left materials TempConductorSolid" onclick="materialSelect('TempConductorSolid');"><img src="materials/thermium.png" /><span>Thermium</span></button>
<div class="clear"></div> 
</div> 
</div>
    
<div id="materials3" class="materialsArea materialsBox">
<button type="button" class="button left materials Copper" onclick="materialSelect('Copper');"><img src="materials/copper.png" /><span>Copper</span></button>
<button type="button" class="button right materials Lead" onclick="materialSelect('Lead');"><img src="materials/lead.png" /><span>Lead</span></button>
<button type="button" class="button left materials Iron" onclick="materialSelect('Iron');"><img src="materials/iron.png" /><span>Iron</span></button>
<button type="button" class="button right materials Aluminium" onclick="materialSelect('Aluminium');"><img src="materials/aluminium.png" /><span>Aluminium</span></button>
<button type="button" class="button left materials Gold" onclick="materialSelect('Gold');"><img src="materials/gold.png" /><span>Gold</span></button>
<button type="button" class="button right materials Tungsten" onclick="materialSelect('Tungsten');"><img src="materials/tungsten.png" /><span>Tungsten</span></button>
<button type="button" class="button left materials Steel" onclick="materialSelect('Steel');"><img src="materials/steel.png" /><span>Steel</span></button>
<button type="button" class="button right materials Niobium" onclick="materialSelect('Niobium');"><img src="materials/niobium.png" /><span>Niobium</span></button>
<button type="button" class="button left materials TempConductorSolid" onclick="materialSelect('TempConductorSolid');"><img src="materials/thermium.png" /><span>Thermium</span></button>
<div class="clear"></div>  
</div>
    
<div id="materials4" class="materialsArea materialsBox">
<button type="button" class="button left materials Polypropylene" onclick="materialSelect('Polypropylene');"><img src="materials/plastic.png" /><span>Plastic</span></button> 
<button type="button" class="button right materials SolidViscoGel" onclick="materialSelect('SolidViscoGel');"><img src="materials/visco-gel.png" /><span>ViscoGel</span></button> 
<div class="clear"></div>  
</div> 
  
<div id="materials5" class="materialsArea materialsBox">
<button type="button" class="button left materials Glass" onclick="materialSelect('Glass');"><img src="materials/glass.png" /><span>Glass</span></button> 
<button type="button" class="button right materials Diamond" onclick="materialSelect('Diamond');"><img src="materials/diamond.png" /><span>Diamond</span></button> 
<div class="clear"></div>  
</div>
    
<div id="materials6" class="materialsArea materialsBox">
<button type="button" class="button left materials Steel" onclick="materialSelect('Steel');"><img src="materials/steel.png" /><span>Steel</span></button>
<div class="clear"></div>  
</div>
    
<div id="materials7" class="materialsArea materialsBox">
<button type="button" class="button left materials Glass" onclick="materialSelect('Glass');"><img src="materials/glass.png" /><span>Glass</span></button>
<div class="clear"></div>  
</div>    
    
<div id="materials8" class="specialMaterialsBox">
<div class="flex"><?php echo $naturalTileMats; ?></div>
</div>
    
<div id="materials9" class="specialMaterialsBox">
<div class="flex"><?php echo $liquidMats; ?></div>
</div>    
    
<div id="materials10" class="specialMaterialsBox">
<div class="flex"><?php echo $gasMats; ?></div>
</div>    
    
<div id="materials11" class="specialMaterialsBox">
<div class="flex"><?php echo $geyserMats; ?></div>
</div>  
    
<div id="materials12" class="specialMaterialsBox">
<div class="flex"><?php echo $plantMats; ?></div>
</div> 
    
<div id="materials13" class="materialsArea materialsBox">
<button type="button" class="button left materials Unobtanium" onclick="materialSelect('Unobtanium');"><img src="special/natural-tile-neutronium.png" /><span>Neutronium</span></button>
<div class="clear"></div>  
</div>
    
<div id="attributes"><div class="temperature"><input id="temperature" type="text" pattern="[0-9]+([.][0-9]+)?" onchange="setTemperature(this.value);"><button id="celsius" onclick="setTemperatureType('C');">&#8451</button><button id="fahrenheit" onclick="setTemperatureType('F');">&#8457</button><button id="kelvin" onclick="setTemperatureType('K');">&#8490</button></div><div class="mass"><input id="mass" type="text" pattern="[0-9]+([.][0-9]+)?" onchange="setMass(this.value);"><button>Kg</button></div></div>
    
<div id="controls">
<div style="float: left;">
<div class="buttonGroup">
<button id="guideB" type="button" class="button" onclick="displayGuide(0);"><img src="controls/guide-c.png" /></button>
<button id="save" type="button" class="button" onclick="save(this); cancel();"><img src="controls/save-c.png" /></button>
<button id="cancelB" type="button" class="button" onclick="cancel();"><img src="controls/cancel-c.png" /></button>
<button id="rotate" type="button" class="button" onclick="rotate(0); itemXY();"><img src="controls/rotate.png" /></button>
<button id="flip" type="button" class="button" onclick="flip(0);"><img src="controls/flip.png" /></button>
<button id="deconstructB" type="button" class="button" onclick="deconstructBuilding(0);"><img src="controls/delete-c.png" /></button>
</div>
</div>
<div class="clear"></div> 

<div style="margin-top: 46px; float: left;">
<div class="buttonGroup">
<button id="overlay4" type="button" class="button" onclick="displayOverlay(4, 1);" value="0"><img src="controls/power-c.png" /></button>
<button id="overlay8" type="button" class="button" onclick="displayOverlay(8, 1);" value="0"><img src="controls/plumbing-c.png" /></button>
<button id="overlay10" type="button" class="button" onclick="displayOverlay(10, 1);" value="0"><img src="controls/ventilation-c.png" /></button>
<button id="overlay6" type="button" class="button" onclick="displayOverlay(6, 1);" value="0"><img src="controls/shipping-c.png" /></button>
<button id="overlay0" type="button" class="button" onclick="displayOverlay(0, 1);" value="0"><img src="controls/base-c.png" /></button>
<button id="overlay2" type="button" class="button" onclick="displayOverlay(2, 1);" value="0"><img src="controls/automation-c.png" /></button>
<button id="overlay11" type="button" class="button" onclick="displayOverlay(11, 1);" value="0"><img src="controls/radiation-c.png" /></button>
<button id="overlay12" type="button" class="button" onclick="displayOverlay(12, 1);" value="0"><img src="controls/background-c.png" /></button>
<button id="overlay13" type="button" class="button" onclick="displayOverlay(13, 1);" value="0"><img src="controls/elements-c.png" /></button>
</div>
    </div>
<div class="clear"></div> 
</div>
  
<div id="blueprint">
<div id="images"><?php echo $image; echo $naturalTile; echo $liquid; echo $gas; echo $geyser; echo $plant; ?>
<img id="automation-input1" src="connections/automation-input.jpg" class="connections">
<img id="automation-input2" src="connections/automation-input.jpg" class="connections">
<img id="automation-input3" src="connections/automation-input.jpg" class="connections">
<img id="automation-input4" src="connections/automation-input.jpg" class="connections">
<img id="automation-input5" src="connections/automation-input.jpg" class="connections">
<img id="automation-output1" src="connections/automation-output.jpg" class="connections">
<img id="automation-output2" src="connections/automation-output.jpg" class="connections">
<img id="automation-output3" src="connections/automation-output.jpg" class="connections">
<img id="automation-output4" src="connections/automation-output.jpg" class="connections">
<img id="automation-output5" src="connections/automation-output.jpg" class="connections">
<img id="automation-reset1" src="connections/automation-reset.jpg" class="connections">
<img id="automation-reset2" src="connections/automation-reset.jpg" class="connections">
<img id="automation-reset3" src="connections/automation-reset.jpg" class="connections">
<img id="automation-reset4" src="connections/automation-reset.jpg" class="connections">
<img id="automation-reset5" src="connections/automation-reset.jpg" class="connections">
<img id="input1" src="connections/input.jpg" class="connections">
<img id="input2" src="connections/input.jpg" class="connections">
<img id="input3" src="connections/input.jpg" class="connections">
<img id="input4" src="connections/input.jpg" class="connections">
<img id="input5" src="connections/input.jpg" class="connections">
<img id="output1" src="connections/output.jpg" class="connections">
<img id="output2" src="connections/output.jpg" class="connections">
<img id="output3" src="connections/output.jpg" class="connections">
<img id="output4" src="connections/output.jpg" class="connections">
<img id="output5" src="connections/output.jpg" class="connections">
<img id="filter1" src="connections/filter.jpg" class="connections">
<img id="filter2" src="connections/filter.jpg" class="connections">
<img id="filter3" src="connections/filter.jpg" class="connections">
<img id="filter4" src="connections/filter.jpg" class="connections">
<img id="filter5" src="connections/filter.jpg" class="connections">
<img id="power-input1" src="connections/power-input.jpg" class="connections">
<img id="power-input2" src="connections/power-input.jpg" class="connections">
<img id="power-input3" src="connections/power-input.jpg" class="connections">
<img id="power-input4" src="connections/power-input.jpg" class="connections">
<img id="power-input5" src="connections/power-input.jpg" class="connections">
<img id="power-output1" src="connections/power-output.jpg" class="connections">
<img id="power-output2" src="connections/power-output.jpg" class="connections">
<img id="power-output3" src="connections/power-output.jpg" class="connections">
<img id="power-output4" src="connections/power-output.jpg" class="connections">
<img id="power-output5" src="connections/power-output.jpg" class="connections">
<img id="radiation-input1" src="connections/radiation-input.png" class="connections">
<img id="radiation-input2" src="connections/radiation-input.png" class="connections">
<img id="radiation-input3" src="connections/radiation-input.png" class="connections">
<img id="radiation-input4" src="connections/radiation-input.png" class="connections">
<img id="radiation-input5" src="connections/radiation-input.png" class="connections">
<img id="radiation-output1" src="connections/radiation-output.png" class="connections">
<img id="radiation-output2" src="connections/radiation-output.png" class="connections">
<img id="radiation-output3" src="connections/radiation-output.png" class="connections">
<img id="radiation-output4" src="connections/radiation-output.png" class="connections">
<img id="radiation-output5" src="connections/radiation-output.png" class="connections">
</div>

<div id="gridContainer">
<canvas id="layer0" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 14;"></canvas> <!-- Normal -->
<canvas id="layer1" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 13; display: none;"></canvas> <!-- Automation Overlay -->
<canvas id="layer2" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 12;"></canvas> <!-- Automation -->
<canvas id="layer3" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 11; display: none;"></canvas> <!-- Wiring Overlay -->
<canvas id="layer4" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 10;"></canvas> <!-- Wiring -->
<canvas id="layer5" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 9; display: none;"></canvas> <!-- Shipping Overlay -->
<canvas id="layer6" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 8;"></canvas> <!-- Shipping -->
<canvas id="layer7" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 7; display: none;"></canvas> <!-- Liquid Overlay -->
<canvas id="layer8" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 6;"></canvas> <!-- Liquid -->
<canvas id="layer9" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 5; display: none;"></canvas> <!-- Gas Overlay -->
<canvas id="layer10" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 4;"></canvas> <!-- Gas -->
<canvas id="layer11" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas> <!-- Radiation -->
<canvas id="layer12" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas> <!-- Background -->
<canvas id="layer13" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas> <!-- Tile/Liquid/Gas -->
<canvas id="layer14" width="3000" height="3000" style="position: absolute; left: 0; top: 0; z-index: 15;"></canvas> <!-- Gantry -->
</div>
   
</div>
    
</div>
    
<div id="guide">
<div id="guide-left">
<li>Base Buildings</li>   
<li>Oxygen Buildings</li>   
<li>Power Buildings</li>   
<li>Food Buildings</li>   
<li>Plumbing Buildings</li>   
<li>Ventilation Buildings</li>   
<li>Refinement Buildings</li>   
<li>Medicine Buildings</li>   
<li>Furniture Buildings</li>   
<li>Stations Buildings</li>   
<li>Utilities Buildings</li>   
<li>Automation Buildings</li>   
<li>Shipping Buildings</li>   
<li>Rocketry Buildings</li>   
<li>Radiation Buildings</li> 
<li>Special Buildings</li> 
</div>    
    
<div id="guide-mid">
<div style="width: 278px; margin: 0 auto;">
<div style="width: 120px; height: 30px; border: 2px solid black; background-color: #3e4357; text-align: center; line-height: 30px; float: left; margin-right: 30px;">Item temperature</div> 
<div style="width: 120px; height: 30px; border: 2px solid black; background-color: #3e4357; text-align: center; line-height: 30px; float: left;">Item Mass</div> 
<div class="clear"></div>
</div>
    
<div style="margin: 80px; border: 2px solid black; background-color: #3e4357;">
<p class="red">Click the Guide button to open or close this guide at any time</p>    
    
<p class="red">Navigation</p>
   
<p>The building canvas can be navigated either using <span class="red">( W S A D )</span> or right click dragging</p>
    
<p class="red">How to use</p>
<p style="color: white;">Select an item from the left building menu<br />
Select the material to build that item with if applicable<br />
Optional Rotate or flip the item if applicable using <span class="red">( O )</span> or click the rotate or flip button<br />
Optional select the starting temperature / mass of the item before placing<br />
Click to place on the canvas, or click drag to place multiples / build connected items ( Transit Tubes / Wire / Liquid Piping / Gas Piping / Automation Wire )</p>
    
<p class="red">Deconstructing items</p>
<p>Select Deconstruct using <span class="red">( X )</span> or click the Deconstruct button<br />
Select the overlay you wish to deconstruct from using <span class="red">( 1, 2, 3, 4, 5, 6, 7, 8, 9 )</span> or clicking on the overlay button, if none selected then all overlays are selected for deconstruction.<br />
Click, or click drag on the item / squares to deconstruct.</p>
    
<p class="red">Saving and using .Yaml file</p>
<p>Click the Save button to create a .yaml file download link of the building canvas.<br />
Click the download button<br />
Place the downloaded .yaml file in the <span class="red">( OxygenNotIncluded_Data / StreamingAssets / templates )</span> folder located in the game directory<br />
In game open up debug mode using <span class="red">( Backspace )</span><br />
Select the template to use in game<br />
<span class="red">Note</span> - The save button has a 60 second timeout currently</p>
    
<p style="margin-bottom: 10px;"><a href="https://oxygennotincluded.fandom.com/wiki/Debug_Commands" style="color: aqua;" target="_blank">Activating Debug menu</a></p>
</div>     
</div> 
    
<div id="guide-right">
<li>Guide</li> 
<li>Save design to Download</li>
<li>Cancel - <span class="red">( ESC )</span></li>
<li>Rotate Building - <span class="red">( O )</span></li>
<li>Flip Building - <span class="red">( O )</span></li>
<li>Deconstruct - <span class="red">( X )</span></li>
<li style="margin-top: 66px;">Power Overlay - <span class="red">( 1 )</span></li>
<li>Plumbing Overlay - <span class="red">( 2 )</span></li>
<li>Ventilation Overlay - <span class="red">( 3 )</span></li>
<li>Shipping Overlay - <span class="red">( 4 )</span></li>
<li>Base Overlay - <span class="red">( 5 )</span></li>
<li>Automation Overlay - <span class="red">( 6 )</span></li>
<li>Radiation Overlay - <span class="red">( 7 )</span></li>
<li>Background Overlay - <span class="red">( 8 )</span></li>
<li>Elements Overlay - <span class="red">( 9 )</span></li>
</div>  
    
</div>
    
<div id="results" class="disabled"><div><img src="controls/cancel-c.png" style="width: 30px; height: 30px; float: right; cursor: pointer;" onclick="closeDownload();" /></div><div class="clear"></div><div id="download" style="margin-top: 14px;"></div></div>
</body>
</html>

<script type="application/javascript">
<?php echo $var; ?>
var grid0 = document.getElementById('layer0');
var grid1 = document.getElementById('layer1');
var grid2 = document.getElementById('layer2');
var grid3 = document.getElementById('layer3');
var grid4 = document.getElementById('layer4');
var grid5 = document.getElementById('layer5');
var grid6 = document.getElementById('layer6');
var grid7 = document.getElementById('layer7');
var grid8 = document.getElementById('layer8');
var grid9 = document.getElementById('layer9');
var grid10 = document.getElementById('layer10');
var grid11 = document.getElementById('layer11');
var grid12 = document.getElementById('layer12');
var grid13 = document.getElementById('layer13');
var grid14 = document.getElementById('layer14');
var context0 = grid0.getContext('2d');
var context1 = grid1.getContext('2d');
var context2 = grid2.getContext('2d');
var context3 = grid3.getContext('2d');
var context4 = grid4.getContext('2d');
var context5 = grid5.getContext('2d');
var context6 = grid6.getContext('2d');
var context7 = grid7.getContext('2d');
var context8 = grid8.getContext('2d');
var context9 = grid9.getContext('2d');
var context10 = grid10.getContext('2d');
var context11 = grid11.getContext('2d');
var context12 = grid12.getContext('2d');
var context13 = grid13.getContext('2d');
var context14 = grid14.getContext('2d');
var squareUsed = [[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']],[['itemid'],['tile'],['item'],['connection'],['left'],['right'],['top'],['bottom'],['material'],['rotate'],['flip'],['temperature'],['mass']]];
    
var connections = new Array();   
var x; var y;
var active;
var item = new Array();
var itemID = 0;
var material;
var angle = 0;
var flipped = 1;
var mousePos;
var prevMousePosX;
var prevMousePosY;
var prevConnection;
var buildLayer;
var overlayLayer;   
var deconstruct = 0;
var menu;
var temperatureType;
var temperature;
var itemMass;
    
    
var blueprint = document.getElementById('blueprint');
var gridContainer = document.getElementById('gridContainer');
var grid = grid0; var context = context0;
drawGrid(context0);
drawGrid(context1);
drawGrid(context2);
drawGrid(context3);
drawGrid(context4);
drawGrid(context5);
drawGrid(context6);
drawGrid(context7);
drawGrid(context8);
drawGrid(context9);
drawGrid(context10);
drawGrid(context11);
drawGrid(context12);
drawGrid(context13);
drawGrid(context14);
    
var dragBuild = 1;
       
gridContainer.addEventListener('click', function(evt) { console.log(squareUsed); console.log("flip "+flipped); layerClick(evt, grid); }, false);
    
gridContainer.addEventListener('mousedown', function(evt) {
switch (evt.which) { case 1: active = 1; break; case 2: break; case 3: break; default: }}, false);
    
gridContainer.addEventListener('mousemove', function(evt) { 
                                                  
mousePos = getSquare(grid, evt); 
x = mousePos.x;                                                       
y = mousePos.y;
    
var gridX = parseInt($("#gridContainer").css("left"));
var gridY = parseInt($("#gridContainer").css("top"));

if (active == 1) {  layerMove(evt, grid); }   
    
var tempX; var tempY;                                                       
                                                                                
if (flipped == -1) {    
tempX = x + item["width"] - 30;  
if(item["width"] == 180) { tempX = x + item["width"] - 60; }
if(item["width"] == 60 || item["width"] == 90) { tempX = x + item["width"]; }
if(item["width"] == 30) { tempX = x + item["width"] + 30; }
tempY = y + item["y"] + 30; 
}
else {
tempX = x + item["x"] + 30;  
tempY = y + item["y"] + 30; 
}

tempX = tempX + gridX;
tempY = tempY + gridY;
    
$('#'+item[0]).css({transform:"translate("+tempX+"px,"+tempY+"px) rotate("+angle+"deg) scaleX("+flipped+")"}); 
$('#'+item[0]).css("transform-origin", "bottom left");               
tempX = x + gridX;
tempY = y + gridY;                                              
moveConnectionSquares(tempX, tempY);                                                      
}, false);
gridContainer.addEventListener('mouseup', function(evt) { active = 0; prevMousePosX = undefined; prevMousePosY = undefined; dragBuild = 1; });

$(window).keydown(function(e){
// Keyboard keys used for building 
var key = e.key;
var tempX;
var tempY;
tempX = parseInt($("#gridContainer").css("left"));
tempY = parseInt($("#gridContainer").css("top"));
    
if (key == "w" || key == "W") { tempY = tempY + 30; $("#gridContainer").css("top",tempY+'px'); } // W - Navigate up on canvas
if (key == "s" || key == "S") { tempY = tempY - 30; $("#gridContainer").css("top",tempY+'px'); } // S - Navigate down on canvas
if (key == "a" || key == "A") { tempX = tempX + 30; $("#gridContainer").css("left",tempX+'px'); } // A - Navigate right on canvas
if (key == "d" || key == "D") { tempX = tempX - 30; $("#gridContainer").css("left",tempX+'px'); } // D - Navigate left on canvas
if (key == "Escape") { cancel(); } // Esc - Cancel Button
if (key == "x" || key == "X") { deconstructBuilding(0); } // X - Deconstruct Button
if (key == "1") { displayOverlay(4, 1); } // 1 - Power Overlay
if (key == "2") { displayOverlay(8, 1); } // 2 - Plumbing Overlay
if (key == "3") { displayOverlay(10, 1); } // 3 - Ventilation Overlay
if (key == "4") { displayOverlay(6, 1); } // 4 - Shipping Overlay
if (key == "5") { displayOverlay(0, 1); } // 5 - Base Overlay
if (key == "6") { displayOverlay(2, 1); } // 6 - Automation Overlay
if (key == "7") { displayOverlay(11, 1); } // 7 - Radiation Overlay
if (key == "8") { displayOverlay(12, 1); } // 8 - Background Overlay
if (key == "9") { displayOverlay(13, 1); } // 9 - Elements Overlay
if (key == "o" || key == "O") {
    
if (item[3] == 1) { flip(0); }
if (item[4] == 1) { rotate(0); }      
itemXY();  
    
var gridX = parseInt($("#gridContainer").css("left"));
var gridY = parseInt($("#gridContainer").css("top"));
 
var tempX; var tempY;                                                       
                                                                                
if (flipped == -1) {    
tempX = x + item["width"] - 30;  
if(item["width"] == 180) { tempX = x + item["width"] - 60; }
if(item["width"] == 60 || item["width"] == 90) { tempX = x + item["width"]; }
if(item["width"] == 30) { tempX = x + item["width"] + 30; }
tempY = y + item["y"] + 30; 
}
else {
tempX = x + item["x"] + 30;  
tempY = y + item["y"] + 30; 
}
tempX = tempX + gridX;
tempY = tempY + gridY;

$('#'+item[0]).css({transform:"translate("+tempX+"px,"+tempY+"px) rotate("+angle+"deg) scaleX("+flipped+")"}); 
$('#'+item[0]).css("transform-origin", "bottom left");               
   
tempX = x + gridX;
tempY = y + gridY;
moveConnectionSquares(tempX, tempY);

} // O - Flip and Rotate Button

});  
    
$('#temperature').on('input', function(e) { setTemperature(this.value); });
$('#mass').on('input', function(e) { setMass(this.value); });
    
materialOptions(0);
rotateFlip(0);    
setTemperature("20");
setTemperatureType('C');
setMass("0");
displayGuide(0);
      
var windowHeight = $(window).height();
$("#blueprint").css("height",windowHeight); 
    
$(window).resize(function(){
var windowHeight = $(window).height();
$("#blueprint").css("height",windowHeight);
});

$( function() { $( "#gridContainer" ).draggable({ grid: [ 90, 90 ], enabled: true, which: 3 }); });

</script>