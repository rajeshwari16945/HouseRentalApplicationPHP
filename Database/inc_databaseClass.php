<?php
    //include credentials file
    class DatabaseClass {
        //declaring connection as a property.
        /*access modifier is static  because the value needs to be available even after the connect() function execution is done: 
        The connection needs to be alive for the query functions.*/
        
        static $connection;
        private $error;

        private function connect() {
            /*This method is accessible only within the class hence private.
            * it instantiates mysqli() connection and returns it.
            */
            //you use self for static members.

            //include the config file:
            include ("inc_dbConfig.php");

            //instantiate mysqli object and supply config arguments.
            //instantiate the connection and return the connection
            //connection is open when mysqli() is successfully instantiated.
            self::$connection = new mysqli($servername, $username, $password, $dbname);

            //connection not open yet.
            if(self::$connection == FALSE) {
                //return false to the calling function signifying that the connection failed.
                return FALSE;
            }//end if.

            //if connection succeeds, return the connection object.
            return self::$connection;
        }//connect() method.

        public function paramSelectQuery($sqlQuery, $datatypes = NULL, $param1 = NULL, $param2 = NULL, $param3 = NULL, $param4 = NULL, $param5 = NULL, $param6 = NULL) {
            /* This method received a sql query in a format ready to be prepared: i.e., with '?' and supply the parameters
            * for '?' exactly in the right order. The $datatypeparam contains the datatypes supplied for each parameter,
            * in the correct order.
            */

            //1.get the connection by calling connect() method
            $connection = $this->connect();

            //2. parameterize the query. prepare sqlStatement using the $connection object.
            $sqlStatement = $connection->stmt_init();
            $sqlStatement = $connection->prepare($sqlQuery);

            //3. Create an array of parameters which are not null.
            $paramArray = array();
            if (!is_null($param1)) { array_push($paramArray, $param1); }
            if (!is_null($param2)) { array_push($paramArray, $param2); }
            if (!is_null($param3)) { array_push($paramArray, $param3); }
            if (!is_null($param4)) { array_push($paramArray, $param4); }
            if (!is_null($param5)) { array_push($paramArray, $param5); }
            if (!is_null($param6)) { array_push($paramArray, $param6); }

            //bind the statement with parameters.
            $bindresult = $sqlStatement->bind_param($datatypes, ...$paramArray);
            //the three dots ... is known as a splat operator

            //variable to hold data
            $result = NULL;

            if($bindresult) {
                $sqlStatement->free_result();
                $sqlStatement->execute();
                $result = $sqlStatement->get_result();
            } else {
                $this->error = "Statement Binding Failed " . $sqlStatement->error;
            }

            if($result == NULL) {
                $this->error = "SQL Query failed: ".$sqlStatement->error;
            }

            //close the statement
            $sqlStatement->close();

            //close the connection
            $connection->close();

            return $result;
        }//method ParamSelectQuery()

        public function simpleSelectQuery($sqlQuery) {
            //connect to the database
            $connection = $this->connect();

            //Query the database
            $result = $connection->query($sqlQuery);

            //close the connection
            $this->closeConnection();

            if(!$result) {
                $this->error = $connection->error;
                return FALSE;
            } else {
                return $result;
            }
        }//end simpleSelectQuery()

        public function error() {
            //return the db error stored as property
            return $this->error;
        }//end error()

        public function closeConnection() {
            self::$connection->close();
        }//end close()

    }//end class
?>