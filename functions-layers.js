// Basic Functions ///////////////////////////////////////////////////////////////////////////
function diff(a,b){return Math.abs(a-b);}
// Basic Functions ///////////////////////////////////////////////////////////////////////////




// Grid Functions ///////////////////////////////////////////////////////////////////////////
function getSquare(grid, evt) {
 
    var rect = grid.getBoundingClientRect();
    return {
        x: 0 + (evt.clientX - rect.left) - (evt.clientX - rect.left)%30,
        y: 0 + (evt.clientY - rect.top) - (evt.clientY - rect.top)%30
       //y: 0 + ((evt.clientY * -1) + rect.bottom) - ((evt.clientY * -1) + rect.bottom)%30
    };
}

function drawGrid(context) {
    for (var squareX = 0; squareX < 1001; squareX += 30) {
      context.moveTo(squareX, 0);
      context.lineTo(squareX, 1000);
    }
    
    for (var squareY = 0; squareY < 1001; squareY += 30) {
      context.moveTo(0, squareY);
      context.lineTo(1000, squareY);
    }
}

function clearSquare(context, x, y) {
    context.clearRect(x,y,30,30);
}

function fillSquare(context, x, y, item){
// Adds image to current square and any adjacent squares neeeded.   
var img = document.getElementById(item[0]);
var imgHeight = document.getElementById(item[0]).height;
var imgWidth = document.getElementById(item[0]).width;

x = x + item["x"]; y = y + item["y"];

context.drawImage(img,0,0, imgWidth, imgHeight, x, y, item["width"], item["height"]);
}

 
function drawItem(x, y) { 
var TO_RADIANS = Math.PI/180;
    
var img = document.getElementById(item[0]);
var imgHeight = document.getElementById(item[0]).naturalHeight;
var imgWidth = document.getElementById(item[0]).naturalWidth;

var tempsplit = item[2].split("x");
var tempX;
var tempY;
    
if (angle == "0") { tempX = tempsplit[0]; 
if (checkNumber(tempsplit[0]) == 0) { tempX = tempX - 1; tempX = tempX / 2;  }                    
else { tempX = tempX / 2; tempX = tempX - 1; }      
              
// Check if even building and if flipped, fixes collision
if (checkNumber(tempsplit[0]) == 1 && flipped == -1) {  tempX = tempX + 1;  }  
tempX = tempX * 30; x = x - tempX; 
tempY = tempsplit[1] - 1; tempY = tempY * 30; y = y - tempY; 
}
if (angle == "90") { tempX = tempsplit[1] * 30; x = x + tempX; tempY = tempsplit[0]; 
if (checkNumber(tempsplit[0]) == 0) { tempY = tempY - 1; tempY = tempY / 2; }                    
else { tempY = tempY / 2; tempY = tempY - 1; } 
tempY = tempY * 30; y = y - tempY; 
}
if (angle == "180") { tempX = tempsplit[0]; 
if (checkNumber(tempsplit[0]) == 0) { tempX = tempX - 1; tempX = tempX / 2; tempX = tempX + 1;  }                    
else { tempX = tempX / 2;  }       
tempX = tempX * 30; x = x + tempX; tempY = tempsplit[1] * 30; y = y + tempY; 
}
if (angle == "270") { tempX = tempsplit[1] - 1; tempX = tempX * 30; x = x - tempX; tempY = tempsplit[0];
if (checkNumber(tempsplit[0]) == 0) { tempY = tempY - 1; tempY = tempY / 2; tempY = tempY + 1; }                    
else { tempY = tempY / 2; }                  
tempY = tempY * 30; y = y + tempY; 
}

// save the current co-ordinate system 
context.save(); 
 
// move to the middle of where we want to draw our image
context.translate(x, y);
 
// rotate around that point, converting our 
// angle from degrees to radians 
context.rotate(angle * TO_RADIANS);
    
if (flipped == -1) {
    context.scale(-1, 1);
    //var tempWidth = 0;
    //if (item["width"] == 60 || item["width"] == 120) { tempWidth = 30; }
    context.drawImage(img,0,0, imgWidth, imgHeight, 0, 0, item["width"] * -1, item["height"]);
} else {

context.drawImage(img,0,0, imgWidth, imgHeight, 0, 0, item["width"], item["height"]);
}
 
// and restore the co-ords to how they were when we began
context.restore(); 
  
}


function saveItem(x, y) {
    
var a; var b;
var squareX = new Array(); var squareY = new Array();
itemID = itemID + 1
    
squareX.push(x); squareY.push(y);

var tempsplit = item[2].split("x");
var tempX = tempsplit[0]; 
var tempY = tempsplit[1];
var tempMinus;
var tempPlus;
var xLength = tempsplit[0];
var position;
    
if (checkNumber(tempsplit[0]) == 0) { tempX = tempX - 1; tempMinus = tempX / 2; tempPlus = tempX / 2;  }                    
else { tempX = tempX / 2; tempMinus = tempX - 1; tempPlus = tempX; }   
    
// Check if even building and if flipped, fixes collision
if (checkNumber(tempsplit[0]) == 1 && flipped == -1) {  tempMinus = tempMinus + 1;  }   

xLength = xLength - tempMinus;
tempMinus = -tempMinus;

if (angle == 0) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareX.push(x + position); } }
for (b=0;b<tempY;b++) { position = b * 30; if (position != 0) { squareY.push(y - position); } }                      
}    
if (angle == 90) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareY.push(y + position); } }
for (b=0;b<tempY;b++) { position = b * 30; if (position != 0) { squareX.push(x + position); } }                      
}  
if (angle == 180) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareX.push(x - position); } }
for (b=0;b<tempY;b++) { position = b * 30; if (position != 0) { squareY.push(y + position); } }                      
}  
if (angle == 270) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareY.push(y - position); } }
for (b=0;b<tempY;b++) { position = b * 30; if (position != 0) { squareX.push(x - position); } }                      
}  

    
for (a=0;a<squareX.length;a++) {
for (b=0;b<squareY.length;b++) {

squareUsed[buildLayer][0].push(itemID);
squareUsed[buildLayer][1].push(squareX[a]+"|"+squareY[b]);
squareUsed[buildLayer][2].push(item[1]);
squareUsed[buildLayer][3].push(0);
squareUsed[buildLayer][4].push(0);
squareUsed[buildLayer][5].push(0);
squareUsed[buildLayer][6].push(0);
squareUsed[buildLayer][7].push(0);
squareUsed[buildLayer][8].push(material);
squareUsed[buildLayer][9].push(angle);
squareUsed[buildLayer][10].push(flipped);
squareUsed[buildLayer][11].push(temperature);
squareUsed[buildLayer][12].push(itemMass);
}    
}

// Draw building to canvas
drawItem(x, y);
    
// Draw building connections if any exist
connectionSquares(x, y);
}

