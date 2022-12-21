<?php

function get_buildings($buildingID, $buildingTypeID) {
    
$connection = connect_db(host, id, pwd, db);
$a=0; $where = 0;
    
$buildingsSQL = "SELECT * FROM buildings LEFT JOIN buildingTypes ON buildings.buildingType_ID = buildingTypes.buildingType_ID";
if (is_numeric($buildingID) && $buildingID != 0) { 
$buildingsSQL .= " WHERE "; $where=1;
$buildingsSQL .= "building_ID = '$buildingID'";
}
if (is_numeric($buildingID) && $buildingID != 0) { 
if ($where == 0) { $buildingsSQL .= " WHERE "; $where=1; } else { $buildingsSQL .= " AND "; }
$buildingsSQL .= "buildingType_ID = '$buildingTypeID'";
}
    
$buildingsSQL .= " ORDER BY buildingType_order ASC, building_order ASC";
    
$buildingsResult = mysqli_query($connection, $buildingsSQL) or die (mysqli_error($connection));
while ($buildingsRow = mysqli_fetch_array($buildingsResult)) {
    
$buildings["buildingID"][$a] = $buildingsRow["building_ID"];    
$buildings["buildingTypeID"][$a] = $buildingsRow["buildingType_ID"];    
$buildings["buildingTypeName"][$a] = $buildingsRow["buildingType_name"];
$buildings["buildingName"][$a] = $buildingsRow["building_name"];
$buildings["buildingSize"][$a] = $buildingsRow["building_size"];
$buildings["buildingDisplay"][$a] = $buildingsRow["building_display"];
$buildings["buildingFlip"][$a] = $buildingsRow["building_flip"];
$buildings["buildingRotate"][$a] = $buildingsRow["building_rotate"];
$buildings["buildingLayer"][$a] = $buildingsRow["building_layer"];
$buildings["buildingConstruction"][$a] = $buildingsRow["building_construction"];

$a++;
}
return $buildings;
}

function get_buildingMass($buildingName) {
    
$connection = connect_db(host, id, pwd, db);
$a=0; $where = 0;
    
$buildingsSQL = "SELECT * FROM buildings";
if ($buildingName != "") { 
$buildingsSQL .= " WHERE "; $where=1;
$buildingsSQL .= "building_name = '$buildingName'";
}
    
$buildingsResult = mysqli_query($connection, $buildingsSQL) or die (mysqli_error($connection));
while ($buildingsRow = mysqli_fetch_array($buildingsResult)) {
    
$buildingMass = $buildingsRow["building_mass"];

}
return $buildingMass;
}

function get_buildingConnections($buildingID) {
    
$connection = connect_db(host, id, pwd, db);
$a=0; $where = 0;
    
$buildingConnectionsSQL = "SELECT * FROM buildingConnections";
if (is_numeric($buildingID) && $buildingID != 0) { 
$buildingConnectionsSQL .= " WHERE "; $where=1;
$buildingConnectionsSQL .= "building_ID = '$buildingID'";
}
    
$buildingConnectionsResult = mysqli_query($connection, $buildingConnectionsSQL) or die (mysqli_error($connection));
while ($buildingConnectionsRow = mysqli_fetch_array($buildingConnectionsResult)) {
    
$buildingConnections["buildingID"][$a] = $buildingConnectionsRow["building_ID"];
$buildingConnections["buildingConnectionType"][$a] = $buildingConnectionsRow["buildingConnection_type"];
$buildingConnections["buildingConnectionX"][$a] = $buildingConnectionsRow["buildingConnection_x"];
$buildingConnections["buildingConnectionY"][$a] = $buildingConnectionsRow["buildingConnection_y"];

$a++;
}
return $buildingConnections;
}

function check($number){ 
    if($number % 2 == 0){ 
        return 1;  
    } 
    else{ 
        return 0; 
    } 
}


function check57TiledBuilding($id) {
    
$left = 0;
    
if ($id == "Gas Reservoir" || $id == "Steam Turbine" || $id == "Jukebot" || $id == "Hot Tub" || $id == "Vertical Wind Tunnel" || $id == "Monument Base" || $id == "Monument Midsection" || $id == "Monument Top" || $id == "Materials Study Terminal" || $id == "Interplanetary Launcher" || $id == "Spacefarer Module" || $id == "Basic Nosecone" || $id == "Drillcone" || $id == "Large Liquid Fuel Tank" || $id == "Small Solid Oxidizer Tank" || $id == "Large Solid Oxidizer Tank" || $id == "Large Oxidizer Tank SO" || $id == "Large Cargo Bay" || $id == "Large Liquid Cargo Tank" || $id == "Large Gas Cargo Canister" || $id == "Cartographic Module" || $id == "Liquid Fuel Tank" || $id == "Solid Oxidizer Tank" || $id == "Liquid Oxidizer Tank" || $id == "Cargo Bay" || $id == "Gas Cargo Canister" || $id == "Liquid Cargo Tank" || $id == "Command Capsule" || $id == "Sight-Seeing Module" || $id == "Research Module" || $id == "Biological Cargo Bay" || $id == "Research Reactor" || $id == "Gantry") {
    
$left = 1;    
}   
    
if ($id == "Solar Panel" || $id == "Botanical Analyzer" || $id == "Rocket Platform" || $id == "Steam Engine SO" || $id == "Petroleum Engine SO" || $id == "Radbolt Engine" || $id == "Hydrogen Engine SO" || $id == "Steam Engine" || $id == "Petroleum Engine" || $id == "Solid Fuel Thruster" || $id == "Hydrogen Engine") {
    
$left = 2;
}
    
return $left;
}


