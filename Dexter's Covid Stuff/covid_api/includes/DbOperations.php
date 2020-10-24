<?php

    class DbOperations {

        private $con;

        function __construct(){
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect;
            $this->con = $db->connect();
        }
        # creates variables of a user
        public function createUser($user_email, $user_password, $business_name){
            if (!$this->emailExists($user_email)){
                $stmt = $this->con->prepare("INSERT INTO business_users (user_email, user_password, business_name) VALUES (?,?,?)");
                $stmt->bind_param("sss", $user_email, $user_password, $business_name);
                if ($stmt->execute()) {
                    return USER_CREATED;
                } 
                else {
                    return USER_FAILURE;
                }
            }
            return USER_EXISTS;
        }
        
        # returns whether or not the user info in paramters is valid
        public function userLogin($user_email, $user_password) {
            if($this->emailExists($user_email)) {

                $hashed_password = $this->getUserPasswordsByEmail($user_email);

                if(password_verify($user_password, $hashed_password)) {
                    return USER_AUTHENTICATED;
                }
                else {
                    return USER_PASSWORD_DOES_NOT_MATCH;
                }
            }
            else {
                return USER_NOT_FOUND;
            }
        }

        # grabs and decodes the password of a user in the database using the email 
        private function getUserPasswordsByEmail($user_email) {
            $stmt = $this->con->prepare("SELECT user_password FROM business_users WHERE user_email = ?" );
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->bind_result($user_password);
            $stmt->fetch();
            return $user_password;
        }
        
        # Returns all business_users data in database
        public function getAllUsers() {
            $stmt = $this->con->prepare("SELECT business_id, user_email, business_name FROM business_users;" );
            $stmt->execute();
            $stmt->bind_result($business_id, $user_email, $business_name);
            $business_users = array();
            while($stmt->fetch()) {
                $user = array();
                $user['business_id'] = $business_id;
                $user['user_email'] = $user_email;
                $user['business_name'] = $business_name;
                array_push($business_users, $user);
            }
            return $business_users;
        }

        # returns a single user using email. User password is grabbed through getUserPasswordsByEmail() function
        public function getUserByEmail($user_email) {
            $stmt = $this->con->prepare("SELECT business_id, user_email, business_name FROM business_users WHERE user_email = ?" );
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->bind_result($business_id, $user_email, $business_name);
            $stmt->fetch();
            $user = array();
            $user['business_id'] = $business_id;
            $user['user_email'] = $user_email;
            $user['business_name'] = $business_name;

            return $user;
        }

        public function updateUser($user_email, $business_name, $business_id) {
            $stmt = $this->con->prepare("UPDATE business_users SET user_email = ?, business_name = ? WHERE business_id = ? ");
            $stmt->bind_param("ssi", $user_email, $business_name, $business_id);
            if($stmt->execute())
                return true;
            return false;

        }

        public function updatePassword($currentpassword, $newpassword, $user_email) {
            $hashed_password = $this->getUserPasswordsByEmail($user_email);
        
            if(password_verify($currentpassword, $hashed_password)) {
                $hash_password = password_hash($newpassword, PASSWORD_DEFAULT);
                $stmt = $this->con->prepare("UPDATE business_users SET user_password = ? WHERE user_email = ?");
                $stmt->bind_param("ss", $hash_password, $user_email);

                if($stmt->execute()) {
                    return PASSWORD_CHANGED;
                }
                else {
                    return PASSWORD_NOT_CHANGED;
                }
            }
            else {
                    return PASSWORD_DOES_NOT_MATCH;
            }
        }
        # deletes users
        public function deleteUser($business_id) {
            $stmt = $this->con->prepare("DELETE FROM business_users WHERE business_id = ?");
            $stmt->bind_param("i", $business_id);
            $stmt_increment = $this->con->prepare("ALTER TABLE business_users AUTO_INCREMENT=1");
            if($stmt->execute()) {
                $stmt_increment->execute();
                return true;
            }
            return false;
        }

        # checks to see if email is in the database
        private function emailExists($user_email) {
            $stmt = $this->con->prepare("SELECT business_id FROM business_users Where user_email = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;

        }
    }
?>