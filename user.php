<?php
class user  {

	// Taulukko, missä on virhekoodeja vastaavat virhetekstit
	private static $errorlist = array (
			- 1 => "Incorrect information",
			0 => "",
			11 => "Name is required",
			12 => "Name is too short",
			13 => "Name is too long",
      21 => "Birth year is required",
			22 => "Birth year must be yyyy ( 4 numbers)",
			23 => "Birth year is cannot be under 1900",
			24 => "Birth year cannot be in the future",
			31 => "Email is required",
			32 => "Email is too long",
			33 => "Email must contain @",
			41 => "Description is too long",
			42 => "Desctiption is allowed to contain characters, numbers and - ,.!?"
	);

	// Attributes
	private $name;
	private $birthyear;
	private $email;
	private $desc;

	// Constructor
	function __construct($name = "", $birthyear = "", $email = "", $desc = "") {
		$this->name = trim ( $name );
		$this->birthyear = trim ( $birthyear );
		$this->email = trim ( $email );
		$this->desc = trim ( $desc );
	}

	// Methods
	public function setName($name) {
		$this->name = trim ( $name );
	}
	public function getName() {
		return $this->name;
	}

	public function checkName($required = true, $min = 1, $max = 40) {

		// If cannot be empty but is empty
		if ($required == true && strlen ( $this->name ) == 0) {
			return 11;
		}

		// If name is too short
		if (strlen ( $this->name ) < $min) {
			return 12;
		}

		// If name is too long
		if (strlen ( $this->name ) > $max) {
			return 13;
		}
		// If OK
		return 0;
	}

	public function setBirthyear($birthyear) {
		$this->birthyear = $birthyear;
	}

	public function getBirthyear() {
		return $this->birthyear;
	}

	public function checkBirthyear($required = true, $min = 1900) {

		if ($required == true && strlen ( $this->birthyear ) == 0) {
			return 21;
		}

		// Must be 4 numbers
		if (! preg_match ( "/^\d{4}$/", $this->birthyear )) {
			return 22;
		}

		if ($this->birthyear < $min) {
			return 23;
		}

		// if birthyear is on the future
		$max = date ( "Y", time () );
		if ($this->birthyear > $max) {
			return 24;
		}

		// If OK
		return 0;
	}

	public function setEmail($email) {
		$this->email = trim ( $email );
	}

	public function getEmail() {
		return $this->email;
	}

	public function checkEmail($required = true, $max = 40) {

		if ($required == true && strlen ( $this->email ) == 0) {
			return 31;
		}

		// If description is too long
		if (strlen ( $this->email ) > $max) {
			return 32;
		}

		// Email must contain @
		if (preg_match ( "/@/", $this->email ) == 0) {
			return 33;
		}

	// If OK
	return 0;
	}

		public function setDesc($desc) {
			$this->kuvaus = trim ( $desc );
		}

		public function getDesc() {
			return $this->desc;
		}

		public function checkDesc($required = false, $max = 200) {
			// Jos saa olla tyhjä ja on tyhjä
			if ($required == false && strlen ( $this->desc) == 0) {
				return 0;
			}

			// If description is too long
			if (strlen ( $this->desc ) > $max) {
				return 41;
			}

			// Description is allowed to contain characters, numbers and - ,.!?
			if (preg_match ( "/^[a-zöåä0-9\-.,!?]$/i", $this->desc )) {
				return 42;
			}
		// If OK
		return 0;
	}

	// Method shows matching error message
	public static function getError($errorcode) {
		if (isset ( self::$errorlist [$errorcode] ))
			return self::$errorlist [$errorcode];

		return self::$errorlist [- 1];
	}
}
?>