function checkSquare(mousePos) {
// Checks current layer to see if any squares required for the item are already used, prevents item from being placed if so.
var a; var b;
var search = new Array();
var result;
var squareX = new Array(); var squareY = new Array();

squareX.push(x); squareY.push(y);
    
var tempsplit = item[2].split("x");
var tempx = tempsplit[0]; 
var tempy = tempsplit[1];
var tempMinus;
var tempPlus;
var xLength = tempsplit[0];
var position;
    
if (checkNumber(tempsplit[0]) == 0) { tempx = tempx - 1; tempMinus = tempx / 2; tempPlus = tempx / 2;  }                    
else { tempx = tempx / 2; tempMinus = tempx - 1; tempPlus = tempx; }   

// Check if even building and if flipped, fixes collision
if (checkNumber(tempsplit[0]) == 1 && flipped == -1) {  tempMinus = tempMinus + 1;  }

xLength = xLength - tempMinus;
tempMinus = -tempMinus;

if (angle == 0) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareX.push(x + position); } }
for (b=0;b<tempy;b++) { position = b * 30; if (position != 0) { squareY.push(y - position); } }                      
}    
if (angle == 90) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareY.push(y + position); } }
for (b=0;b<tempy;b++) { position = b * 30; if (position != 0) { squareX.push(x + position); } }                      
}  
if (angle == 180) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareX.push(x - position); } }
for (b=0;b<tempy;b++) { position = b * 30; if (position != 0) { squareY.push(y + position); } }                      
}  
if (angle == 270) { 
for (a=tempMinus;a<xLength;a++) { position = a * 30; if (position != 0) { squareY.push(y - position); } }
for (b=0;b<tempy;b++) { position = b * 30; if (position != 0) { squareX.push(x - position); } }                      
}  
    
