<?php 

/**
 * This is the class that handles the games added to the webside,
 * it has all the neccesary properties to be ensure that the game
 * can be found in its folder and the neccesary information about
 * it.
 */

class Game extends Db_object {

	protected static $db_table = "games"; 

	protected static $db_table_fields = array('id', 'title', 'description', 'foldername', 'filename', 'genre', 'creator', 'size');
	public $id; 
	public $title;
	public $description;
	public $foldername;
	public $filename;
	public $size;
	public $genre;
	public $creator;

	public $tmp_path; 
	public $upload_directory = "games";
	public $errors = array();
	public $upload_errors_array = array(

		UPLOAD_ERR_OK            => "There is no error",
		UPLOAD_ERR_INI_SIZE      => "The uploaded file exceeds the UPLOAD_MAX_FILESIZE",
		UPLOAD_ERR_FORM_SIZE     => "The uploaded file exceeds the MAX_FILE_SIZE",
		UPLOAD_ERR_PARTIAL       => "The uploaded file was only partially uploaded",
		UPLOAD_ERR_NO_FILE       => "No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR    => "Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE    => "Failed to write to disk",
		UPLOAD_ERR_EXTENSION     => "A PHP extension stopped the file upload."

	);

	/**
	 * Gets the file as an argument and then does what it needs to do to it.
	 * Checks if the file is empty or if there is an error, makes agame if all
	 * is okay.
	 *
	 * @param $file the file that information will be collected from.
	 * @return True if all OK, false if error.
	*/
	public function set_file($file) {

		if (empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;

		} elseif ($file['error'] != 0) {
			$this->errors[] = $this ->upload_errors_array[$file['error']]; 
			return false;

		} else {

			$this->foldername = basename($file['name']); 
			$this->filename   = substr($this->foldername, 0, -3) . "php"; 
			$this->tmp_path   = $file['tmp_name'];
			$this->size       = $file['size'];
			return true;
		}
	}
 
	/**
	 * Collects the placement of the game path, used when the game is called.
	 * The game path is the main PHP file that needs to be included on the 
	 * gamepage, and will only contain a canvas that get loaded in.
	 *
	 * @return the path to the games-folder where the main js is stored.
	 */
	public function game_path() {

		return $this->upload_directory . DS . $this->foldername . DS . $this->filename;
	}

	/**
	 * Collects the placement of the game path, used when showing the picture 
	 * at the gameslist. The picture needs to be named image.png at the moment.
	 *
	 * @return the path to the games-folder where the image id stored.
	 */
	public function game_image_path() {

		return $this->upload_directory . DS . $this->foldername . DS . "image.png";
	}

	/**
	 * Stores a game object that have been made, and the database object for it.
	 * It also does a lot of error-checking when it does so.
	 *
	 * @return true if the process was finished and false if there was errors.
	 */
	public function save() {
		
		if ($this->id) {
			$this->update();
			
		} else {

			if (!empty($this->errors)) {
				return false;
			}

			if (empty($this->foldername) || empty($this->tmp_path)) {
				return false;
			}

			$target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->foldername; 

			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->foldername} already exists";
				return false;
			}

			$fileType = strtolower(pathinfo($this->foldername,PATHINFO_EXTENSION));
			
			if ($fileType != "zip") {
				$this->errors[] = "The file {$this->foldername} is not a zip-file";
				return false;
			}

			$zip = new ZipArchive;
			if ($zip->open($this->tmp_path) === TRUE) {
				$zip->extractTo($target_path);

				if ($this->create()) {
					unset($this->tmp_path);
					return true;
				}

			} else {
				
				$this->errors[] = "There is something wrong with the folder-permissions.";
				return false;
			}

		}
	}
	
	/**
	 * Uses the player-choosen category, genre and input search to
	 * look trough all the games stored in the database, to then
	 * collect all that fits.
	 * 
	 * @param $category is what the user wants to search in, like title or creator. 
	 * @param $genre is the genre of game you want to search trough.
	 * @param $search is the input that the user have written in the form.
	 * @return the list of games that fits to the search.
	 */
	public function find_game($category, $genre, $search) {

		$sql  = "SELECT * FROM games WHERE ";
		$sql .= " genre LIKE '%{$genre}%' ";

		if ($category == "title") {
			$sql .= "AND title LIKE '%{$search}%' ";
		} elseif ($category == "creator") {
			$sql .= "AND creator LIKE '%{$search}%' ";
		} else {
			$sql .= "AND (title LIKE '%{$search}%' ";
			$sql .= "OR creator LIKE '%{$search}%') ";
		}

		return self::find_by_query($sql);
	}

	/**
	 * Collects the average score from one of the games based on the game id,
	 * then sends it back after making sure that the number format is a double
	 * with two decimals.
	 *
	 * @return The average score of the game with two decimals.
	 */
	public function get_rating() {

		global $database;

		$game_id = $this->id;

		$sql  = "SELECT AVG(score) FROM ratings WHERE ";
		$sql .= "game_id = '{$game_id}' ";
		$sql .= "LIMIT 1";

		$result = $database->query($sql);

		if ($row = $result->fetch_assoc()) {
			$average_score = implode(", ", $row);
		}

		return !empty($average_score) ? number_format($average_score, 2, '.', ',') : false;

	}

} // End of games-class.



?>