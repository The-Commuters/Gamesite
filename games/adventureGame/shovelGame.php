
<!-- Ajax call to achievement here -->
<p class="achievementer" id="info"></p>

<!-- The game canvas that the players will see -->
<canvas id="canvas" width="800" height="600"></canvas>

<script>
/**
 * This is the part used when loading in images, is pretty standard
 * and should be usable for other games that is created. What is done
 * here is that all the images is loaded in to be used inside of the 
 * games as sprite's, and when it is done the game will start. 
 */

var playerDown      = document.createElement("img"); // Creates a var for the picture of the player.
var playerUp        = document.createElement("img"); // Creates a var for the picture of the player.
var playerLeft      = document.createElement("img"); // Creates a var for the picture of the player.
var playerRight     = document.createElement("img"); // Creates a var for the picture of the player.
var imageSprites    = []; // Creates and array for the tiles that will be placed on the canvas.
var numberOfSprites = 0;  // Sets here up a var that will be used to check when  the game can start.

// Counts the images loaded and starts the game if the loading is finished.
function countLoadedImageAndLaunchIfReady() {
  numberOfSprites--;          // One more picture have been loaded.
  if(numberOfSprites == 0) {  // Is the last of the images loaded?
    loadingDoneSoStartGame(); // Start this function in main.js.
  }
}

// Starts here loading the image choosen in the function under it.
function beginLoadingImage(imgVar, fileName) {
  imgVar.onload=countLoadedImageAndLaunchIfReady;      // Checks if it is ready.
  imgVar.src="games/adventureGame/images/"+fileName;   // Sets the source path of the image.
}

// Gives the tile a code to be used in the bitmap later.
function giveImageNumber(imageNumber, fileName) {
  imageSprites[imageNumber] = document.createElement("img");
  beginLoadingImage(imageSprites[imageNumber],fileName);
}

// This is called in main.js, and loads in all the images used in the game. 
function loadImages() {

  // Makes a array of all the images that needs to be loaded in.
  // Sets up file-names to be used later.
  var images = [
    {varName:playerDown,  theFile:"playerDown.png"},  // This is the player character.
    {varName:playerUp,    theFile:"playerUp.png"},    // This is the player character.
    {varName:playerLeft,  theFile:"playerLeft.png"},  // This is the player character.
    {varName:playerRight, theFile:"playerRight.png"}, // This is the player character.
    {tileType:FLOOR,      theFile:"ground.png"},      // This is the ground-tile.
    {tileType:WALL,       theFile:"wall.png"},        // This is the wall-tile.
    {tileType:EXIT,       theFile:"exit.png"},        // This is the exit-tile.
    {tileType:SHOVEL,     theFile:"shovel.png"},      // This is the shovel-tile.
    {tileType:DIRT,       theFile:"dirt.png"}         // This is the dirt-tile.
    ];

  numberOfSprites = images.length;        // Sets here up the number of images to load in a variable.  
  for(var i=0;i<images.length;i++) {      // Does this as amny times as the images is long.
    if(images[i].tileType != undefined) { // If the image have a fileType and not a varName.

      // sends the tileType and the name of the file to the function.
      giveImageNumber(images[i].tileType, images[i].theFile);
    } else {

      // sends the tileType and the name of the file to the function.
      beginLoadingImage(images[i].varName, images[i].theFile);
    } 
  } 
} 

/** -----------------------------------------------------------------------------------------
 * This is the part that holds the functions that
 * handles the controls. Holds the keyevents and set
 * up the controls for whatever might need moved.
 */

// Sets ut the WASD-control with letters representing the numbers.
// Will be used when for the player to control their character.
const W = 87, A = 65, S = 83, D = 68;

/**
 * This function is called in main and adds eventlistners
 * to the keys of the player, and then bind the controls
 * to the player-character. 
 */
function initInput() {
  document.addEventListener("keydown", keyPressed);   // On keydown, function keyPressed() is done.
  document.addEventListener("keyup", keyReleased);    // On keyUo, function keyReleased() is done.
  p1.playerControls(W, D, S, A);                       // Binds the WASD-keys to the player-character.
}

/**
 * The movement of the player is controlled here, sets the 
 * status of the player-property for that direction to be
 * 'true' or false depending on the status-param.
 * 
 * @param {number}  key     - The key that is pressed on the keyboard.
 * @param {Player}  player  - The player object that is controlled.
 * @param {boolean} status  - It's 'true' if the button is pressed, 'false' if released.
 */