for (a=0;a<squareX.length;a++) {
for (b=0;b<squareY.length;b++) {
search.push(squareX[a]+"|"+squareY[b]);
}
}
console.log(search);
for (a=0; a < search.length; a++) {
result = squareUsed[buildLayer][1].indexOf(search[a]);
    console.log("r2 "+result);
    console.log(search[a]);
// Special item collision checks  
// Check if Background item and if square has "solid" tile 
if (buildLayer == 12) { 
var testSpecial = squareUsed[0][1].indexOf(search[a]);  
var testSpecial2 = squareUsed[13][1].indexOf(search[a]);  
if (testSpecial2 != -1) {
var natTile = squareUsed[13][2][testSpecial2].includes("Natural Tile "); 
}
if (squareUsed[0][2][testSpecial] == "Tile" || squareUsed[0][2][testSpecial] == "Airflow Tile" || squareUsed[0][2][testSpecial] == "Mesh Tile" || squareUsed[0][2][testSpecial] == "Insulated Tile" || squareUsed[0][2][testSpecial] == "Plastic Tile" || squareUsed[0][2][testSpecial] == "Metal Tile" || squareUsed[0][2][testSpecial] == "Window Tile" || squareUsed[0][2][testSpecial] == "Bunker Tile" || squareUsed[0][2][testSpecial] == "Carpeted Tile" || squareUsed[0][2][testSpecial] == "Pneumatic Door" || squareUsed[0][2][testSpecial] == "Manual Airlock" || squareUsed[0][2][testSpecial] == "Mechanized Airlock" || squareUsed[0][2][testSpecial] == "Bunker Door" || squareUsed[0][2][testSpecial] == "Farm Tile" || squareUsed[0][2][testSpecial] == "Hydroponic Farm" || squareUsed[0][2][testSpecial] == "Gravitas Door" || squareUsed[0][2][testSpecial] == "Security Door" || squareUsed[0][2][testSpecial] == "Interior Security Door" || natTile == true) { result = 1; break; }
    
}
   
// Check if "solid" item and check if square has background tile or element
if (item[1] == "Tile" || item[1] == "Insulated Tile" || item[1] == "Plastic Tile" || item[1] == "Metal Tile" || item[1] == "Window Tile" || item[1] == "Bunker Tile" || item[1] == "Carpeted Tile" || item[1] == "Manual Airlock" || item[1] == "Mechanized Airlock" || item[1] == "Bunker Door" || item[1] == "Farm Tile" || item[1] == "Hydroponic Farm" || item[1] == "Gravitas Door" || item[1] == "Security Door" || item[1] == "Interior Security Door") {
var testSpecial = squareUsed[12][1].indexOf(search[a]); 
var testSpecial2 = squareUsed[13][1].indexOf(search[a]); 
    
if (testSpecial != -1 || testSpecial2 != -1) { result = 1; break; }
}
    
// Check if mesh tile or pneumatic door and check if square has background tile or natural tile
if (item[1] == "Mesh Tile" || item[1] == "Pneumatic Door") {
    var testSpecial = squareUsed[12][1].indexOf(search[a]);
    var testSpecial2 = squareUsed[13][1].indexOf(search[a]); 
if (testSpecial2 != -1) {
var natTile = squareUsed[13][2][testSpecial2].includes("Natural Tile "); 
}
    
if (testSpecial != -1 || natTile == true) { result = 1; break; }
}
    
// Check if airflow tile and check if square has background tile or natural tile or liquids
if (item[1] == "Airflow Tile") { 
var testSpecial = squareUsed[12][1].indexOf(search[a]);
var testSpecial2 = squareUsed[13][1].indexOf(search[a]);
if (testSpecial2 != -1) {
var natTile = squareUsed[13][2][testSpecial2].includes("Natural Tile "); 
var liquid = squareUsed[13][2][testSpecial2].includes("Liquids "); 
}
    
if (testSpecial != -1 || natTile == true || liquid == true) { result = 1; break; }
}
    
var natTile = item[1].includes("Natural Tile ");
var liquid = item[1].includes("Liquids ");
var gas = item[1].includes("Gases ");
    
// Check if element and check if square has "solid" tile
if (natTile == true || liquid == true || gas == true) {
var testSpecial = squareUsed[0][1].indexOf(search[a]); 

if (squareUsed[0][2][testSpecial] == "Tile" || squareUsed[0][2][testSpecial] == "Insulated Tile" || squareUsed[0][2][testSpecial] == "Plastic Tile" || squareUsed[0][2][testSpecial] == "Metal Tile" || squareUsed[0][2][testSpecial] == "Window Tile" || squareUsed[0][2][testSpecial] == "Bunker Tile" || squareUsed[0][2][testSpecial] == "Carpeted Tile" || squareUsed[0][2][testSpecial] == "Manual Airlock" || squareUsed[0][2][testSpecial] == "Mechanized Airlock" || squareUsed[0][2][testSpecial] == "Bunker Door" || squareUsed[0][2][testSpecial] == "Farm Tile" || squareUsed[0][2][testSpecial] == "Hydroponic Farm" || squareUsed[0][2][testSpecial] == "Gravitas Door" || squareUsed[0][2][testSpecial] == "Security Door" || squareUsed[0][2][testSpecial] == "Interior Security Door") { result = 1; break; }
}
    
// Check if natural tile and check if square has mesh tile or pneumatic door or gantry
if (natTile == true) {
var testSpecial = squareUsed[0][1].indexOf(search[a]); 
var testSpecial2 = squareUsed[14][1].indexOf(search[a]);

if (squareUsed[0][2][testSpecial] == "Mesh Tile" || squareUsed[0][2][testSpecial] == "Pneumatic Door" || testSpecial2 != -1) { result = 1; break; }
}
    
// Check if natural tile or liquid and check if square has airflow tile
if (natTile == true || liquid == true) {
var testSpecial = squareUsed[0][1].indexOf(search[a]); 

if (squareUsed[0][2][testSpecial] == "Airflow Tile") { result = 1; break; }
}
      
if (item[1] == "Gantry" && result == -1) { 
var testSpecial = squareUsed[0][1].indexOf(search[a]);
var testSpecial2 = squareUsed[13][1].indexOf(search[a]);
if (testSpecial2 != -1) {
var natTile = squareUsed[13][2][testSpecial2].includes("Natural Tile "); 
var liquid = squareUsed[13][2][testSpecial2].includes("Liquids "); 
var gas = squareUsed[13][2][testSpecial2].includes("Gases "); 
}
if (testSpecial != -1 || testSpecial2 != -1 || natTile == true) { result = 1; }
                  
if (squareUsed[0][2][testSpecial] == "Carbon Dioxide Engine" || squareUsed[0][2][testSpecial] == "Sugar Engine" || squareUsed[0][2][testSpecial] == "Steam Engine SO" || squareUsed[0][2][testSpecial] == "Small Petroleum Engine" || squareUsed[0][2][testSpecial] == "Petroleum Engine SO" || squareUsed[0][2][testSpecial] == "Radbolt Engine" || squareUsed[0][2][testSpecial] == "Hydrogen Engine SO" || squareUsed[0][2][testSpecial] == "Solo Spacefarer Nosecone" || squareUsed[0][2][testSpecial] == "Spacefarer Module" || squareUsed[0][2][testSpecial] == "Basic Nosecone" || squareUsed[0][2][testSpecial] == "Drillcone" || squareUsed[0][2][testSpecial] == "Orbital Cargo Module" || squareUsed[0][2][testSpecial] == "Rovers Module" || squareUsed[0][2][testSpecial] == "Trailblazer Module" || squareUsed[0][2][testSpecial] == "Large Liquid Fuel Tank" || squareUsed[0][2][testSpecial] == "Small Solid Oxidizer Tank" || squareUsed[0][2][testSpecial] == "Large Solid Oxidizer Tank" || squareUsed[0][2][testSpecial] == "Liquid Oxidizer Tank SO" || squareUsed[0][2][testSpecial] == "Cargo Bay SO" || squareUsed[0][2][testSpecial] == "Liquid Cargo Tank SO" || squareUsed[0][2][testSpecial] == "Gas Cargo Canister SO" || squareUsed[0][2][testSpecial] == "Large Cargo Bay" || squareUsed[0][2][testSpecial] == "Large Liquid Cargo Tank" || squareUsed[0][2][testSpecial] == "Large Gas Cargo Canister" || squareUsed[0][2][testSpecial] == "Battery Module" || squareUsed[0][2][testSpecial] == "Solar Panel Module" || squareUsed[0][2][testSpecial] == "Artifact Transport Module" || squareUsed[0][2][testSpecial] == "Cartographic Module" || squareUsed[0][2][testSpecial] == "Steam Engine" || squareUsed[0][2][testSpecial] == "Petroleum Engine" || squareUsed[0][2][testSpecial] == "Solid Fuel Thruster" || squareUsed[0][2][testSpecial] == "Liquid Fuel Tank" || squareUsed[0][2][testSpecial] == "Solid Oxidizer Tank" || squareUsed[0][2][testSpecial] == "Liquid Oxidizer Tank" || squareUsed[0][2][testSpecial] == "Cargo Bay" || squareUsed[0][2][testSpecial] == "Gas Cargo Canister" || squareUsed[0][2][testSpecial] == "Liquid Cargo Tank" || squareUsed[0][2][testSpecial] == "Command Capsule" || squareUsed[0][2][testSpecial] == "Sight-Seeing Module" || squareUsed[0][2][testSpecial] == "Research Module" || squareUsed[0][2][testSpecial] == "Biological Cargo Bay" || squareUsed[0][2][testSpecial] == "Hydrogen Engine" || liquid == true || gas == true) {
    console.log("gas "+gas);
if (flipped == 1) { if (a == 0 || a == 1 || a == 2 || a == 4 || a == 6 || a == 7 || a == 8 || a == 9 || a == 10 || a == 11) { result = -1; } } 
if (flipped == -1) { if (a == 0 || a == 1 || a == 2 || a == 3 || a == 4 || a == 5 || a == 6 || a == 7 || a == 8 || a == 10) { result = -1; } }
    
}
    console.log("r1 "+result);
}
    
// Check if building and check if square has gantry if gantry detected return true result = 1
if (buildLayer == 0) { 
var testSpecial = squareUsed[14][1].indexOf(search[a]);
    
if (testSpecial != -1) { result = 1; }
}
    
var liquid = item[1].includes("Liquids ");
var gas = item[1].includes("Gases ");
    
// Further check if item is rocket component or liquid or gas for special rules regarding gantry (2 solid tiles)
if (item[1] == "Carbon Dioxide Engine" || item[1] == "Sugar Engine" || item[1] == "Steam Engine SO" || item[1] == "Small Petroleum Engine" || item[1] == "Petroleum Engine SO" || item[1] == "Radbolt Engine" || item[1] == "Hydrogen Engine SO" || item[1] == "Solo Spacefarer Nosecone" || item[1] == "Spacefarer Module" || item[1] == "Basic Nosecone" || item[1] == "Drillcone" || item[1] == "Orbital Cargo Module" || item[1] == "Rovers Module" || item[1] == "Trailblazer Module" || item[1] == "Large Liquid Fuel Tank" || item[1] == "Small Solid Oxidizer Tank" || item[1] == "Large Solid Oxidizer Tank" || item[1] == "Liquid Oxidizer Tank SO" || item[1] == "Cargo Bay SO" || item[1] == "Liquid Cargo Tank SO" || item[1] == "Gas Cargo Canister SO" || item[1] == "Large Cargo Bay" || item[1] == "Large Liquid Cargo Tank" || item[1] == "Large Gas Cargo Canister" || item[1] == "Battery Module" || item[1] == "Solar Panel Module" || item[1] == "Artifact Transport Module" || item[1] == "Cartographic Module" || item[1] == "Steam Engine" || item[1] == "Petroleum Engine" || item[1] == "Solid Fuel Thruster" || item[1] == "Liquid Fuel Tank" || item[1] == "Solid Oxidizer Tank" || item[1] == "Liquid Oxidizer Tank" || item[1] == "Cargo Bay" || item[1] == "Gas Cargo Canister" || item[1] == "Liquid Cargo Tank" || item[1] == "Command Capsule" || item[1] == "Sight-Seeing Module" || item[1] == "Research Module" || item[1] == "Biological Cargo Bay" || item[1] == "Hydrogen Engine" || liquid == true || gas == true) {
var testSpecial = squareUsed[14][1].indexOf(search[a]);
if (testSpecial != -1) { result = 1; }
if (squareUsed[14][2][testSpecial] == "Gantry") { 
    var gantryID = squareUsed[14][0][testSpecial];
    console.log("r3 "+result);
var gantry = 0;
var gantryStart = testSpecial;
while (gantry == 0) {
    gantryStart = gantryStart - 1;
    if (squareUsed[14][0][gantryStart] != gantryID) { gantryStart = gantryStart + 1; gantry = 1; }
}

    
if (squareUsed[14][10][testSpecial] == 1) { if (testSpecial != (gantryStart + 3) && testSpecial != (gantryStart + 5)){ result = -1; } } 
if (squareUsed[14][10][testSpecial] == -1) { if (testSpecial != (gantryStart + 9) && testSpecial != (gantryStart + 11)) { result = -1; console.log("r "+result); console.log("g "+gantryStart); } }

}   

}
 
if (result != -1) { break; }
}
return result;
}
// Grid Functions ///////////////////////////////////////////////////////////////////////////



