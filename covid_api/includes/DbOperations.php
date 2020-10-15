<?php

    class DbOperations {

        private $con;

        function __construct(){
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect;
            $this->con = $db->connect();
        }

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
            
    
        private function emailExists($user_email) {

            $stmt = $this->con->prepare("SELECT user_id FROM users Where user_email = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;

        }
    }
?>