function movement(key, player, status) {
  if(key == player.northKey) {player.pressedNorth = status;} // if key == 65
  if(key == player.eastKey)  {player.pressedEast  = status;} // if key == 68
  if(key == player.southKey) {player.pressedSouth = status;} // if key == 83
  if(key == player.westKey)  {player.pressedWest  = status;} // if key == 87
}

/**
 * This function is called on whenever a key is pressed 
 * on the users keyboard, then its call on the movement().
 *
 * @param {event} event - A event that triggers when a key is pressed.
 */
function keyPressed(event) {
  movement(event.keyCode, p1, true); // Sends inn the key pressed, the player object and true.
  event.preventDefault(); // This stops the default action from happeninh, which is scrolling down on the paghe.
}

/**
 * This function is called on whenever a key is released by the user, 
 * then it call on the movement() to stop the player's movement.
 *
 * @param {event} event - A event that triggers when a key is released.
 */
function keyReleased(event) {
  movement(event.keyCode, p1, false);
}

/** -----------------------------------------------------------------------------------------
 * Draws the sprites that is placed on the map, and
 * collects the type of sprite that the next placement
 * of the player.
 */

// The map represented by 1-5 where every number represents a spesific tile.
var map =
[ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
  1, 4, 0, 0, 0, 4, 1, 0, 0, 0, 5, 0, 1, 0, 0, 1,
  1, 1, 1, 1, 5, 1, 1, 0, 1, 5, 1, 0, 1, 0, 2, 1,
  1, 4, 1, 0, 4, 0, 1, 0, 1, 5, 1, 5, 1, 0, 1, 1,
  1, 0, 1, 5, 1, 1, 1, 4, 1, 5, 1, 0, 0, 0, 0, 1,
  1, 0, 1, 0, 0, 0, 1, 0, 1, 5, 1, 1, 1, 1, 4, 1,
  1, 0, 0, 0, 1, 0, 0, 0, 1, 5, 1, 0, 0, 0, 0, 1,
  1, 0, 1, 5, 1, 1, 1, 1, 1, 5, 1, 4, 1, 1, 1, 1,
  1, 0, 1, 5, 1, 4, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1,
  1, 0, 1, 0, 5, 4, 1, 0, 3, 0, 1, 1, 1, 1, 5, 1,
  1, 4, 1, 4, 1, 4, 1, 0, 0, 0, 1, 4, 0, 4, 0, 1,
  1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
const tileHor    = 16;  // The number of horizontal tiles that the level have.
const tileVer    = 12;  // The number of vertical tiles that the level have.
const tileWidth  = 50;  // The width of the tiles in pixels.  50*16=800
const tileHeight = 50;  // The height of the tiles in pixels. 50*12=600
const FLOOR      = 0;   // The ground tiles, where the player can walk.
const WALL       = 1;   // The wall tiles, where the player cant walk.
const PLAYER     = 2;   // The player character, where it starts.
const EXIT       = 3;   // The exit that the character shall reach.
const SHOVEL     = 4;   // The shovel that the player can use to dig one pile of dirt.
const DIRT       = 5;   // The dirt that is blocking their way.

/**
 * PlaceSprites is the function that places all of 
 * the sprites on the board, it relies heavily on the
 * bitmap to decide what sprites to place where. 
 */
 function placeSprites() {
  // The first of bitmap[], will count upwards, upper left corner X and Y.
  var spriteNumber = 0, cornerX = 0, cornerY = 0;
  
  // For each of the vertical rows of the bitmap(12 times).
  for(var eachRow=0; eachRow<tileVer; eachRow++) { 
    cornerX = 0; // resetting horizontal draw position for tiles to left edge

    // From left to right for each row, 1-16, 17-32 etc(16 times),
    for(var eachCol=0; eachCol<tileHor; eachCol++) { 
      var CurrentSpriteNumber = map[ spriteNumber ]; // The type of tile that it is.

      // If the tile is one of the one that it should do something when it's moved on.
      if(CurrentSpriteNumber == EXIT || CurrentSpriteNumber == SHOVEL  || CurrentSpriteNumber == DIRT) {
        context.drawImage(imageSprites[FLOOR], cornerX, cornerY); // Places the ground below the shovel/dirt/goal.
      }

      // Draws the sprite that should be placed there in the bitmap.
      context.drawImage(imageSprites[CurrentSpriteNumber], cornerX, cornerY); 

      spriteNumber++; // Goes to the integer that holds the next index in the array.
      cornerX += tileWidth; // The placement for the next X(50+50= next sprite is placed with X as 100)
    }
    cornerY += tileHeight; // The placement for the next Y(Jumps down the int that the tileheight have.)
  }    
} 

/**
 * Finds out what kind of image that is in the bitmap
 * where the parameters points to. Used by the player
 * whenever the object moves.
 */
 function getSpriteType(x,y) {

  // Find the column and the row to X in on the sprite.
  var column = x / tileWidth;
  var row    = (y+20) / tileHeight;
  
  // we'll use Math.floor to round down to the nearest whole number
  column = Math.floor( column );
  row = Math.floor( row );

  var sprite = column + (tileHor*row);
  return sprite;
}

/**
 * The menu-text up in the corner, shows the
 * shovels that you have and shows the score
 * that you currently have.
 */
function menuText(score) {
  context.fillStyle = "white";
  context.font = "20px Comic Sans";
  context.fillText("Number of shovels: " + p1.shovels + "      Score: " + score, 25, 32);
}

/**
 * When the game is finished after the player
 * reaches the exit, shows the end-text and the 
 * score that the player ended up with.
 */
function endText(score) {
  context.fillStyle = "white";
  context.font      = "100px Comic Sans";
  context.fillText("You Won!", canvas.width/4, canvas.height/2);
  context.font      = "50px Comic Sans";
  context.fillText(" Your Score:   " + score, canvas.width/4, (canvas.height/4)*3);
}

/** -----------------------------------------------------------------------------------------
 * This is the player object that is controlled
 * by the user with the WASD-keys, draws, resets,
 * initalize, sets up controls and moves player.
 */

function player() {
  // variables to keep track of position, x and y on the canvas.
  this.x = 0; this.y = 0; this.endGame = false; haveMoved = false;

  // These are changed to true whenever someone presses bound key.
  this.pressedNorth = false; this.pressedEast  = false;
  this.pressedSouth = false; this.pressedWest  = false;

  /**
   * Binds the control's for this to the keys set in input,
   * uses WASD to control the player in the four directions.
   */
  this.playerControls = function(northKey,eastKey,southKey,westKey) {
    this.northKey = northKey; this.eastKey = eastKey;
    this.southKey = southKey; this.westKey = westKey;
  }

  /**
   * This places the player character at the startpoint, and
   * gives it a name and image. Also calls on the restart method
   * and that needs to be called whenever the placement of the
   * player is to be restart.
   */
  this.initialize = function(whichGraphic,whichName) {
    this.myBitmap = whichGraphic;  // The image that should be placed where the character is.
    this.myName = whichName;       // Gives the object a name created in the init-call.
    this.restart();                // Resets everything and readies the new game.
  }
  
  /**
   * The restart function is called in the initalize function, and 
   * makes the game restart the placement of the player object.
   */
  this.restart = function() {
    this.shovels = 0;                           // Number shovels is restart to 0.
    if(this.startpointX == undefined) {         // If the start X and Y have never been set, the game is first started.
      for(var i=0; i<map.length; i++) {      // For the length of the bitmap-array...
        if( map[i] == PLAYER) {              // If the number on the bitmap is a player-object(2)
          var tileRow = Math.floor(i/tileHor);  // Collects the row by dividing with the number of horizontal rows set.

          // Collects the column by collecting the leftover of player-placement multiplied with number of horizontal sprites.
          var tileCol = i%tileHor;

          // Sets the X and Y startpoint in the middle of four squares.
          this.startpointX = tileCol * tileWidth;
          this.startpointY = tileRow * tileHeight;
          // The bitmap to where the player 'spawns' is set to normal ground(0) when the player have been placed.
          map[i] = FLOOR; 
          break; 
        } 
      } 
    } 
    
    // The player object is returned to the startpoint.
    this.x = this.startpointX;
    this.y = this.startpointY;

  } 
  
  /**
   * This is done whenever the player object moves, and is
   * called in main at every frame in the interval. It will
   * check what typr of sprite it lands on and what 
   */ 
  this.movePlayer = function() {
    var nextX = this.x;          // The current X is stored.
    var nextY = this.y;          // The current Y is stored.
    var moveSpeed = 3;           // The move speed of the player, higher is faster.
    var walkIntoTileType = WALL; // Sets here up a var of the const for wall.

    // The this.myBitmap is changed when 
    if(this.pressedNorth) {nextY -= moveSpeed; this.myBitmap = playerUp;    this.haveMoved = true;} // If W is pressed, go up five pixels.
    if(this.pressedEast)  {nextX += moveSpeed; this.myBitmap = playerRight; this.haveMoved = true;} // If A is pressed, go right five pixels.
    if(this.pressedSouth) {nextY += moveSpeed; this.myBitmap = playerDown;  this.haveMoved = true;} // If S is pressed, go down five pixels.
    if(this.pressedWest ) {nextX -= moveSpeed; this.myBitmap = playerLeft;  this.haveMoved = true;} // If D is pressed, go right five pixels.
    
    // Checks what type of sprite the new placement is on.
    var spriteOnNewPos = getSpriteType(nextX, nextY);

    // If there is a sprite on the next X and Y, then...
    if(spriteOnNewPos != undefined) {
      // Collects the number representing the sprite on the bitmap.
      walkIntoTileType = map[spriteOnNewPos];
    }
    
    switch( walkIntoTileType ) {
      case FLOOR:                            // If the player walks on a square with normal ground.
        this.x = nextX;                      // The player objects X = the new X.
        this.y = nextY;                      // The player objects Y = the new Y.
        break;
      case EXIT:                             // If the player walks on a square with the exit.
        this.endGame = true;
        earn_achievement(achievement_id_1);
        this.restart();                      // Resets the player and the score.
        break;
      case DIRT:                             // If the player walks on a square with a dirt-block.
        if(this.shovels > 0) {               // If the player have more than 0 shovels. 
          this.shovels--;                    // Remove one of them.
          map[spriteOnNewPos] = FLOOR;       // Removes the dirt-block from the canvas.
        }
        break;
      case SHOVEL:                           // If the player walks on the square with a shovel.
        this.shovels++;                      // gain one more shovel.
        map[spriteOnNewPos] = FLOOR;         // Then remove the shovel from the canvas.
        if (this.shovels == 1) {earn_achievement(achievement_id_2);break;}
        if (this.shovels == 2) {earn_achievement(achievement_id_3);break;}
        if (this.shovels == 3) {earn_achievement(achievement_id_4);break;}
        if (this.shovels == 4) {earn_achievement(achievement_id_5);break;}
        break;
      default:
        break;
    }
  }

  /**
   * Is called in main whenever the interval happens, draws
   * the next image of the character on the new place with
   * drawImage.
   */
  this.draw = function() {
    context.save(); // Pushes current drawing of player into a 'drawing state stack'.
    context.translate(this.x,this.y); // sets new X and Y.
    // Draws the image again at the new point, places the player in the center of the of it. 
    context.drawImage(this.myBitmap,-this.myBitmap.width/2,-this.myBitmap.height/2);
    context.restore(); // Pops the 'saved' drawing into the 'drawing state stack'.
  } // https://html5.litten.com/understanding-save-and-restore-for-the-canvas-context/

}

/** -----------------------------------------------------------------------------------------
 * The main part of the game-code, starts it on
 * load and calls on the functions that draw on
 * the canvas.
 */

var canvas, context;            // Var for the canvas and the 2d context of it.
var p1 = new player();          // Creates here the new player-character.
var score = 0;                  // Score that is used in the game.
var achievement_id_1 = 1;         // The id of the achievement for reaching the end of the first level.
var achievement_id_2 = 2; 
var achievement_id_3 = 3; 
var achievement_id_4 = 4; 
var achievement_id_5 = 5; 

/**
 * This happens whenever the game is loaded onto the page.
 * Starts the game automatically by calling the first function.
 */
window.onload = function() {
  canvas = document.getElementById('canvas');       // Collects the canvas by id.
  context = canvas.getContext('2d');                // Collects the 2d-context. 
  loadImages();                                     // Loads in the images to be used.
}

/**
 * This is called when the images have been loaded in,
 * and will be called image.js when it is complete. The
 * Set interval will be running over and over, moving 
 * and painting everything at a set interval. Will 
 * also initalize the player-character and collect the 
 * input.
 */
function loadingDoneSoStartGame() {
  setInterval(function() {          // Sets here the interval that will run continuesly.
      moveEverything();             // Calls on the function that moves the player.
      drawEverything();             // Calls on the function that draws everything anew.
    },20);                          // Sets it to do so every 30 miliseconds.
  
  p1.initialize(playerDown, "You"); // Places the player character in the came.
  initInput();                      // Call's on the function that collects input.
}

/**
 * This moves the character to its next postition,
 * if there is any more things that should be moved
 * then the function shoul be called here.
 */
function moveEverything() {
  if(p1.endGame) {return;}            // If the endgame property on the player character is true, stop here.
  p1.movePlayer();                    // Moves the player by calling on the player class move().
}

/**
 * The function that draws everything on the canvas,
 * is called after moveEverything and draws the tiles
 * and the new postition of the player.
 */
function drawEverything() {
  placeSprites();                           // Draws the tiles that is placed in the room.
  if (p1.endGame) {endText(score);return;}  // If the endgame property on the player is true, stop here.
  p1.draw();                                // Draws the player in it's postition.
  if (p1.haveMoved) {score--;}              // 
  menuText(score);


}
</script>				