// Item Functions ///////////////////////////////////////////////////////////////////////////
function getItem() {
// gets current item from select field, checks item size and adjusts x,y,width,height.
// item = mechanized-airlock|Mechanized Airlock|1x2|0|1|pi/0x0,ai/0x0|0|2
// item[0] = Building Name truncated and low caps (mechanized-airlock)
// item[1] = Building Name (Mechanized Airlock)
// item[2] = Building Size (1x2)
// item[3] = Building Flip (1x2)
// item[4] = Building Rotate (1x2)
// item[5] = Building Connections (pi/0x0,ai/0x0)
// item[6] = Building Layer (0)
// item[7] = Building Construction (2)
// item[8] = Building Display (p)
// item[9] = Max Mass ()
item = item.split("|");   
    
buildLayer = parseInt(item[6]);
    
if (item[0] != "natural-tile" && item[0] != "liquds" && item[0] != "gases" && item[0] != "geysers" && item[0] != "plants") {
displayItem();
}
setOverlay(buildLayer, 0); // Set building overlay to be used when drawing image on correct layer
displayOverlay(buildLayer, 0); // Set overlay display to correct layer initially on select
getConnectionSquares(); // Sets building connection squares array
itemXY();
}


function itemXY() {
    
var tempsplit = item[2].split("x");
var tempx = tempsplit[0]; 
var tempy = tempsplit[1];
    
item["width"] = tempx * 30;
item["height"] = tempy * 30;

if (angle == "0") {                  
if (checkNumber(tempsplit[0]) == 0) { tempx = tempx - 1; tempx = tempx / 2;  }                    
else { tempx = tempx / 2; tempx = tempx - 1; }       
tempx = tempx * 30; item["x"] = -tempx;              
tempy = tempy - 1; tempy = tempy * 30; item["y"] = -tempy; 
}   
if (angle == "90") { 
if (checkNumber(tempsplit[0]) == 0) {  tempx = tempx - 1; tempx = tempx / 2;  } 
else { tempx = tempx / 2; tempx = tempx - 1; }
tempy = +tempy + +tempx;
tempy = tempy * 30;  
item["x"] = 0;   item["y"] = -tempy;
}
if (angle == "180") { 
if (checkNumber(tempsplit[0]) == 0) { tempx = tempx - 1; tempx = tempx / 2; tempx = tempx + 1;  }                    
else { tempx = tempx / 2;  }       
tempx = tempx * 30; item["x"] = tempx; 
tempy = tempy * 30; item["y"] = -tempy; 
}
if (angle == "270") {   
tempy = tempy - 1; 
if (checkNumber(tempsplit[0]) == 0) { tempx = tempx - 1; tempx = tempx / 2;   }                    
else { tempx = tempx / 2; tempx = tempx - 1;  }   
tempy = tempy - tempx;   
tempy = tempy * 30; 
item["x"] = 30;   item["y"] = -tempy;
}    
}

function itemConnections(prevConnection, mousePos) {
// Updates current square and previous square with new connection value and a new image based on that connection value, if mouse has been dragged from one square to the other.
var a;   
var prevItemKey; 
var prevItemSquare;
var itemKey;
var itemSquare = new Array();

var left = 0; var pLeft = 0;
var right = 0; var pRight = 0;
var top = 0; var pTop = 0;
var bottom = 0; var pBottom = 0;
    
var connection = mousePos.x+"|"+mousePos.y;

prevItemKey = squareUsed[buildLayer][1].indexOf(prevConnection);

// Checks to see if this is the first square in which case nothing will happen or subsequent squares.
if (prevItemKey != -1) {

itemKey = squareUsed[buildLayer][1].indexOf(connection);

prevItemSquare = prevConnection.split("|"); 
itemSquare[0] = mousePos.x;
itemSquare[1] = mousePos.y;
    
// Compares x and y positions of previous and current square to determine mouse direction and therefore connections required, left / right / top / bottom
if (itemSquare[0] < prevItemSquare[0]) { // Mouse moving left, previous square has a left connection, current square has a right connection.
if (squareUsed[buildLayer][5][itemKey] != 1) { squareUsed[buildLayer][5][itemKey] = 1; } 
if (squareUsed[buildLayer][4][prevItemKey] != 1) { squareUsed[buildLayer][4][prevItemKey] = 1; } 
}   
if (itemSquare[0] > prevItemSquare[0]) { // Mouse moving right, previous square has a right connection, current square has a left connection.
if (squareUsed[buildLayer][4][itemKey] != 1) { squareUsed[buildLayer][4][itemKey] = 1; }
if (squareUsed[buildLayer][5][prevItemKey] != 1) { squareUsed[buildLayer][5][prevItemKey] = 1; }
} 
if (itemSquare[1] < prevItemSquare[1]) { // Mouse moving up, previous square has a top connection, current square has a bottom connection.
if (squareUsed[buildLayer][7][itemKey] != 1) { squareUsed[buildLayer][7][itemKey] = 1; }
if (squareUsed[buildLayer][6][prevItemKey] != 1) { squareUsed[buildLayer][6][prevItemKey] = 1; }
}
if (itemSquare[1] > prevItemSquare[1]) { // Mouse moving down, previous square has a bottom connection, current square has a top connection.
if (squareUsed[buildLayer][6][itemKey] != 1) { squareUsed[buildLayer][6][itemKey] = 1; }
if (squareUsed[buildLayer][7][prevItemKey] != 1) { squareUsed[buildLayer][7][prevItemKey] = 1 } 
}
    
// Game connection values assigned if connection has been added or already exists for the square, to be added to the square.
if (squareUsed[buildLayer][4][prevItemKey] == 1) { pLeft = 1; }
if (squareUsed[buildLayer][5][prevItemKey] == 1) { pRight = 2; }  
if (squareUsed[buildLayer][6][prevItemKey] == 1) { pTop = 4; }  
if (squareUsed[buildLayer][7][prevItemKey] == 1) { pBottom = 8; }  
    
if (squareUsed[buildLayer][4][itemKey] == 1) { left = 1; }
if (squareUsed[buildLayer][5][itemKey] == 1) { right = 2; }  
if (squareUsed[buildLayer][6][itemKey] == 1) { top = 4; }  
if (squareUsed[buildLayer][7][itemKey] == 1) { bottom = 8; }  
    
squareUsed[buildLayer][3][prevItemKey] = pLeft + pRight + pTop + pBottom;
squareUsed[buildLayer][3][itemKey] = left + right + top + bottom;
    
var prevImageURL = squareUsed[buildLayer][2][prevItemKey].toLowerCase();
    
var imageArray = prevImageURL.split(" ");  
prevImageURL = "";
for (a=0;a<imageArray.length;a++) { if (a!=0) { prevImageURL = prevImageURL + "-"; } prevImageURL = prevImageURL + imageArray[a]; }
var imageURL = squareUsed[buildLayer][2][itemKey].toLowerCase();

imageArray = imageURL.split(" ");  
imageURL = "";
for (a=0;a<imageArray.length;a++) { if (a!=0) { imageURL = imageURL + "-"; } imageURL = imageURL + imageArray[a]; }

updateConnections(prevItemSquare[0], prevItemSquare[1], prevImageURL+"-"+squareUsed[buildLayer][3][prevItemKey]);
updateConnections(itemSquare[0], itemSquare[1], imageURL+"-"+squareUsed[buildLayer][3][itemKey]);
}
}

