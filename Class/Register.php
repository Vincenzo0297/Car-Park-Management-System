<?php
    class Register {
        public $userName;
        public $userEmail;
        public $userPassword;
        public $userNumber;
        public $userRole;
        public function __construct($userName, $userEmail, $userPassword, $userNumber, $userRole) {
            $this->userName = $userName;
            $this->userEmail = $userEmail;
            $this->userPassword = $userPassword;
            $this->userNumber = $userNumber;
            $this->userRole = $userRole;
        }

        public function getUserName() {
            return $this->userName;
        }

        public function getUserEmail() {
            return $this->userEmail;
        }

        public function getUserPassword() {
            return $this->userPassword;
        }

        public function getUserNumber() {
            return $this->userNumber;
        }

        public function getUserRole() {
            return $this->userRole;
        }

        public function setUserName($userName) {
            $this->userName = $userName;
        }

        public function setUserEmail($userEmail) {
            $this->userEmail = $userEmail;
        }

        public function setUserPassword($userPassword) {
            $this->userPassword = $userPassword;
        }

        public function setUserNumber($userNumber) {
            $this->userNumber = $userNumber;
        }

        public function setUserRole($userRole) {
            $this->userRole = $userRole;
        }

        public function toString() {
            return "User Name: " . $this->userName . "\n" .
                   "User Email: " . $this->userEmail . "\n" .
                   "User Password: " . $this->userPassword . "\n" .
                   "User Number: " . $this->userNumber . "\n" .
                   "User Role: " . $this->userRole;
        }
    }
?>