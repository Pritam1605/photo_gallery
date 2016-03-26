<?php

	class Session {

		public $user_id;
		private $_logged_in = FALSE;	// It is private so as not to allow anyone to log the use in by just accessing the variable
		static private $_instance;

		static public function getSessionInstance() {
			if (!isset(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function __construct() {
			session_start();
			$this->_checkLogin();

			if ($this->_logged_in) {

			} else {

			}
		}

		private function _checkLogin() {
			if (isset($_SESSION['user_id'])) {
				$this->_logged_in = TRUE;
				$this->user_id = $_SESSION['user_id'];
			} else {
				unset($this->user_id);
				$this->_logged_in = FALSE;
			}
		}

		public function isLoggedIn() {
			return $this->_logged_in;
		}

		public function logIn($user) {
			if ($user) {
				$this->user_id = $_SESSION['user_id'] = $user->id;
				$this->_logged_in = TRUE;
			}
		}

		public function logOut() {
			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->_logged_in = FALSE;
		}

		private function __clone() {
			// empty body will not allow the object cloning
		}
	}


?>