function imageURLConvert(image) {
var a;
var imageURL = image.toLowerCase(); var imageArray = imageURL.split(" "); imageURL = "";
for (a=0;a<imageArray.length;a++) { if (a!=0) { imageURL = imageURL + "-"; } imageURL = imageURL + imageArray[a]; }
    
return imageURL;
}

function updateConnections(squareX, squareY, connection) {
// Updates previous square with new connection image, first removes previous with clearSquare.
    
var img = document.getElementById(connection);
var imgHeight = document.getElementById(connection).naturalHeight;
var imgWidth = document.getElementById(connection).naturalWidth;
    
clearSquare(context, squareX, squareY);

context.drawImage(img, 0, 0, imgWidth, imgHeight, squareX, squareY, 30, 30);    
}  




function deleteSquare(index, deleteID, activeLayer, squareX, squareY) {

var a;
var tempX; var tempY;
var search = squareX+"|"+squareY;
var tempIndex;
var connectionID;
var connectionUpdate;
var tempX; var tempY;
    
var layers = new Array(1,3,5,7,9,11); // Add overlay layers to remove them at the same time as current layer if needed.
    
setOverlay(activeLayer, 0);
     
// Removes connections if any from adjacent squares, and resets that square with the new connection value and image.
if (squareUsed[activeLayer][4][index] == 1 ) { // Left Connection
tempX = Number(squareX) - 30;
connectionID = squareUsed[activeLayer][1].indexOf(tempX+"|"+squareY);
squareUsed[activeLayer][5][connectionID] = 0;
connectionUpdate = squareUsed[activeLayer][3][connectionID] - 2; 
squareUsed[activeLayer][3][connectionID] = connectionUpdate;
if (connectionUpdate == 0) { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index]); } else { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index])+"-"+connectionUpdate; }
updateConnections(tempX, squareY, connectionUpdate); 
}
if (squareUsed[activeLayer][5][index] == 1 ) { // Right Connection
tempX = Number(squareX) + 30;
connectionID = squareUsed[activeLayer][1].indexOf(tempX+"|"+squareY);
squareUsed[activeLayer][4][connectionID] = 0;
connectionUpdate = squareUsed[activeLayer][3][connectionID] - 1; 
squareUsed[activeLayer][3][connectionID] = connectionUpdate;
if (connectionUpdate == 0) { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index]); } else { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index])+"-"+connectionUpdate; }
updateConnections(tempX, squareY, connectionUpdate);
}
if (squareUsed[activeLayer][6][index] == 1 ) { // Top Connection
tempY = Number(squareY) - 30;
connectionID = squareUsed[activeLayer][1].indexOf(squareX+"|"+tempY);
squareUsed[activeLayer][7][connectionID] = 0;
connectionUpdate = squareUsed[activeLayer][3][connectionID] - 8;
squareUsed[activeLayer][3][connectionID] = connectionUpdate;
if (connectionUpdate == 0) { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index]); } else { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index])+"-"+connectionUpdate; }
updateConnections(squareX, tempY, connectionUpdate); 
}
if (squareUsed[activeLayer][7][index] == 1 ) { // Bottom Connection
tempY = Number(squareY) + 30;
connectionID = squareUsed[activeLayer][1].indexOf(squareX+"|"+tempY);
squareUsed[activeLayer][6][connectionID] = 0;
connectionUpdate = squareUsed[activeLayer][3][connectionID] - 4;
squareUsed[activeLayer][3][connectionID] = connectionUpdate;
if (connectionUpdate == 0) { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index]); } else { connectionUpdate = imageURLConvert(squareUsed[activeLayer][2][index])+"-"+connectionUpdate; }
updateConnections(squareX, tempY, connectionUpdate); 
}
    
clearSquare(context, squareX, squareY);   

for (a=0;a<layers.length;a++) {
setOverlay(layers[a], 0);
    
tempIndex = squareUsed[layers[a]][1].indexOf(search);
    
if (tempIndex != -1 && squareUsed[layers[a]][0][tempIndex] == deleteID) {

clearSquare(context, squareX, squareY);
    
// Removes item
squareUsed[layers[a]][0].splice(tempIndex,1); squareUsed[layers[a]][1].splice(tempIndex,1); squareUsed[layers[a]][2].splice(tempIndex,1);
squareUsed[layers[a]][3].splice(tempIndex,1); squareUsed[layers[a]][4].splice(tempIndex,1); squareUsed[layers[a]][5].splice(tempIndex,1);
squareUsed[layers[a]][6].splice(tempIndex,1); squareUsed[layers[a]][7].splice(tempIndex,1); squareUsed[layers[a]][8].splice(tempIndex,1); squareUsed[layers[a]][7].splice(tempIndex,1); squareUsed[layers[a]][8].splice(tempIndex,1); squareUsed[layers[a]][9].splice(tempIndex,1); squareUsed[layers[a]][10].splice(tempIndex,1); squareUsed[layers[a]][11].splice(tempIndex,1); squareUsed[layers[a]][12].splice(tempIndex,1);

}  
}  
}


function deleteItem(x, y) { 
// Deletes item from layerItems and clears square and any adjacent squares the item takes up.

var a; var b;
var search = x+"|"+y;
var index;
var deleteID; var deleteNumber; var square; var tempSquare;
var indexStart; var indexEnd;
var layers = new Array();
    
if (overlayLayer !== "") { layers.push(overlayLayer); if (overlayLayer === 0) { layers.push(14); } } else { layers.push(0,2,4,6,8,10,12,13,14); }

for(a=0;a<layers.length;a++) {

index = squareUsed[layers[a]][1].indexOf(search);

if (index != -1) {
    
deleteID = squareUsed[layers[a]][0][index];
    
indexStart = squareUsed[layers[a]][0].indexOf(deleteID);
indexEnd = squareUsed[layers[a]][0].lastIndexOf(deleteID);
    
// Get all instances ie all squares that the item takes up using item ID
deleteNumber = diff(indexStart,indexEnd) + 1;  
    
//Delete image from all squares for items that are more than 1x1 
square = indexStart; 

for (b=0;b<deleteNumber;b++) { 
tempSquare = squareUsed[layers[a]][1][square].split("|");
deleteSquare(square, deleteID, layers[a], tempSquare[0], tempSquare[1]);
square++;
}
    
// Removes item
squareUsed[layers[a]][0].splice(indexStart,deleteNumber); squareUsed[layers[a]][1].splice(indexStart,deleteNumber); squareUsed[layers[a]][2].splice(indexStart,deleteNumber);
squareUsed[layers[a]][3].splice(indexStart,deleteNumber); squareUsed[layers[a]][4].splice(indexStart,deleteNumber); squareUsed[layers[a]][5].splice(indexStart,deleteNumber);
squareUsed[layers[a]][6].splice(indexStart,deleteNumber); squareUsed[layers[a]][7].splice(indexStart,deleteNumber); squareUsed[layers[a]][8].splice(indexStart,deleteNumber); squareUsed[layers[a]][9].splice(indexStart,deleteNumber); squareUsed[layers[a]][10].splice(indexStart,deleteNumber); squareUsed[layers[a]][11].splice(indexStart,deleteNumber); squareUsed[layers[a]][12].splice(indexStart,deleteNumber);
    
}
}
}