function plantCheck($id) {
    
// 1 = Maturity
// 2 = AirPressure
// 3 = Temperature
// 4 = OldAge
// 5 = Fertilization
// 6 = Irrigation
// 7 = Illumination
    
if ($id == "Plants Arbor Tree") { $id = "ForestTree"; $amounts = array(1,2,3,4,5,6); }
if ($id == "Plants Balm Lily") {  $amounts = array(1,2,3,4); }
if ($id == "Plants Brissleblossom") { $id = "PrickleFlower"; $amounts = array(1,2,3,4,6,7); }
if ($id == "Plants Muckroot") { $id = "BasicForagePlantPlanted"; $amounts = array(); }
if ($id == "Plants Dasha Salt") { $id = "SaltPlant"; $amounts = array(1,2,3,4,5); }
if ($id == "Plants Dusk Cap") { $id = "MushroomPlant"; $amounts = array(1,2,3,4,5,7); }
if ($id == "Plants Gas Grass") { $id = "GasGrass"; $amounts = array(1,2,3,4,6); }
if ($id == "Plants Hexalent") { $id = "ForestForagePlantPlanted"; $amounts = array(); }
if ($id == "Plants Mealwood") { $id = "BasicSingleHarvestPlant"; $amounts = array(1,2,3,4,5); }
if ($id == "Plants Noshsprout") { $id = "BeanPlant"; $amounts = array(1,2,3,4,5,6); }
if ($id == "Plants Oxyfern") { $id = "Oxyfern"; $amounts = array(2,3,5,6); }
if ($id == "Plants Pincha Pepper") { $id = "SpiceVine"; $amounts = array(1,2,3,4,5,6); }
if ($id == "Plants Sleetwheat") { $id = "ColdWheat"; $amounts = array(1,2,3,4,5,6,); }
if ($id == "Plants Thimblereed") { $id = "BasicFabricPlant"; $amounts = array(1,2,3,4,6); }
if ($id == "Plants Waterweed") { $id = "SeaLettuce"; $amounts = array(1,2,3,4,5,6); }
if ($id == "Plants Wheezewort") { $id = "ColdBreather"; $amounts = array(3,5); }
if ($id == "Plants Bluff Briar") { $id = "PrickleGrass"; $amounts = array(2,3); }
if ($id == "Plants Buddy Budd") { $id = "BulbPlant"; $amounts = array(2,3); }
if ($id == "Plants Jumping Joya") { $id = "CactusPlant"; $amounts = array(2,3); }
if ($id == "Plants Mirth Leaf") { $id = "LeafyPlant"; $amounts = array(2,3); }
if ($id == "Plants Sporechid") { $id = "EvilFlower"; $amounts = array(2,3); }
if ($id == "Plants Bog Bucket") { $id = "SwampHarvestPlant"; $amounts = array(1,2,3,4,6,7); }
if ($id == "Plants Grubfruit") { $id = "SuperWormPlant"; $amounts = array(1,2,3,4,5); }
if ($id == "Plants Saturn Critter") { $id = "CritterTrapPlant"; $amounts = array(1,2,3,4,6); }
if ($id == "Plants Spindly Grub") { $id = "WormPlant"; $amounts = array(1,2,3,4,5); }
if ($id == "Plants Swamp Chard") { $id = "SwampForagePlantPlanted"; $amounts = array(); }
if ($id == "Plants Bliss Burst") { $id = "Cylindrica"; $amounts = array(2,3); }
if ($id == "Plants Mellow Mallow") { $id = "WineCups"; $amounts = array(2,3); }
if ($id == "Plants Tranquil Toes") { $id = "ToePlant"; }
if ($id == "Plants Hydrocactus") { $id = "FilterPlant"; $amounts = array(1,2,3,4,5,6); }    
    
return $amounts;  
}


function checkCell($cell) {
    
$result = 0;    
    
$cellArray = array("Tile", "InsulationTile", "PlasticTile", "MetalTile", "GlassTile", "BunkerTile", "CarpetTile", "ManualPressureDoor", "PressureDoor");
    
for ($a=0; $a<count($cellArray); $a++) {
    
if ($cell == $cellArray[$a]) { $result = 1; break; }    
}

return $result;
}

function temperatureConvert($temperature, $type) {
    
if ($type == "C") { $temperature = $temperature + 273.15; }
if ($type == "F") { $temperature = ($temperature - 32) * 5/9 + 273.15; }

return floatval($temperature);
}

