<?php 


class Game extends Db_object {

	//Klasse-variabler kalles properties.
	protected static $db_table = "games"; //Slik at man kan endre navnet på databasetabellen.

	//Array skal brukes i properies() og inneholder bruker-variablene til objektet.
	protected static $db_table_fields = array('id', 'title', 'description', 'foldername', 'filename', 'genre', 'creator', 'size');
	public $id; 
	public $title;
	public $description;
	public $foldername;
	public $filename;
	public $size;
	public $genre;
	public $creator;

	public $tmp_path; //Temp path for storing games.
	public $upload_directory = "games";
	public $errors = array(); // Other error messages outside of the _ERR ones.
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


	// får $_FILES['uploaded_file'] som et argument($file), sets up the file.
	public function set_file($file) {

		// If file is empty, if there is no file, if type is notr array.
		if (empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;

		} elseif ($file['error'] != 0) {
			$this->errors[] = $this ->upload_errors_array[$file['error']]; //Places them together.
			return false;

		} else {

			$this->foldername = basename($file['name']);  //Rensker og henter ut foldernavnet 
			$this->filename   = substr($this->foldername, 0, -3) . "php"; // kutter av zip og legger til php på der canvas ligger.
			$this->tmp_path   = $file['tmp_name'];
			$this->size       = $file['size'];

		}
	}

	// Collects the placement of the game path, used when showing the picture at gameslist.
	public function game_path() {

		return $this->upload_directory . DS . $this->foldername . DS . $this->filename;
	}

	// Collects the placement of the game path, used when showing the picture at gameslist.
	public function game_image_path() {

		return $this->upload_directory . DS . $this->foldername . DS . "image.png";
	}

	// Saves a game-object that has been made, the files and database-information.
	// Also does a lot of error checking.
	public function save() {
		
		//Checks if this has a game_id, if it has the game will be updated instead.
		if ($this->id) {
			$this->update();
			
		} else {

			// If there is errors in the error-array.
			if (!empty($this->errors)) {
				return false;
			}

			// If there is no foldername or temporary path.
			if (empty($this->foldername) || empty($this->tmp_path)) {
				return false;
			}

			// Sets up the target path where the saved file will be stored.
			$target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->foldername; 

			// If the target_path file already  exists.
			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->foldername} already exists";
				return false;
			}

			// Henter ut det som kommer etter punktom i filnavnet.
			$fileType = strtolower(pathinfo($this->foldername,PATHINFO_EXTENSION));
			
			// Gjør dette hvis det ikke er en zip-fil som har blitt lastet opp.
			if ($fileType != "zip") {
				$this->errors[] = "The file {$this->foldername} is not a zip-file";
				return false;
			}

			// Her setter man innholdet av zip-filen inn i spill mappen.
			$zip = new ZipArchive;
			if ($zip->open($this->tmp_path) === TRUE) {
				$zip->extractTo($target_path);

			    // If the game added to the database with no problems
				if ($this->create()) {
					unset($this->tmp_path);
					return true;
				}

			} else {
				
				// If it reaches to this point then there is most likely something wrong with permissions.
				$this->errors[] = "There is something wrong with the folder-permissions.";
				return false;
			}

		}
	}

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

	public function get_rating() {

		global $database;

		$game_id = $this->id;

		$sql  = "SELECT AVG(score) FROM ratings WHERE ";
		$sql .= "game_id = '{$game_id}' ";
		$sql .= "LIMIT 1";

		$result = $database->query($sql);

		// Breaks the answer up with implode and shows the average score.
		if ($row = $result->fetch_assoc()) {
			$average_score = implode(", ", $row);
		}

		// Ensures that there is only two decimals in the score.		
		// Sends the score to the place where the function is called.
		return !empty($average_score) ? number_format($average_score, 2, '.', ',') : false;

	}

} // End of games-class.



?>