function resetItems(itemType) {
var a;    
var itemTypes = new Array("base", "oxygen", "power", "food", "plumbing", "ventilation", "refinement", "medicine", "furniture", "stations", "utilities", "automation", "shipping", "rocketry", "radiation");
    
item = "";
displayItem();
materialOptions(1);
rotate(1);
flip(1);
displayOverlay("", 0);
deconstructBuilding(1);

    
for (a=0;a<itemTypes.length;a++) {   
if (itemType != itemTypes[a]) {
$('#'+itemTypes[a]).find('.box').css('display','none');
$('#'+itemTypes[a]).find('.box').children().first().css('display','none');   
}
//window[itemTypes[a]+"Select"].setSelectedIndex(0); 
}
}

function cancel() {
    
setBuilding(0);   
materialOptions(1);
materialSelect("");
rotate(1);
flip(1);
displayOverlay("", 0);
deconstructBuilding(1);
rotateFlip(0); 
}


function dragGrid(reset){
var dragVal = $('#dragB').val();
    
if (reset == 2) { resetItems(0); deleteActive(1); }
 
if (dragVal == 0 && reset != 1) { $('#dragB').val(1); $('#dragB').addClass('pressed');
 $( "#gridContainer" ).draggable("enable");                                 $( "#gridContainer" ).draggable({which: 3});
                       
                                }
else { $('#dragB').val(0); $('#dragB').removeClass('pressed'); $( "#gridContainer" ).draggable( "disable" ); }   
}

function drag() {
    
$( "#gridContainer" ).draggable("enable");   
    
}


function materialOptions(reset) {
    
var itemOptions = item[7];

$('.materials').removeClass('pressed');
for ($a=1;$a<14;$a++) { $('#materials'+$a).addClass('disabled'); }
     
if (reset != 1) {
if (itemOptions == 1) { $('#materials1').removeClass('disabled'); materialSelect("SandStone"); }
if (itemOptions == 2) { $('#materials2').removeClass('disabled'); materialSelect("Cuprite"); }
if (itemOptions == 3) { $('#materials3').removeClass('disabled'); materialSelect("Copper"); }
if (itemOptions == 4) { $('#materials4').removeClass('disabled'); materialSelect("Polypropylene"); }
if (itemOptions == 5) { $('#materials5').removeClass('disabled'); materialSelect("Glass"); }
if (itemOptions == 6) { $('#materials6').removeClass('disabled'); materialSelect("Steel"); }
if (itemOptions == 7) { $('#materials7').removeClass('disabled'); materialSelect("Glass"); }
if (itemOptions == 8) { $('#materials8').removeClass('disabled'); }
if (itemOptions == 9) { $('#materials9').removeClass('disabled'); }
if (itemOptions == 10) { $('#materials10').removeClass('disabled'); }
if (itemOptions == 11) { $('#materials11').removeClass('disabled'); }
if (itemOptions == 12) { $('#materials12').removeClass('disabled'); }
if (itemOptions == 13) { $('#materials13').removeClass('disabled'); materialSelect("Unobtanium"); }
}
}


// Item Functions ///////////////////////////////////////////////////////////////////////////



function materialSelect(materialSelected) {
$('.materials').removeClass('pressed');
material = "";
    
if (materialSelected != "") {
$('.'+materialSelected).addClass('pressed');
material = materialSelected;
}
}

function displayItem() {
$('#images').children().css('display', 'none');
$('#'+item[0]).css('display', 'block');
$('#'+item[0]).css('opacity', '0.7');
}
  
    
function rotate(reset) {
angle = angle + 90;
$('#rotate').addClass('pressed');
if (angle >= 360 || reset == 1) { angle = 0; $('#rotate').removeClass('pressed'); } 
}

function flip(reset) {
if (flipped == -1 || reset == 1) { flipped = 1; $('#flip').removeClass('pressed'); }
else { flipped = -1; $('#flip').addClass('pressed'); }
}
    
function rotateFlip(show) {
    $('#flip').addClass('disabled'); $('#flip').prop('disabled', true);
    $('#rotate').addClass('disabled'); $('#rotate').prop('disabled', true);
    if (item[3] == 1 || show == 1) { $('#flip').removeClass('disabled'); $('#flip').prop('disabled', false); }
    if (item[4] == 1 || show == 1) { $('#rotate').removeClass('disabled'); $('#rotate').prop('disabled', false); }
}


function setBuilding(building) {
if (building != 0) { item = building; getItem();  }
else { item = ""; displayItem(); }
materialOptions(0);
rotate(1);
flip(1);
rotateFlip(0);
displayMenu("");
deconstructBuilding(1);
setMass(item[9]);
}



















function getConnectionSquares() {
// Get global connections and put into array for displaying with moveConnectionSquares and saving to image | array["connection type", "connection X axis", "connection Y axis"] - array["ai", "-1", "1"]
// Resets connections array each time a new building is selected
connections = new Array(); 
if (item != "") {
var a;
var connectionType;
var connectionXY;
var tempConnections = item[5].split(",");
    
for (a=0;a<tempConnections.length;a++) {    
connectionType = tempConnections[a].split("/");
// Checks if building has connections before proceeding
if (connectionType != "") {
connectionXY = connectionType[1].split("x"); 
connections.push([connectionType[0], connectionXY[0], connectionXY[1]]); 
}
}   
}
}


