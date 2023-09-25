<?php	
	define ("DB_HOST", "localhost"); 
	define ("DB_NAME", "tra931_owens"); 
	define ("DB_TABLE", "users_table"); 
	define ("DB_USER", "tra931_owens"); 
	define ("DB_PASS", "CMQZR7bm297FLVr");


	// define ("DB_HOST", "localhost"); //Databse Host.
	// define ("DB_NAME", "tra931_owens"); //tra931_fun.
	// define ("DB_TABLE", "users_table"); //tra931_fun.
	// define ("DB_USER", "root"); //tra931_funnel.
	// define ("DB_PASS", ""); //Ua,}Xj+uzK2c.

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

    function if_table_exists($tablename) {
		global $db; 

		if(empty($tablename)) {
			return FALSE;
		}
		if($result = $db->query("SHOW TABLES LIKE '{$tablename}'")) {
			if($result->num_rows == 0) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
    function create_table($DB_TABLE){
		global $db; 

        if(!if_table_exists($DB_TABLE)){
            // Define your SQL query to create a table
            $sql = "CREATE TABLE {$DB_TABLE} (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            age INT(3),
            date DATE
            )";
    
            // Execute the SQL query
            if ($db->query($sql) !== TRUE) {
                die("Error creating table: " . $db->error);
            } 
        }
    }
	function delete_table($DB_TABLE){
		global $db; 

        if(if_table_exists($DB_TABLE)){
            $sql = "DROP TABLE IF EXISTS {$DB_TABLE}";
            // Execute the SQL query
            if ($db->query($sql) !== TRUE) {
                die("Error deleting table: " . $db->error);
            }
        }
    }

    class Record {
        public $firstname = '';
        public $lastname = '';
        public $password = ''; // Replace with the actual hashed password
        public $age = 0;
        public $date = '2023-05-05';
        
        public static $staticProperty = "-80";
        public static function create(Record $record, string $DB_TABLE)
        {
		    global $db; 

            if (empty($DB_TABLE)) {
               die("invalid arg...");
            }
               $sql = "INSERT INTO {$DB_TABLE} (first_name, last_name, password, age, date) 
                 VALUES ('$record->first_name', '$record->last_name', '$record->password', $record->age, '$record->date')";

            if ($db->query($sql) === TRUE) {
                return true;
            } else {
                die("create: Error: " . $sql . "<br>" . $db->error);
            }
        }
         public static function has(string $row, string $value, string $DB_TABLE)
        {
		    global $db; 
            $condition = "$row = '$value'"; // Replace with your condition
            $sql = "SELECT * FROM $DB_TABLE WHERE $condition";

            // Execute the query
            $result = $db->query($sql);
                    // Check if the query was successful
            if ($result) {
                // Check if any rows were returned
                if ($result->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }

                // Free the result set
                $result->free();
            } else {
                die("has: Error: " . $db->error);
            }
        }
        public static function get(string $row, string $value, string $DB_TABLE)
        {
		    global $db; 
            $condition = "$row = '$value'"; // Replace with your condition
            $sql = "SELECT * FROM $DB_TABLE WHERE $condition";

            // Execute the query
            $result = $db->query($sql);
                    // Check if the query was successful
            if ($result) {
                // Check if any rows were returned
                $row = $result->fetch_assoc();
                if ($result->num_rows > 0) {
                    return $row;
                } else {
                    return null;
                }

                // Free the result set
                $result->free();
            } else {
                die("get: Error: " . $db->error);
            }
        }
    }
    ?>