function yamlID($id) {
if ($id == "Plastic Ladder") { $id = "LadderFast"; }
if ($id == "Airflow Tile") { $id = "GasPermeableMembrane"; }
if ($id == "Insulated Tile") { $id = "InsulationTile"; }
if ($id == "Window Tile") { $id = "GlassTile"; }
if ($id == "Carpeted Tile") { $id = "CarpetTile"; }
if ($id == "Pneumatic Door") { $id = "Door"; }
if ($id == "Manual Airlock") { $id = "ManualPressureDoor"; }
if ($id == "Mechanized Airlock") { $id = "PressureDoor"; }
if ($id == "Transit Tube") { $id = "TravelTube"; }
if ($id == "Transit Tube Access") { $id = "TravelTubeEntrance"; }
if ($id == "Transit Tube Crossing") { $id = "TravelTubeWallBridge"; }
if ($id == "Oxygen Diffuser") { $id = "MineralDeoxidizer"; }
if ($id == "Algae Terrarium") { $id = "AlgaeHabitat"; }
if ($id == "Deodorizer") { $id = "AirFilter"; }
if ($id == "Carbon Skimmer") { $id = "CO2Scrubber"; }
if ($id == "Coal Generator") { $id = "Generator"; }
if ($id == "Wood Burner") { $id = "WoodGasGenerator"; }
if ($id == "Natural Gas Generator") { $id = "MethaneGenerator"; }
if ($id == "Steam Turbine") { $id = "SteamTurbine2"; }
if ($id == "Heavi-Watt Wire") { $id = "HighWattageWire"; }
if ($id == "Heavi-Watt Joint Plate") { $id = "WireBridgeHighWattage"; }
if ($id == "Conductive Wire") { $id = "WireRefined"; }
if ($id == "Conductive Wire Bridge") { $id = "WireRefinedBridge"; }
if ($id == "Heavi-Watt Conductive Wire") { $id = "WireRefinedhighWattage"; }
if ($id == "Heavi-Watt Conductive Joint Plate") { $id = "WireRefinedBridgeHighWattage"; }
if ($id == "Jumbo Battery") { $id = "BatteryMedium"; }
if ($id == "Smart Battery") { $id = "BatterySmart"; }
if ($id == "Power Transformer") { $id = "PowerTransformerSmall"; }
if ($id == "Large Power Transformer") { $id = "PowerTransformer"; }
if ($id == "Power Shutoff") { $id = "LogicPowerRelay"; }
if ($id == "Electric Grill") { $id = "CookingStation"; }
if ($id == "Gas Range") { $id = "GourmetCookingStation"; }
if ($id == "Critter Drop-off") { $id = "CreatureDeliveryPoint"; }
if ($id == "Fish Release") { $id = "FishDeliveryPoint"; }
if ($id == "Critter Feeder") { $id = "CreatureFeeder"; }
if ($id == "Incubator") { $id = "EggIncubator"; }
if ($id == "Critter Trap") { $id = "CreatureTrap"; }
if ($id == "Airborne Critter Bait") { $id = "FlyingCreatureBait"; }
if ($id == "Lavatory") { $id = "FlushToilet"; }
if ($id == "Pitcher Pump") { $id = "LiquidPumpingStation"; }
if ($id == "Liquid Pipe") { $id = "LiquidConduit"; }
if ($id == "Insulated Liquid Pipe") { $id = "InsulatedLiquidConduit"; }
if ($id == "Radiant Liquid Pipe") { $id = "LiquidConduitRadiant"; }
if ($id == "Liquid Bridge") { $id = "LiquidConduitBridge"; }
if ($id == "Mini Liquid Pump") { $id = "LiquidMiniPump"; }
if ($id == "Liquid Shutoff") { $id = "LiquidLogicValve"; }
if ($id == "Liquid Meter Valve") { $id = "LiquidLimitValve"; }
if ($id == "Liquid Pipe Element Sensor") { $id = "LiquidConduitElementSensor"; }
if ($id == "Liquid Pipe Germ Sensor") { $id = "LiquidConduitDiseaseSensor"; }
if ($id == "Liquid Pipe Thermo Sensor") { $id = "LiquidConduitTemperatureSensor"; }
if ($id == "Liquid Rocket Port Loader") { $id = "ModularLaunchpadPortLiquid"; }
if ($id == "Liquid Rocket Port Unloader") { $id = "ModularLaunchpadPortLiquidUnloader"; }
if ($id == "Gas Pipe") { $id = "GasConduit"; }
if ($id == "Insulated Gas Pipe") { $id = "InsulatedGasConduit"; }
if ($id == "Radiant Gas Pipe") { $id = "GasConduitRadiant"; }
if ($id == "Gas Bridge") { $id = "GasConduitBridge"; }
if ($id == "Mini Gas Pump") { $id = "GasMiniPump"; }
if ($id == "High Pressure Gas Vent") { $id = "GasVentHighPressure"; }
if ($id == "Gas Shutoff") { $id = "GasLogicValve"; }
if ($id == "Gas Meter Valve") { $id = "GasLimitValve"; }
if ($id == "Canister Filler") { $id = "GasBottler"; }
if ($id == "Canister Emptier") { $id = "BottleEmptierGas"; }
if ($id == "Gas Rocket Port Loader") { $id = "ModularLaunchpadPortGas"; }
if ($id == "Gas Rocket Port Unloader") { $id = "ModularLaunchpadPortGasUnloader"; }
if ($id == "Gas Pipe Element Sensor") { $id = "GasConduitElementSensor"; }
if ($id == "Gas Pipe Germ Sensor") { $id = "GasConduitDiseaseSensor"; }
if ($id == "Gas Pipe Thermo Sensor") { $id = "GasConduitTemperatureSensor"; }
if ($id == "Water Sieve") { $id = "WaterPurifier"; }
if ($id == "Fertilizer Synthesizer") { $id = "FertilizerMaker"; }
if ($id == "Algae Distiller") { $id = "AlgaeDistillery"; }
if ($id == "Ethanol Distiller") { $id = "EthanolDistillery"; }
if ($id == "Polymer Press") { $id = "Polymerizer"; }
if ($id == "Molecular Forge") { $id = "SupermaterialRefinery"; }
if ($id == "Sink") { $id = "WashSink"; }
if ($id == "Sick Bay") { $id = "DoctorStation"; }
if ($id == "Disease Clinic") { $id = "AdvancedDoctorStation"; }
if ($id == "Triage Cot") { $id = "MedicalCot"; }
if ($id == "Tasteful Memorial") { $id = "Grave"; }
if ($id == "Comfy Bed") { $id = "LuxuryBed"; }
if ($id == "Lamp") { $id = "FloorLamp"; }
if ($id == "Mess Table") { $id = "DiningTable"; }
if ($id == "Jukebot") { $id = "Phonobox"; }
if ($id == "Arcade Cabinet") { $id = "ArcadeMachine"; }
if ($id == "Party Line Phone") { $id = "Telephone"; }
if ($id == "Flower Pot") { $id = "FlowerVase"; }
if ($id == "Wall Pot") { $id = "FlowerVaseWall"; }
if ($id == "Hanging Pot") { $id = "FlowerVaseHanging"; }
if ($id == "Aero Pot") { $id = "FlowerVaseHangingFancy"; }
if ($id == "Sculpting Block") { $id = "SmallSculpture"; }
if ($id == "Large Sculpting Block") { $id = "Sculpture"; }
if ($id == "Marble Block") { $id = "MarbleSculpture"; }
if ($id == "Metal Block") { $id = "MetalSculpture"; }
if ($id == "Blank Canvas") { $id = "Canvas"; }
if ($id == "Landscape Canvas") { $id = "CanvasWide"; }
if ($id == "Portrait Canvas") { $id = "CanvasTall"; }
if ($id == "Pedestal") { $id = "ItemPedestal"; }
if ($id == "Monument Base") { $id = "MonumentBottom"; }
if ($id == "Monument Midsection") { $id = "MonumentMiddle"; }
if ($id == "Research Station") { $id = "ResearchCenter"; }
if ($id == "Super Computer") { $id = "AdvancedResearchCenter"; }
if ($id == "Orbital Data Collection Lab") { $id = "OrbitalResearchCenter"; }
if ($id == "Materials Study Terminal") { $id = "NuclearResearchCenter"; }
if ($id == "Virtual Planetarium") { $id = "DLC1CosmicResearchCenter"; }
if ($id == "Botanical Analyzer") { $id = "GeneticAnalysisStation"; }
if ($id == "Grooming Station") { $id = "RanchStation"; }
if ($id == "Skill Scrubber") { $id = "ResetSkillsStation"; }
if ($id == "Crafting Station") { $id = "CraftingTable"; }
if ($id == "Textile Loom") { $id = "ClothingFabricator"; }
if ($id == "Clothing Refashionator") { $id = "ClothingAlterationStation"; }
if ($id == "Exosuit Forge") { $id = "SuitFabricator"; }
if ($id == "Oxygen Mask Checkpoint") { $id = "OxygenMaskMarker"; }
if ($id == "Oxygen Mask Dock") { $id = "OxygenMaskDock"; }
if ($id == "Atmo Suit Checkpoint") { $id = "SuitMarker"; }
if ($id == "Atmo Suit Dock") { $id = "SuitLocker"; }
if ($id == "Jet Suit Checkpoint") { $id = "JetSuitMarker"; }
if ($id == "Jet Suit Dock") { $id = "JetSuitLocker"; }
if ($id == "Lead Suit Checkpoint") { $id = "LeadSuitMarker"; }
if ($id == "Lead Suit Dock") { $id = "LeadSuitLocker"; }
if ($id == "Liquid Tepidizer") { $id = "LiquidHeater"; }
if ($id == "Ice-E Fan") { $id = "IceCooledFan"; }
if ($id == "Ice Maker") { $id = "IceMachine"; }
if ($id == "Thermo Regulator") { $id = "AirConditioner"; }
if ($id == "Thermo Aquatuner") { $id = "LiquidConditioner"; }
if ($id == "OilWell") { $id = "OilWellCap"; }
if ($id == "Tempshift Plate") { $id = "ThermalBlock"; }
if ($id == "Drywall") { $id = "ExteriorWall"; }
if ($id == "Sweepy Dock") { $id = "SweepBotStation"; }
if ($id == "Automation Wire") { $id = "LogicWire"; }
if ($id == "Automation Wire Bridge") { $id = "LogicWireBridge"; }
if ($id == "Automation Ribbon") { $id = "LogicRibbon"; }
if ($id == "Automation Ribbon Bridge") { $id = "LogicRibbonBridge"; }
if ($id == "Signal Switch") { $id = "LogicSwitch"; }
if ($id == "Duplicant Motion Sensor") { $id = "LogicDuplicantSensor"; }
if ($id == "Atmo Sensor") { $id = "LogicPressureSensorGas"; }
if ($id == "Hydro Sensor") { $id = "LogicPressureSensorLiquid"; }
if ($id == "Thermo Sensor") { $id = "LogicTemperatureSensor"; }
if ($id == "Wattage Sensor") { $id = "LogicWattageSensor"; }
if ($id == "Cycle Sensor") { $id = "LogicTimeOfDaySensor"; }
if ($id == "Timer Sensor") { $id = "LogicTimerSensor"; }
if ($id == "Germ Sensor") { $id = "LogicDiseaseSensor"; }
if ($id == "Gas Element Sensor") { $id = "LogicElementSensorGas"; }
if ($id == "Liquid Element Sensor") { $id = "LogicElementSensorLiquid"; }
if ($id == "Critter Sensor") { $id = "LogicCritterCountSensor"; }
if ($id == "Radiation Sensor") { $id = "LogicRadiationSensor"; }
if ($id == "Radbolt Sensor") { $id = "LogicHEPSensor"; }
if ($id == "Signal Counter") { $id = "LogicCounter"; }
if ($id == "Automated Notifier") { $id = "LogicAlarm"; }
if ($id == "Hammer") { $id = "LogicHammer"; }
if ($id == "Automation Broadcaster") { $id = "LogicInterasteroidSender"; }
if ($id == "Automation Receiver") { $id = "LogicInterasteroidReceiver"; }
if ($id == "Ribbon Reader") { $id = "LogicRibbonReader"; }
if ($id == "Ribbon Writer") { $id = "LogicRibbonWriter"; }
if ($id == "Weight Plate") { $id = "FloorSwitch"; }
if ($id == "Duplicant Checkpoint") { $id = "Checkpoint"; }
if ($id == "Space Scanner") { $id = "CometDetector"; }
if ($id == "NOT Gate") { $id = "LogicGateNOT"; }
if ($id == "AND Gate") { $id = "LogicGateAND"; }
if ($id == "OR Gate") { $id = "LogicGateOR"; }
if ($id == "BUFFER Gate") { $id = "LogicGateBUFFER"; }
if ($id == "FILTER Gate") { $id = "LogicGateFILTER"; }
if ($id == "XOR Gate") { $id = "LogicGateXOR"; }
if ($id == "Memory Toggle") { $id = "LogicMemory"; }
if ($id == "Signal Selector") { $id = "LogicGateMultiplexer"; }
if ($id == "Signal Distributor") { $id = "LogicGateDemultiplexer"; }
if ($id == "Auto-Sweeper") { $id = "SolidTransferArm"; }
if ($id == "Conveyor Rail") { $id = "SolidConduit"; }
if ($id == "Conveyor Bridge") { $id = "SolidConduitBridge"; }
if ($id == "Conveyor Loader") { $id = "SolidConduitInbox"; }
if ($id == "Conveyor Receptacle") { $id = "SolidConduitOutbox"; }
if ($id == "Conveyor Chute") { $id = "SolidVent"; }
if ($id == "Conveyor Shutoff") { $id = "SolidLogicValve"; }
if ($id == "Conveyor Meter") { $id = "SolidLimitValve"; }
if ($id == "Conveyor Rail Germ Sensor") { $id = "SolidConduitDiseaseSensor"; }
if ($id == "Conveyor Rail Element Sensor") { $id = "SolidConduitElementSensor"; }
if ($id == "Conveyor Rail Thermo Sensor") { $id = "SolidConduitTemperatureSensor"; }
if ($id == "Robo-Miner") { $id = "AutoMiner"; }
if ($id == "Solid Rocket Port Loader") { $id = "ModularLaunchpadPortSolid"; }
if ($id == "Solid Rocket Port Unloader") { $id = "ModularLaunchpadPortSolidUnloader"; }
if ($id == "Telescope") { $id = "ClusterTelescope"; }
if ($id == "Enclosed Telescope") { $id = "ClusterTelescopeEnclosed"; }
if ($id == "Interplanetary Launcher") { $id = "RailGun"; }
if ($id == "Payload Opener") { $id = "RailGunPayloadOpener"; }
if ($id == "Targeting Beacon") { $id = "LandingBeacon"; }
if ($id == "Basic Nosecone") { $id = "NoseconeBasic"; }
if ($id == "Drillcone") { $id = "NoseconeHarvest"; }
if ($id == "Solo Spacefarer Nosecone") { $id = "HabitatModuleSmall"; }
if ($id == "Rocket Platform") { $id = "LaunchPad"; }
if ($id == "Carbon Dioxide Engine") { $id = "CO2Engine"; }
if ($id == "Steam Engine SO") { $id = "SteamEngineCluster"; }
if ($id == "Small Petroleum Engine") { $id = "KeroseneEngineClusterSmall"; }
if ($id == "Petroleum Engine SO") { $id = "KeroseneEngineCluster"; }
if ($id == "Radbolt Engine") { $id = "HEPEngine"; }
if ($id == "Hydrogen Engine SO") { $id = "HydrogenEngineCluster"; }
if ($id == "Rovers Module") { $id = "ScoutModule"; }
if ($id == "Trailblazer Module") { $id = "PioneerModule"; }
if ($id == "Large Liquid Fuel Tank") { $id = "LiquidFuelTankCluster"; }
if ($id == "Small Solid Oxidizer Tank") { $id = "SmallOxidizerTank"; }
if ($id == "Large Solid Oxidizer Tank") { $id = "OxidizerTankCluster"; }
if ($id == "Liquid Oxidizer Tank SO") { $id = "OxidizerTankLiquidCluster"; }
if ($id == "Cargo Bay SO") { $id = "SolidCargoBaySmall"; }
if ($id == "Liquid Cargo Tank SO") { $id = "LiquidCargoBaySmall"; }
if ($id == "Gas Cargo Canister SO") { $id = "GasCargoBaySmall"; }
if ($id == "Large Cargo Bay") { $id = "CargoBayCluster"; }
if ($id == "Large Liquid Cargo Tank") { $id = "LiquidCargoBayCluster"; }
if ($id == "Large Gas Cargo Canister") { $id = "GasCargoBayCluster"; }
if ($id == "Artifact Transport Module") { $id = "ArtifactCargoBay"; }
if ($id == "Cartographic Module") { $id = "ScannerModule"; }
if ($id == "Spacefarer Module") { $id = "HabitatModuleMedium"; }
if ($id == "Power Outlet Fitting") { $id = "RocketInteriorPowerPlug"; }
if ($id == "Liquid Input Fitting") { $id = "RocketInteriorLiquidInput"; }
if ($id == "Liquid Output Fitting") { $id = "RocketInteriorLiquidOutput"; }
if ($id == "Gas Input Fitting") { $id = "RocketInteriorGasInput"; }
if ($id == "Gas Output Fitting") { $id = "RocketInteriorGasOutput"; }
if ($id == "Conveyor Loader Fitting") { $id = "RocketInteriorSolidInput"; }
if ($id == "Conveyor Receptacle Fitting") { $id = "RocketInteriorSolidOutput"; }
if ($id == "Starmap Location Sensor") { $id = "LogicClusterLocationSensor"; }
if ($id == "Petroleum Engine") { $id = "KeroseneEngine"; }
if ($id == "Solid Fuel Thruster") { $id = "SolidBooster"; }
if ($id == "Solid Oxidizer Tank") { $id = "OxidizerTank"; }
if ($id == "Liquid Oxidizer Tank") { $id = "OxidizerTankLiquid"; }
if ($id == "Gas Cargo Canister") { $id = "GasCargoBay"; }
if ($id == "Liquid Cargo Tank") { $id = "LiquidCargoBay"; }
if ($id == "Command Capsule") { $id = "CommandModule"; }
if ($id == "Sight-Seeing Module") { $id = "TouristModule"; }
if ($id == "Biological Cargo Bay") { $id = "SpecialCargoBay"; }
    
if ($id == "Geysers Carbon Dioxide Geyser") { $id = "GeyserGeneric_liquid_co2"; }
if ($id == "Geysers Cool Salt Slush Geyser") { $id = "GeyserGeneric_slush_salt_water"; }
if ($id == "Geysers Cool Slush Geyser") { $id = "GeyserGeneric_slush_water"; }
if ($id == "Geysers Leaky Oil Fissure") { $id = "GeyserGeneric_oil_drip"; }
if ($id == "Geysers Polluted Water Vent") { $id = "GeyserGeneric_filthy_water"; }
if ($id == "Geysers Salt Water Geyser") { $id = "GeyserGeneric_salt_water"; }
if ($id == "Geysers Sulfur Geyser") { $id = "GeyserGeneric_liquid_sulfur"; }
if ($id == "Geysers Water Geyser") { $id = "GeyserGeneric_hot_water"; }            
if ($id == "Geysers Carbon Dioxide Vent") { $id = "GeyserGeneric_hot_co2"; }
if ($id == "Geysers Chlorine Gas Vent") { $id = "GeyserGeneric_chlorine_gas"; }
if ($id == "Geysers Cool Steam Vent") { $id = "GeyserGeneric_steam"; }
if ($id == "Geysers Hot Polluted Oxygen Vent") { $id = "GeyserGeneric_hot_po2"; }
if ($id == "Geysers Hydrogen Vent") { $id = "GeyserGeneric_hot_hydrogen"; }
if ($id == "Geysers Infectious Polluted Oxyegn Vent") { $id = "GeyserGeneric_slimy_po2"; }
if ($id == "Geysers Natural Gas Geyser") { $id = "GeyserGeneric_methane"; }
if ($id == "Geysers Steam Vent") { $id = "GeyserGeneric_hot_steam"; }
if ($id == "Geysers Minor Volcano") { $id = "GeyserGeneric_small_volcano"; }
if ($id == "Geysers Volcano") { $id = "GeyserGeneric_big_volcano"; }
if ($id == "Geysers Aluminum Volcano") { $id = "GeyserGeneric_molten_aluminum"; }
if ($id == "Geysers Cobalt Volcano") { $id = "GeyserGeneric_molten_cobalt"; }
if ($id == "Geysers Copper Volcano") { $id = "GeyserGeneric_molten_copper"; }
if ($id == "Geysers Gold Volcano") { $id = "GeyserGeneric_molten_gold"; }
if ($id == "Geysers Iron Volcano") { $id = "GeyserGeneric_molten_iron"; }
if ($id == "Geysers Niobium Volcano") { $id = "GeyserGeneric_molten_niobium"; }
if ($id == "Geysers Tungsten Volcano") { $id = "GeyserGeneric_molten_tungsten"; }

if ($id == "Plants Arbor Tree") { $id = "ForestTree"; }
if ($id == "Plants Balm Lily") { $id = "SwampLily"; }
if ($id == "Plants Brissleblossom") { $id = "PrickleFlower"; }
if ($id == "Plants Muckroot") { $id = "BasicForagePlantPlanted"; }
if ($id == "Plants Dasha Salt") { $id = "SaltPlant"; }
if ($id == "Plants Dusk Cap") { $id = "MushroomPlant"; }
if ($id == "Plants Gas Grass") { $id = "GasGrass"; }
if ($id == "Plants Hexalent") { $id = "ForestForagePlantPlanted"; }
if ($id == "Plants Mealwood") { $id = "BasicSingleHarvestPlant"; }
if ($id == "Plants Noshsprout") { $id = "BeanPlant"; }
if ($id == "Plants Oxyfern") { $id = "Oxyfern"; }
if ($id == "Plants Pincha Pepper") { $id = "SpiceVine"; }
if ($id == "Plants Sleetwheat") { $id = "ColdWheat"; }
if ($id == "Plants Thimblereed") { $id = "BasicFabricPlant"; }
if ($id == "Plants Waterweed") { $id = "SeaLettuce"; }
if ($id == "Plants Wheezewort") { $id = "ColdBreather"; }
if ($id == "Plants Bluff Briar") { $id = "PrickleGrass"; }
if ($id == "Plants Buddy Budd") { $id = "BulbPlant"; }
if ($id == "Plants Jumping Joya") { $id = "CactusPlant"; }
if ($id == "Plants Mirth Leaf") { $id = "LeafyPlant"; }
if ($id == "Plants Sporechid") { $id = "EvilFlower"; }
if ($id == "Plants Bog Bucket") { $id = "SwampHarvestPlant"; }
if ($id == "Plants Grubfruit") { $id = "SuperWormPlant"; }
if ($id == "Plants Saturn Critter") { $id = "CritterTrapPlant"; }
if ($id == "Plants Spindly Grub") { $id = "WormPlant"; }
if ($id == "Plants Swamp Chard") { $id = "SwampForagePlantPlanted"; }
if ($id == "Plants Bliss Burst") { $id = "Cylindrica"; }
if ($id == "Plants Mellow Mallow") { $id = "WineCups"; }
if ($id == "Plants Tranquil Toes") { $id = "ToePlant"; }
if ($id == "Plants Hydrocactus") { $id = "FilterPlant"; }

if ($id == "Gases Oxygen") { $id = "Oxygen"; }
if ($id == "Gases Polluted Oxygen") { $id = "ContaminatedOxygen"; }
if ($id == "Gases Carbon Dioxide") { $id = "CarbonDioxide"; }
if ($id == "Gases Chlorine") { $id = "ChlorineGas"; }
if ($id == "Gases Hydrogen") { $id = "Hydrogen"; }
if ($id == "Gases Natural Gas") { $id = "Methane"; }
if ($id == "Gases Propane") { $id = "Propane"; }
if ($id == "Gases Sour Gas") { $id = "SourGas"; }
if ($id == "Gases Steam") { $id = "Steam"; }
if ($id == "Gases Ethanol") { $id = "EthanolGas"; }
if ($id == "Gases Super Coolant") { $id = "SuperCoolantGas"; }
if ($id == "Gases Nuclear Fallout") { $id = "Fallout"; }
if ($id == "Gases Aluminum") { $id = "AluminumGas"; }
if ($id == "Gases Cobalt") { $id = "CobaltGas"; }
if ($id == "Gases Copper") { $id = "CopperGas"; }
if ($id == "Gases Gold") { $id = "GoldGas"; }
if ($id == "Gases Iron") { $id = "IronGas"; }
if ($id == "Gases Lead") { $id = "LeadGas"; }
if ($id == "Gases Niobium") { $id = "NiobiumGas"; }
if ($id == "Gases Steel") { $id = "SteelGas"; }
if ($id == "Gases Tungsten") { $id = "TungstenGas"; }
if ($id == "Gases Carbon") { $id = "CarbonGas"; }
if ($id == "Gases Phosphorus") { $id = "PhosphorusGas"; }
if ($id == "Gases Sulfur") { $id = "SulfurGas"; }
if ($id == "Gases Rock Gas") { $id = "RockGas"; }
if ($id == "Gases Salt Gas") { $id = "SaltGas"; }
if ($id == "Gases Helium") { $id = "Helium"; }
if ($id == "Gases Mercury") { $id = "MercuryGas"; }

if ($id == "Liquids Brine") { $id = "Brine"; }
if ($id == "Liquids Crude Oil") { $id = "CrudeOil"; }
if ($id == "Liquids Ethanol") { $id = "Ethanol"; }
if ($id == "Liquids Magma") { $id = "Magma"; }
if ($id == "Liquids Nuclear Waste") { $id = "NuclearWaste"; }
if ($id == "Liquids Petroleum") { $id = "Petroleum"; }
if ($id == "Liquids Polluted Water") { $id = "DirtyWater"; }
if ($id == "Liquids Salt Water") { $id = "SaltWater"; }
if ($id == "Liquids Super Coolant") { $id = "SuperCoolant"; }
if ($id == "Liquids Visco-Gel") { $id = "ViscoGel"; }
if ($id == "Liquids Water") { $id = "Water"; }
if ($id == "Liquids Liquid Carbon Dioxide") { $id = "LiquidCarbonDioxide"; }
if ($id == "Liquids Liquid Chlorine") { $id = "Chlorine"; }
if ($id == "Liquids Liquid Hydrogen") { $id = "LiquidHydrogen"; }
if ($id == "Liquids Liquid Oxygen") { $id = "LiquidOxygen"; }
if ($id == "Liquids Liquid Propane") { $id = "LiquidPropane"; }
if ($id == "Liquids Methane") { $id = "LiquidMethane"; }
if ($id == "Liquids Liquid Cobalt") { $id = "MoltenCobalt"; }
if ($id == "Liquids Liquid Copper") { $id = "MoltenCopper"; }
if ($id == "Liquids Liquid Gold") { $id = "MoltenGold"; }
if ($id == "Liquids Liquid Iron") { $id = "MoltenIron"; }
if ($id == "Liquids Liquid Niobium") { $id = "MoltenNiobium"; }
if ($id == "Liquids Liquid Steel") { $id = "MoltenSteel"; }
if ($id == "Liquids Liquid Tungsten") { $id = "MoltenTungsten"; }
if ($id == "Liquids Molten Aluminum") { $id = "MoltenAluminum"; }
if ($id == "Liquids Molten Lead") { $id = "MoltenLead"; }
if ($id == "Liquids Liquid Carbon") { $id = "MoltenCarbon"; }
if ($id == "Liquids Liquid Phosphorus") { $id = "LiquidPhosphorus"; }
if ($id == "Liquids Liquid Resin") { $id = "Resin"; }
if ($id == "Liquids Liquid Sucrose") { $id = "MoltenSucrose"; }
if ($id == "Liquids Liquid Sulfur") { $id = "LiquidSulfur"; }
if ($id == "Liquids Liquid Uranium") { $id = "MoltenUranium"; }
if ($id == "Liquids Molten Glass") { $id = "MoltenGlass"; }
if ($id == "Liquids Molten Salt") { $id = "MoltenSalt"; }
if ($id == "Liquids Naphtha") { $id = "Naphtha"; }  
if ($id == "Liquids ") { $id = "LiquidHelium"; }
if ($id == "Liquids ") { $id = "Mercury"; }

if ($id == "Natural Tile Fertilizer") { $id = "Fertilizer"; }   
if ($id == "Natural Tile Phosphorite") { $id = "Phosphorite"; }
if ($id == "Natural Tile Crushed Rock") { $id = "CrushedRock"; }
if ($id == "Natural Tile Ceramic") { $id = "Ceramic"; }
if ($id == "Natural Tile Fossil") { $id = "Fossil"; }
if ($id == "Natural Tile Granite") { $id = "Granite"; }
if ($id == "Natural Tile Graphite") { $id = "Graphite"; }
if ($id == "Natural Tile Igneous Rock") { $id = "IgneousRock"; }
if ($id == "Natural Tile Mafic Rock") { $id = "MaficRock"; }
if ($id == "Natural Tile Obsidian") { $id = "Obsidian"; }
if ($id == "Natural Tile Sandstone") { $id = "SandStone"; }
if ($id == "Natural Tile Sedimentary Rock") { $id = "SedimentaryRock"; }    
if ($id == "Natural Tile Bleach Stone") { $id = "BleachStone"; }
if ($id == "Natural Tile Coal") { $id = "Carbon"; }
if ($id == "Natural Tile Lime") { $id = "Lime"; }
if ($id == "Natural Tile Oxylite") { $id = "OxyRock"; }
if ($id == "Natural Tile Phosphorus") { $id = "Phosphorus"; }
if ($id == "Natural Tile Refined Carbon") { $id = "RefinedCarbon"; }
if ($id == "Natural Tile Rust") { $id = "Rust"; }   
if ($id == "Natural Tile Salt") { $id = "Salt"; }
if ($id == "Natural Tile Sucrose") { $id = "Sucrose"; }    
if ($id == "Natural Tile Clay") { $id = "Clay"; }   
if ($id == "Natural Tile Dirt") { $id = "Dirt"; }  
if ($id == "Natural Tile Regolith") { $id = "Regolith"; }
if ($id == "Natural Tile Sand") { $id = "Sand"; }   
if ($id == "Natural Tile Brine Ice") { $id = "BrineIce"; }   
if ($id == "Natural Tile Crushed Ice") { $id = "CrushedIce"; } 
if ($id == "Natural Tile Ice") { $id = "Ice"; }
if ($id == "Natural Tile Polluted Ice") { $id = "DirtyIce"; }
if ($id == "Natural Tile Snow") { $id = "Snow"; }  
if ($id == "Natural Tile Solid Carbon Dioxide") { $id = "SolidCarbonDioxide"; }
if ($id == "Natural Tile Solid Chlorine") { $id = "SolidChlorine"; }
if ($id == "Natural Tile Solid Crude Oil") { $id = "SolidCrudeOil"; }
if ($id == "Natural Tile Solid Ethanol") { $id = "SolidEthanol"; }
if ($id == "Natural Tile Solid Hydrogen") { $id = "SolidHydrogen"; }
if ($id == "Natural Tile Solid Mercury") { $id = "SolidMercury"; }
if ($id == "Natural Tile Solid Methane") { $id = "SolidMethane"; }
if ($id == "Natural Tile Solid Naphtha") { $id = "SolidNaphtha"; }
if ($id == "Natural Tile Solid Oxygen") { $id = "SolidOxygen"; }
if ($id == "Natural Tile Solid Petroleum") { $id = "SolidPetroleum"; }
if ($id == "Natural Tile Solid Propane") { $id = "SolidPropane"; }
if ($id == "Natural Tile Enriched Uranium") { $id = "EnrichedUranium"; }
if ($id == "Natural Tile Glass") { $id = "Glass"; }
if ($id == "Natural Tile Insulation") { $id = "SuperInsulator"; }  
if ($id == "Natural Tile Plastic") { $id = "Polypropylene"; } 
if ($id == "Natural Tile Solid Super Coolant") { $id = "SolidSuperCoolant"; }
if ($id == "Natural Tile Solid Visco-Gel") { $id = "SolidViscoGel"; }  
if ($id == "Natural Tile Steel") { $id = "Steel"; }
if ($id == "Natural Tile Thermium") { $id = "TempConductorSolid"; }
if ($id == "Natural Tile Aluminum Ore") { $id = "AluminumOre"; }
if ($id == "Natural Tile Cobalt Ore") { $id = "Cobaltite"; }
if ($id == "Natural Tile Copper Ore") { $id = "Cuprite"; }
if ($id == "Natural Tile Electrum") { $id = "Electrum"; }
if ($id == "Natural Tile Gold Ore") { $id = "GoldAmalgam"; }
if ($id == "Natural Tile Iron Ore") { $id = "IronOre"; }
if ($id == "Natural Tile Pyrite") { $id = "FoolsGold"; }
if ($id == "Natural Tile Uranium Ore") { $id = "UraniumOre"; }
if ($id == "Natural Tile Wolframite") { $id = "Wolframite"; }
if ($id == "Natural Tile Algae") { $id = "Algae"; }
if ($id == "Natural Tile Mud") { $id = "Mud"; }  
if ($id == "Natural Tile Polluted Dirt") { $id = "ToxicSand"; }  
if ($id == "Natural Tile Polluted Mud") { $id = "ToxicMud"; }
if ($id == "Natural Tile Resin") { $id = "SolidResin"; }
if ($id == "Natural Tile Slime") { $id = "SlimeMold"; }   
if ($id == "Natural Tile Abyssalite") { $id = "Katairite"; }  
if ($id == "Natural Tile Corium") { $id = "Corium"; }
if ($id == "Natural Tile Diamond") { $id = "Diamond"; }
if ($id == "Natural Tile Solid Nuclear Waste") { $id = "SolidNuclearWaste"; }
if ($id == "Natural Tile Sulfur") { $id = "Sulfur"; }
if ($id == "Natural Tile Fullrene") { $id = "Fullerene"; }    
if ($id == "Natural Tile Isoresin") { $id = "Isoresin"; }    
if ($id == "Natural Tile Niobium") { $id = "Niobium"; }    
if ($id == "Natural Tile Aluminum") { $id = "Aluminum"; }    
if ($id == "Natural Tile Cobalt") { $id = "Cobalt"; }
if ($id == "Natural Tile Copper") { $id = "Copper"; }   
if ($id == "Natural Tile Depleted Uranium") { $id = "DepletedUranium"; }    
if ($id == "Natural Tile Gold") { $id = "Gold"; }    
if ($id == "Natural Tile Iron") { $id = "Iron"; }   
if ($id == "Natural Tile Lead") { $id = "Lead"; }    
if ($id == "Natural Tile Tungsten") { $id = "Tungsten"; }   
if ($id == "Natural Tile Neutronium") { $id = "Unobtanium"; }    
if ($id == "Natural Tile Bitumen") { $id = "Bitumen"; }    
if ($id == "Natural Tile Radium") { $id = "Radium"; }    
if ($id == "Natural Tile ") { $id = "Aerogel"; }
if ($id == "Natural Tile ") { $id = "Brick"; }
if ($id == "Natural Tile ") { $id = "Cement"; }
if ($id == "Natural Tile ") { $id = "CementMix"; }
if ($id == "Natural Tile ") { $id = "Katairite"; }
if ($id == "Natural Tile ") { $id = "PhosphateNodules"; }
if ($id == "Natural Tile ") { $id = "CarbonFibre"; }
if ($id == "Natural Tile ") { $id = "SandCement"; }
if ($id == "Natural Tile ") { $id = "Slabs"; }
if ($id == "Natural Tile ") { $id = "ToxicSand"; }
if ($id == "Natural Tile ") { $id = "Yellowcake"; }
if ($id == "Natural Tile ") { $id = "SolidSyngas"; }

if ($id == "Anti Entropy Thermo-Nullifier") { $id = "MassiveHeatSink"; }
if ($id == "Cryotank 3000") { $id = "CryoTank"; }
if ($id == "Lab Wall") { $id = "PropGravitasLabWall"; }
if ($id == "Lab Window") { $id = "PropGravitasLabWindowHorizontal"; }
if ($id == "Light Fixture") { $id = "PropLight"; }
if ($id == "Locker") { $id = "SetLocker"; }
if ($id == "Neural Vacillator") { $id = "GeneShuffler"; }
if ($id == "Old Computer Desk") { $id = "PropDesk"; }
if ($id == "Printing Pod") { $id = "Headquarters"; }
if ($id == "Security Door") { $id = "POIBunkerExteriorDoor"; }
if ($id == "Security Door Interior") { $id = "POIDoorInternal"; }
if ($id == "Supply Teleporter Input") { $id = "WarpConduitSender"; }
if ($id == "Supply Teleporter Output") { $id = "WarpConduitReceiver"; }
if ($id == "Table") { $id = "PropTable"; }
if ($id == "Teleporter Receiver") { $id = "WarpReceiver"; }
if ($id == "Teleporter Transmitter") { $id = "WarpPortal"; }
if ($id == "Vending Machine") { $id = "VendingMachine"; }

$id = str_replace(' ', '', $id);

return $id;
}

?>