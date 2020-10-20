<?php

    class DbOperations {

        private $con;

        function __construct(){
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect;
            $this->con = $db->connect();
        }
        # creates variables of a user
        public function createUser($user_email, $user_password, $first_name, $last_name){
            if (!$this->emailExists($user_email)){
                $stmt = $this->con->prepare("INSERT INTO users (user_email, user_password, first_name, last_name) VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $user_email, $user_password, $first_name, $last_name);
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
            $stmt = $this->con->prepare("SELECT user_password FROM users WHERE user_email = ?" );
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->bind_result($user_password);
            $stmt->fetch();
            return $user_password;
        }
        
        # Returns all users data in database
        public function getAllUsers() {
            $stmt = $this->con->prepare("SELECT user_id, user_email, first_name, last_name FROM users;" );
            $stmt->execute();
            $stmt->bind_result($user_id, $user_email, $first_name, $last_name);
            while($stmt->fetch()) {
                $users = array();
                $user['user_id'] = $user_id;
                $user['user_email'] = $user_email;
                $user['first_name'] = $first_name;
                $user['last_name'] = $last_name;
                array_push($users, $user);
            }
            return $users;
        }

        # returns a single user using email. User password is grabbed through getUserPasswordsByEmail() function
        public function getUserByEmail($user_email) {
            $stmt = $this->con->prepare("SELECT user_id, user_email, first_name, last_name FROM users WHERE user_email = ?" );
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->bind_result($user_id, $user_email, $first_name, $last_name);
            $stmt->fetch();
            $user = array();
            $user['user_id'] = $user_id;
            $user['user_email'] = $user_email;
            $user['first_name'] = $first_name;
            $user['last_name'] = $last_name;

            return $user;
        }

        public function updateUser($user_email, $first_name, $last_name, $user_id) {
            $stmt = $this->con->prepare("UPDATE users SET user_email = ?, first_name = ?, last_name = ? WHERE user_id = ? ");
            $stmt->bind_param("sssi", $user_email, $first_name, $last_name, $user_id);
            if($stmt->execute())
                return true;
            return false;

        }

        public function updatePassword($currentpassword, $newpassword, $user_email) {
            $hashed_password = $this->getUserPasswordsByEmail($user_email);
        
            if(password_verify($currentpassword, $hashed_password)) {
                $hash_password = password_hash($newpassword, PASSWORD_DEFAULT);
                $stmt = $this->con->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
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

        # checks to see if email is in the database
        private function emailExists($user_email) {
            $stmt = $this->con->prepare("SELECT user_id FROM users Where user_email = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;

        }
    }
?>