function moveConnectionSquares(x, y) {
// Uses getConnectionSquares array to display building connections while in build mode during mouse move / rotate / flip
if (item != "") {
var a;
var imgDiv;
var connectionX; var connectionY;
var tempX; var tempY;
var ai = 1; var ao = 1; var ar = 1; var pi = 1; var po = 1; var i = 1; var o = 1; var f = 1; var ri = 1; var ro = 1;
var display;
var show;
if (overlayLayer == 0) { display = item[8]; } else { 
if (overlayLayer == 2) { display = "a"; }    
if (overlayLayer == 4) { display = "p"; }    
if (overlayLayer == 6) { display = "c"; }    
if (overlayLayer == 8) { display = "l"; }    
if (overlayLayer == 10) { display = "g"; }    
if (overlayLayer == 11) { display = "r"; }    
}

for (a=0;a<connections.length;a++) {
    
if (connections[a][0] == "ai") { imgDiv = "automation-input"+ai; ai++; show = "a"; }
if (connections[a][0] == "ao") { imgDiv = "automation-output"+ao; ao++; show = "a"; }
if (connections[a][0] == "ar") { imgDiv = "automation-reset"+ar; ar++; show = "a"; }
if (connections[a][0] == "pi") { imgDiv = "power-input"+pi; pi++; show = "p"; }
if (connections[a][0] == "po") { imgDiv = "power-output"+po; po++; show = "p"; }
if (connections[a][0] == "ci") { imgDiv = "input"+i; i++; show = "c"; }
if (connections[a][0] == "co") { imgDiv = "output"+o; o++; show = "c"; }
if (connections[a][0] == "cf") { imgDiv = "filter"+f; f++; show = "c"; }
if (connections[a][0] == "li") { imgDiv = "input"+i; i++; show = "l"; }
if (connections[a][0] == "lo") { imgDiv = "output"+o; o++; show = "l"; }
if (connections[a][0] == "lf") { imgDiv = "filter"+f; f++; show = "l"; }
if (connections[a][0] == "gi") { imgDiv = "input"+i; i++; show = "g"; }
if (connections[a][0] == "go") { imgDiv = "output"+o; o++; show = "g"; }
if (connections[a][0] == "gf") { imgDiv = "filter"+f; f++; show = "g"; }
if (connections[a][0] == "ri") { imgDiv = "radiation-input"+ri; ri++; show = "r"; }
if (connections[a][0] == "ro") { imgDiv = "radiation-output"+ro; ro++; show = "r"; }
      
if (flipped == -1) { tempX = connections[a][1] * 30; tempX = tempX * -1; }
else { tempX = connections[a][1] * 30; }
 tempY = connections[a][2] * 30;
    
if (angle == "0") { connectionX = x + tempX; connectionY = y - tempY; }
if (angle == "90") { connectionX = x + tempY; connectionY = y + tempX; }
if (angle == "180") { connectionX = x - tempX; connectionY = y + tempY; }
if (angle == "270") { connectionX = x - tempY; connectionY = y - tempX; }
    
connectionX = connectionX + 35;
connectionY = connectionY + 35;

$('#'+imgDiv).css({transform:"translate("+connectionX+"px,"+connectionY+"px)"}); 
$('#'+imgDiv).css("transform-origin", "bottom left");    
if (display == show) { $('#'+imgDiv).css("display", "block"); }
else { $('#'+imgDiv).css("display", "none"); }
}
}    
}

function connectionSquares(x, y) {
// Uses getConnectionSquares array to draw building connections onto canvas    
if (item != "") {
var a;
var imgDiv;
var connectionX; var connectionY;
var tempX; var tempY;
var context;
var layer;

for (a=0;a<connections.length;a++) {
    
if (connections[a][0] == "ai") { context = context1; layer = 1; imgDiv = "automation-input1"; }
if (connections[a][0] == "ao") { context = context1; layer = 1; imgDiv = "automation-output1"; }
if (connections[a][0] == "ar") { context = context1; layer = 1; imgDiv = "automation-reset1"; }
if (connections[a][0] == "pi") { context = context3; layer = 3; imgDiv = "power-input1"; }
if (connections[a][0] == "po") { context = context3; layer = 3; imgDiv = "power-output1"; }
if (connections[a][0] == "ci") { context = context5; layer = 5; imgDiv = "input1"; }
if (connections[a][0] == "co") { context = context5; layer = 5; imgDiv = "output1"; }
if (connections[a][0] == "li") { context = context7; layer = 7; imgDiv = "input1"; }
if (connections[a][0] == "lo") { context = context7; layer = 7; imgDiv = "output1"; }
if (connections[a][0] == "lf") { context = context7; layer = 7; imgDiv = "filter1"; }
if (connections[a][0] == "gi") { context = context9; layer = 9; imgDiv = "input1"; }
if (connections[a][0] == "go") { context = context9; layer = 9; imgDiv = "output1"; }
if (connections[a][0] == "gf") { context = context9; layer = 9; imgDiv = "filter1"; }
if (connections[a][0] == "ri") { context = context11; layer = 11; imgDiv = "radiation-input1"; }
if (connections[a][0] == "ro") { context = context11; layer = 11; imgDiv = "radiation-output1"; }
    
img = document.getElementById(imgDiv);
imgHeight = document.getElementById(imgDiv).naturalHeight;
imgWidth = document.getElementById(imgDiv).naturalWidth;    
    
if (flipped == -1) { tempX = connections[a][1] * 30; tempX = tempX * -1; }
else { tempX = connections[a][1] * 30; }
 tempY = connections[a][2] * 30;
    
if (angle == "0") { connectionX = x + tempX; connectionY = y - tempY; }
if (angle == "90") { connectionX = x + tempY; connectionY = y + tempX; }
if (angle == "180") { connectionX = x - tempX; connectionY = y + tempY; }
if (angle == "270") { connectionX = x - tempY; connectionY = y - tempX; }

squareUsed[layer][0].push(itemID);
squareUsed[layer][1].push(connectionX+"|"+connectionY);
squareUsed[layer][2].push(item[1]);
squareUsed[layer][3].push(0);
squareUsed[layer][4].push(0);
squareUsed[layer][5].push(0);
squareUsed[layer][6].push(0);
squareUsed[layer][7].push(0);
squareUsed[layer][8].push(0);
squareUsed[layer][9].push(0);
squareUsed[layer][10].push(0);
    
connectionX = connectionX + 5;
connectionY = connectionY + 5;
    
context.drawImage(img,0,0, imgWidth, imgHeight, connectionX, connectionY, 20, 20);
}
}
}
    
    
function deleteActive(reset) {

var deleteVal = $('#deleteB').val();
    
if (reset == 2) { resetItems(0); dragGrid(1); }
 
if (deleteVal == 0 && reset != 1) { $('#deleteB').val(1); $('#deleteB').addClass('pressed'); item = "delete";  }
else { $('#deleteB').val(0); $('#deleteB').removeClass('pressed'); if (reset == 2) { item = ""; } }   
}
    

function deconstructBuilding(reset) {
    
if (deconstruct == 1 || reset == 1) { deconstruct = 0; $('#deconstructB').removeClass('pressed'); }    
else { cancel(); deconstruct = 1; $('#deconstructB').addClass('pressed'); }    
}


    
function checkNumber(number){
if(number % 2 == 0) { return 1; } else { return 0; }
}










function setOverlay(layer, reset) {
    
if (layer == 0 || reset == 1) { context = context0; } //grid = grid0; 
if (layer == 1) { context = context1; } //grid = grid1; 
if (layer == 2) { context = context2; } //grid = grid2; 
if (layer == 3) { context = context3; } //grid = grid3; 
if (layer == 4) { context = context4; } //grid = grid4
if (layer == 5) { context = context5; } //grid = grid5; 
if (layer == 6) { context = context6; } //grid = grid6; 
if (layer == 7) { context = context7; } //grid = grid7
if (layer == 8) { context = context8; } //grid = grid8; 
if (layer == 9) { context = context9; } //grid = grid9; 
if (layer == 10) { context = context10; } //grid = grid10; 
if (layer == 11) { context = context11; } //grid = grid11;
if (layer == 12) { context = context12; } //grid = grid12;
if (layer == 13) { context = context13; } //grid = grid13;
if (layer == 14) { context = context14; } //grid = grid14;   
}

