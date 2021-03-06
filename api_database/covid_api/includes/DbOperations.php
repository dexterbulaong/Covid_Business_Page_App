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

        #create variables of a business
        public function createBusiness($business_id, $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated ){
            if (!$this->idExistsForBusiness($business_id)){
                $stmt = $this->con->prepare("INSERT INTO businesses (business_id, business_name, business_address, business_hours, business_type, business_link, entry_date, last_updated) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->bind_param("isssssss", $business_id, $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated);
                if ($stmt->execute()) {
                    return USER_CREATED;
                } 
                else {
                    return USER_FAILURE;
                }
            }
            return USER_EXISTS;
        }

        # create variables of a protocol
        public function createProtocols($business_id, $status, $mask_required, $customer_limit, $curbside_pickup ){
            if (!$this->idExistsForProtocols($business_id)){
                $stmt = $this->con->prepare("INSERT INTO protocols (business_id, status, mask_required, customer_limit, curbside_pickup) VALUES (?,?,?,?,?)");
                $stmt->bind_param("issss", $business_id, $status, $mask_required, $customer_limit, $curbside_pickup);
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

        # returns a row from the business_users table using business_id
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
        
        # returns a row from the businesses table based on the business_id
        public function getBusinessById($business_id) {
            $stmt = $this->con->prepare("SELECT business_id, business_name, business_address, business_hours, business_type, business_link, entry_date, last_updated FROM businesses WHERE business_id = ?" );
            $stmt->bind_param("i", $business_id);
            $stmt->execute();
            $stmt->bind_result($business_id, $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated);
            $stmt->fetch();
            $business = array();
            $business['business_id'] = $business_id;
            $business['business_name'] = $business_name;
            $business['business_address'] = $business_address;
            $business['business_hours'] = $business_hours;
            $business['business_type'] = $business_type;
            $business['business_link'] = $business_link;
            $business['entry_date'] = $entry_date;
            $business['last_updated'] = $last_updated;
            
            return $business;
        }
        
        # returns a row from the businesses table based on the business_name
        public function getBusinessByName($business_name) {
            $stmt = $this->con->prepare("SELECT business_id, business_name, business_address, business_hours, business_type, business_link, entry_date, last_updated FROM businesses WHERE business_name = ?" );
            $stmt->bind_param("s", $business_name);
            $stmt->execute();
            $stmt->bind_result($business_id, $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated);
            $stmt->fetch();
            $business = array();
            $business['business_id'] = $business_id;
            $business['business_name'] = $business_name;
            $business['business_address'] = $business_address;
            $business['business_hours'] = $business_hours;
            $business['business_type'] = $business_type;
            $business['business_link'] = $business_link;
            $business['entry_date'] = $entry_date;
            $business['last_updated'] = $last_updated;
            
            return $business;
        }

        # returns all from the businesses table based on the business_type
        public function getBusinessesByType($business_type) {
            $stmt = $this->con->prepare("SELECT business_id, business_name, business_address, business_hours, business_type, business_link, entry_date, last_updated FROM businesses WHERE business_type = ?;" );
            $stmt->bind_param("s", $business_type);
            $stmt->execute();
            $stmt->bind_result($business_id, $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated);
            $businesses = array();
            while($stmt->fetch()) {
                $business = array();
                $business['business_id'] = $business_id;
                $business['business_name'] = $business_name;
                $business['business_address'] = $business_address;
                $business['business_hours'] = $business_hours;
                $business['business_type'] = $business_type;
                $business['business_link'] = $business_link;
                $business['entry_date'] = $entry_date;
                $business['last_updated'] = $last_updated;
                array_push($businesses, $business);
            }
            
            return $businesses;
        }

        # returns a row from the protocols table based on business_id
        public function getProtocolById($business_id) {
            $stmt = $this->con->prepare("SELECT business_id, status, mask_required, customer_limit, curbside_pickup FROM protocols WHERE business_id = ?" );
            $stmt->bind_param("i", $business_id);
            $stmt->execute();
            $stmt->bind_result($business_id, $status, $mask_required, $customer_limit, $curbside_pickup);
            $stmt->fetch();
            $protocol = array();
            $protocol['business_id'] = $business_id;
            $protocol['status'] = $status;
            $protocol['mask_required'] = $mask_required;
            $protocol['customer_limit'] = $customer_limit;
            $protocol['business_type'] = $curbside_pickup;
            
            return $protocol;
        }
        

        # updates a row from the business_users table
        public function updateUser($user_email, $business_name, $business_id) {
            $stmt = $this->con->prepare("UPDATE business_users SET user_email = ?, business_name = ? WHERE business_id = ? ");
            $stmt->bind_param("ssi", $user_email, $business_name, $business_id);
            if($stmt->execute())
                return true;
            return false;
        }

        # updates a row from the businesses table
        public function updateBusinesses($business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated, $business_id) {
            $stmt = $this->con->prepare("UPDATE businesses SET business_name = ?, business_address = ?, business_hours = ?, business_type = ?, business_link = ?, entry_date = ?, last_updated = ? WHERE business_id = ? ");
            $stmt->bind_param("sssssssi", $business_name, $business_address, $business_hours, $business_type, $business_link, $entry_date, $last_updated, $business_id);
            if($stmt->execute())
                return true;
            return false;
        }

        # updates a row from the protocols table
        public function updateProtocols($status, $mask_required, $customer_limit, $curbside_pickup, $business_id) {
            $stmt = $this->con->prepare("UPDATE protocols SET status = ?, mask_required = ?, customer_limit = ?, curbside_pickup = ? WHERE business_id = ? ");
            $stmt->bind_param("ssssi", $status, $mask_required, $customer_limit, $curbside_pickup, $business_id);
            if($stmt->execute())
                return true;
            return false;
        }

        # updates the hashed password from the business_users table
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
        # deletes all rows from all tables in the database associated with the business_id
        public function deleteEntity($business_id) {
            $stmt = $this->con->prepare("DELETE FROM business_users WHERE business_id = ?");
            $stmt_business = $this->con->prepare("DELETE FROM businesses WHERE business_id = ?");
            $stmt->bind_param("i", $business_id);

            $stmt2 = $this->con->prepare("DELETE FROM businesses WHERE business_id = ?");
            $stmt2->bind_param("i", $business_id);

            $stmt3 = $this->con->prepare("DELETE FROM protocols WHERE business_id = ?");
            $stmt3->bind_param("i", $business_id);

            $stmt_increment = $this->con->prepare("ALTER TABLE business_users AUTO_INCREMENT=1");
            if($stmt3->execute()) {
                if($stmt2->execute()) {
                    if($stmt->execute()) {
                        $stmt_increment->execute();
                        return true;
                    }
                }
            }
            else if($stmt2->execute()) {
                if($stmt->execute()) {
                    $stmt_increment->execute();
                    return true;
                }
            }
            else if($stmt->execute()) {
                $stmt_increment->execute();
                return true;
            }
            return false;
        }     

        # checks to see if email is in the database
        private function emailExists($user_email) {
            $stmt = $this->con->prepare("SELECT business_id FROM business_users WHERE user_email = ?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        }

        # checks to see if a business_id exists in the businesses table
        private function idExistsForBusiness($business_id) {
            $stmt = $this->con->prepare("SELECT business_id FROM businesses WHERE business_id = ?");
            $stmt->bind_param("i", $business_id);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        }

        # checks to see if a business exists in the protocols table
        private function idExistsForProtocols($business_id) {
            $stmt = $this->con->prepare("SELECT business_id FROM protocols WHERE business_id = ?");
            $stmt->bind_param("i", $business_id);
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        }
    }
?>