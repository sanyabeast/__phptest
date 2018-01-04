<?php 
	
	// require("tools.php");

	class Users {
		private $db;
		private $delightAuth;
		private $userID;


		public function __construct(){
			try {
				$this->db = new PDO("mysql:host=test0;dbname=phpauth", "root", "");
				$this->delightAuth = new Delight\Auth\Auth($this->db);
			} catch (PDOException $e){
				Tools::log("PDOException code ".$e->getCode());
			}
		}

		public function register($email, $password, $username, $callback){
			try {
			    $this->userID = $this->delightAuth->register($email, $password, $username, $callback);
			    Tools::log("Auth success: new user created");
			}
			catch (\Delight\Auth\InvalidEmailException $e) {
				Tools::log("Auth failed: invalid email adress");
			    // invalid email address
			}
			catch (\Delight\Auth\InvalidPasswordException $e) {
				Tools::log("Auth failed: invalid password");
			    // invalid password
			}
			catch (\Delight\Auth\UserAlreadyExistsException $e) {
				Tools::log("Auth failed: user already exists");
			    // user already exists
			}
			catch (\Delight\Auth\TooManyRequestsException $e) {
				Tools::log("Auth failed: too many requests");
			    // too many requests
			}
		}

		public function login($email, $password, $callback){
			try {
			    $this->delightAuth->login($email, $password);
			    Tools::log("Auth success: logged in successfully");
			}
			catch (\Delight\Auth\InvalidEmailException $e) {
				Tools::log("Auth failed: wrong email adress");
			}
			catch (\Delight\Auth\InvalidPasswordException $e) {
				Tools::log("Auth failed: wrong password");
			}
			catch (\Delight\Auth\EmailNotVerifiedException $e) {
				Tools::log("Auth failed: email not verified");
			}
			catch (\Delight\Auth\TooManyRequestsException $e) {
				Tools::log("Auth failed: too many requests");
			}
		}

		public function confirmEmail($selector, $token){
			try {
			    $this->delightAuth->confirmEmail($selector, $token);
			    Tools::log("Auth success: email confirmed");
			}
			catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
				Tools::log("Auth failed: invalid tokend");
			}
			catch (\Delight\Auth\TokenExpiredException $e) {
				Tools::log("Auth failed: token expired");
			}
			catch (\Delight\Auth\UserAlreadyExistsException $e) {
				Tools::log("Auth failed: email address already exists");
			}
			catch (\Delight\Auth\TooManyRequestsException $e) {
				Tools::log("Auth failed: too many requests");
			}
		}
	}

?>