function displayOverlay(layer, button) {
    
$('[id^=overlay]').removeClass('pressed');
    
$('[id^=layer]').css('opacity', '1');
$('#layer0').css('z-index', 14);
$('#layer1').css('z-index', 13); $('#layer1').css('display', 'none');
$('#layer2').css('z-index', 12);
$('#layer3').css('z-index', 11); $('#layer3').css('display', 'none');
$('#layer4').css('z-index', 10);
$('#layer5').css('z-index', 9); $('#layer5').css('display', 'none');
$('#layer6').css('z-index', 8);
$('#layer7').css('z-index', 7); $('#layer7').css('display', 'none');
$('#layer8').css('z-index', 6);
$('#layer9').css('z-index', 5); $('#layer9').css('display', 'none');
$('#layer10').css('z-index', 4);
$('#layer11').css('z-index', 3); $('#layer11').css('display', 'none');
$('#layer12').css('z-index', 2);
$('#layer13').css('z-index', 1);
$('#layer14').css('z-index', 15);
if ((overlayLayer !== layer && button == 1) || (layer !== "" && button == 0)) {
$('[id^=layer]').css('opacity', '0.3');
    
$('#overlay'+layer).addClass('pressed');
 
if (layer == 0) { $('#layer0').css('z-index', 16); $('#layer0').css('opacity', '1'); $('#layer14').css('z-index', 16); $('#layer14').css('opacity', '1'); }
if (layer == 2) { $('#layer1').css('z-index', 17); $('#layer1').css('display', 'block'); $('#layer1').css('opacity', '1'); $('#layer2').css('z-index', 16); $('#layer2').css('opacity', '1'); }
if (layer == 4) { $('#layer3').css('z-index', 17); $('#layer3').css('display', 'block'); $('#layer3').css('opacity', '1'); $('#layer4').css('z-index', 16); $('#layer4').css('opacity', '1'); }
if (layer == 6) { $('#layer5').css('z-index', 17); $('#layer5').css('display', 'block'); $('#layer5').css('opacity', '1'); $('#layer6').css('z-index', 16); $('#layer6').css('opacity', '1'); }
if (layer == 8) { $('#layer7').css('z-index', 17); $('#layer7').css('display', 'block'); $('#layer7').css('opacity', '1'); $('#layer8').css('z-index', 16); $('#layer8').css('opacity', '1'); }
if (layer == 10) { $('#layer9').css('z-index', 17); $('#layer9').css('display', 'block'); $('#layer9').css('opacity', '1'); $('#layer10').css('z-index', 16); $('#layer10').css('opacity', '1'); }
if (layer == 11) { $('#layer11').css('z-index', 17); $('#layer11').css('display', 'block'); $('#layer11').css('opacity', '1'); }
if (layer == 12) { $('#layer12').css('z-index', 16); $('#layer12').css('opacity', '1'); }
if (layer == 13) { $('#layer13').css('z-index', 16); $('#layer13').css('opacity', '1'); }
if (layer == 14) { $('#layer14').css('z-index', 16); $('#layer14').css('opacity', '1'); }
    
 overlayLayer = layer;  
} else { overlayLayer = ""; }
}




function layerClick(evt, grid) {
 
var mousePos = getSquare(grid, evt);
if (deconstruct == 1) { deleteItem(x, y); }
else if (item != "" && item[0] != "natural-tile" && item[0] != "liqud" && item[0] != "gas") { 
var check = checkSquare(mousePos);
    console.log(check);
if (check == -1) {
saveItem(mousePos.x, mousePos.y);
} }

}


function layerMove(evt, grid) {
var mousePos = getSquare(grid, evt);
var prevConnection;
if (deconstruct == 1) { deleteItem(x, y); }
    
else if (item != "" && item[0] != "natural-tile" && item[0] != "liqud" && item[0] != "gas") { 
    
var xDif = diff(prevMousePosX,mousePos.x);                                                                 
var yDif = diff(prevMousePosY,mousePos.y);  

if ((yDif >= 30 || xDif >= 30) || dragBuild == 1) {   
 
dragBuild = 0;

var check = checkSquare(mousePos);   
if (check == -1) {
saveItem(x, y);
}    

if ((item[1] == "Transit Tube" || item[1] == "Wire" || item[1] == "Heavi-Watt Wire" || item[1] == "Conductive Wire" || item[1] == "Heavi-Watt Conductive Wire" || item[1] == "Liquid Pipe" || item[1] == "Insulated Liquid Pipe" || item[1] == "Radiant Liquid Pipe" || item[1] == "Gas Pipe" || item[1] == "Insulated Gas Pipe" || item[1] == "Radiant Gas Pipe" || item[1] == "Automation Wire" || item[1] == "Automation Ribbon") ) {

prevConnection = prevMousePosX+"|"+prevMousePosY; 
itemConnections(prevConnection, mousePos); 

}    
} 
prevMousePosX = mousePos.x; prevMousePosY = mousePos.y;
}
}




function displayMenu(selected) {
    
$('.menu').removeClass('pressed');
    
$('[id^=buildingType]').css('display', 'none');
if (menu !== selected && selected !== "") {
    
$('#'+selected).addClass('pressed');
 
$('#buildingType'+selected).css('display', 'flex');
    
 menu = selected; 
materialOptions(1);
} else { menu = ""; }
}


function displayGuide(active) {
    
if (guide == 0 || active == 1) { $('#guide').css('display', 'flex'); $('#guideB').addClass('pressed'); guide = 1; rotateFlip(1); }
else { $('#guide').css('display', 'none'); $('#guideB').removeClass('pressed'); guide = 0; rotateFlip(0); }
}



function closeDownload() {
    $("#results").addClass('disabled');
}







function save(obj) {

    obj.disabled = true;
    setTimeout(function() {
        obj.disabled = false;
        $('#save').removeClass('pressed');
        $("#results").addClass('disabled');
    }, 60000);
    
    
$.ajax({url: "oni-m.php", type: "POST", contentType: "application/x-www-form-urlencoded", data: { action: "save", squares: squareUsed, temptype: temperatureType } , success: function(result){   
if (result != "") {
$("#download").html('<a href="'+result+'" download><img src="controls/shipping-c.png" style="width: 30px; margin-top: -4px; margin-right: 6px; vertical-align: middle;" />Click to Download</a>');
$("#results").removeClass('disabled');
$('#save').addClass('pressed');
}
}});


}



function setTemperatureType(type) {
    $('#celsius').removeClass('pressed');
    $('#fahrenheit').removeClass('pressed');
    $('#kelvin').removeClass('pressed');
if (type == "C") { $('#celsius').addClass('pressed'); }
if (type == "F") { $('#fahrenheit').addClass('pressed'); }
if (type == "K") { $('#kelvin').addClass('pressed'); }
    
temperatureType = type;     
}

function setMass(mass) {
    
if ($('#mass').val() != mass) { $('#mass').val(mass); }

itemMass = mass;
}


function setTemperature(value) {
if ($('#temperature').val() != value) { $('#temperature').val(value); }
    
temperature = value;
}