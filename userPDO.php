<?php
require_once "user.php";
class userPDO {

	private $db;
	private $number;

	function __construct($dsn = "mysql:host=localhost;dbname=a1500862", $user = "root", $password = "salainen") {
		// Connection to database
		$this->db = new PDO ( $dsn, $user, $password );

		// Looking for errors while developing
		$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		// To prevent MySQL injection MySQL injection
		$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );

		// Count of rows
		$this->number = 0;
	}

	// Method returns count of rows
	function getNumber() {
		return $this->number;
	}

	public function allUsers() {
		$sql = "SELECT id, name, birthyear, email, desc
		        FROM user";

		// Prepare statement
		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();

			throw new PDOException ( $error [2], $error [1] );
		}

		// Run statement
		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();

			throw new PDOException ( $error [2], $error [1] );
		}

		// Handle the result of filter
		$result = array ();

		while ( $row = $stmt->fetchObject () ) {

			$user = new User ();
            $user->setId ( $row->id );
			$user->setName ( utf8_encode ( $row->name ) );
			$user->setBirthyear ( $row->birthyear );
			$user->setEmail (  utf8_encode ( $row->email ) );
			$user->setDesc (  utf8_encode ( $row->desc ) );

			$result [] = $user;
		}

		$this->number = $stmt->rowCount ();

		return $result;
	}

	public function fetchUsers($name) {
		$sql = "SELECT id, name, birthyear, email, desc
		        FROM user
				WHERE name like :name";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();
			throw new PDOException ( $error [2], $error [1] );
		}

		$na = "%" . utf8_decode ( $name ) . "%";
		$stmt->bindValue ( ":name", $na, PDO::PARAM_STR );

		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();

			if ($error [0] == "HY093") {
				$error [2] = "Invalid parameter";
			}

			throw new PDOException ( $error [2], $error [1] );
		}

		$result = array ();

		while ( $row = $stmt->fetchObject () ) {
			$user = new User ();

			$user->setId ( $row->id );
			$user->setName ( utf8_encode ( $row->name ) );
			$user->setBirthyear ( $row->birthyear );
			$user->setEmail ( utf8_encode ( $row->email ) );
			$user->setDesc ( utf8_encode ($row->desc ) );

			$result [] = $user;
		}

		$this->number = $stmt->rowCount ();

		return $result;
	}

	function addUser($user) {
		$sql = "insert into user (name, birthyear, email, desc)
		        values (:name, :birthyear, :email, :desc)";

		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();
			throw new PDOException ( $error [2], $error [1] );
		}

		$stmt->bindValue ( ":name", utf8_decode ( $user->getName () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":birthyear", $user->getBirthyear (), PDO::PARAM_STR );
		$stmt->bindValue ( ":email", utf8_decode ( $user->getEmail () ), PDO::PARAM_INT );
		$stmt->bindValue ( ":desc", utf8_decode ( $user->getDesc () ), PDO::PARAM_STR );

		$this->db->beginTransaction();

		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();

			if ($error [0] == "HY093") {
				$error [2] = "Invalid parameter";
			}
			$this->db->rollBack();

			throw new PDOException ( $error [2], $error [1] );
		}

		$id = $this->db->lastInsertId ();

		$this->db->commit();

		return $id;
	}
}
?>
