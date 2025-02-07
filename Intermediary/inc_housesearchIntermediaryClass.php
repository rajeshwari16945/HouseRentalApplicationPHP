<?php
    /*
    *created by Ganamukkula
    *PHP Intermediary Class for House search
    */
    include '../Database/inc_databaseClass.php';

    class HouseSearchIntermediaryClass
    {
        private $houseListQuery = 'SELECT `hd`.`id`, `hd`.`name`, `pt`.`name` `property_type`, `hd`.`address`, `ai`.`agent_name` `agent`, `ai`.`agent_number` `number`, `l`.`zip_code`, `a`.`name` `neighbourhood`, `c`.`name` `city`, `s`.`name` `state`, `hd`.`rent_amount`, `hd`.`bedrooms`, `hd`.`bathrooms`, `hd`.`description`   
                                        FROM `house_details` `hd`
                                        JOIN `location` `l` ON `hd`.`location_id` = `l`.`id` 
                                        JOIN `area` `a` ON `l`.`area_id` = `a`.id 
                                        JOIN `city` `c` ON `a`.`city_id` = `c`.`id` 
                                        JOIN `state` `s` ON `c`.`state_id` = `s`.`id` 
                                        JOIN `agent_info` `ai` ON `hd`.`agent_id` = `ai`.`agent_id` 
                                        JOIN `property_type` `pt` ON `hd`.`property_type_id` = `pt`.`id` 
                                        WHERE 1 ';

        private $houseImagesListQuery = 'SELECT `hd`.`id` `house_id`, `i`.`path` FROM `house_details` `hd` 
                                        JOIN `house_images` `hi` ON `hd`.`id` = `hi`.`house_id` 
                                        JOIN `images` `i` ON `hi`.`image_id` = `i`.`id`';

        //Method for connecting to the database and run the query.
        function getHouseList($searchText, $price, $beds, $bathrooms, $property_type, $sortBy) {
            $dbClass = new DatabaseClass();
            //build query
            $selectSql = $this->houseListQuery;
            //doing validation for the input variables and building the where conditions if the value is given. 
            $whereCondition = "";
            $datatypes = "";
            if(!empty($price)) {
                $whereCondition .= " AND `hd`.`rent_amount` <= ? ";
                $datatypes .= "i";
            } 
            if(!empty($beds)) {
                $whereCondition .= " AND `hd`.`bedrooms` = ? ";
                $datatypes .= "i";
            } 
            if(!empty($bathrooms)) {
                $whereCondition .= " AND `hd`.`bathrooms` = ? ";
                $datatypes .= "i";
            } 
            if(!empty($property_type)) {
                $whereCondition .= " AND `pt`.`name` = ? ";
                $datatypes .= "s";
            } 
            if(!empty($searchText)) {
                $searchTextArray = explode(" ", $searchText);
                for($i=0; $i<count($searchTextArray); $i++) {
                    if($i==0) { 
                        $whereCondition.= " AND (";
                    }
                    else { 
                        $whereCondition.= " OR "; 
                    }
                    $whereCondition .=  " `l`.`zip_code` LIKE '%".$searchTextArray[$i]."%' OR `a`.`name` LIKE '%".$searchTextArray[$i]."%' OR `c`.`name` LIKE '%".$searchTextArray[$i]."%' OR `s`.`name` LIKE '%".$searchTextArray[$i]."%' ";
                }
                $whereCondition .= ")";
            }
            //concatenating the where condition build to the select query.
            $selectSql .= $whereCondition;
            //validating the variable and building the sort statement.
            $orderBy = "";
            if(!empty($sortBy)) {
                switch($sortBy) {
                    case "low-high" : $orderBy .= " ORDER BY `hd`.`rent_amount` ASC ";
                                      break;

                    case "high-low" : $orderBy .= " ORDER BY `hd`.`rent_amount` DESC ";
                                      break;
                }
                //concatenating the sort by to the select query
                if(!empty($orderBy)) $selectSql .= $orderBy;
            }
            //call the select query method of the dbclass:
            //Check for query arguments. If present, use the param query method; otherwise, use the simple query method.
            try {
                if(!empty($datatypes)) $result = $dbClass->paramSelectQuery($selectSql, $datatypes, $price, $beds, $bathrooms, $property_type);
                else $result = $dbClass->simpleSelectQuery($selectSql);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Retrieve the list of images for houses. */
        function getHouseImageList() {
            $dbClass = new DatabaseClass();

            //build query
            $sqlQuery = $this->houseImagesListQuery;
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->simpleSelectQuery($sqlQuery);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Retrieve the data for each house using the house ID. */
        function getEachHouse($houseId) {
            $dbClass = new DatabaseClass();
            //build query
            $selectSql = $this->houseListQuery;
            $whereCondition = " AND `hd`.`id` = ?";
            $selectSql .= $whereCondition;
            $datatypes = "i";
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->paramSelectQuery($selectSql, $datatypes, $houseId);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Retrieve the list of images for each house using the provided house ID. */        
        function getEachHouseImageList($houseId) {
            $dbClass = new DatabaseClass();
            //build query
            $sqlQuery = $this->houseImagesListQuery;
            $whereCondition = " WHERE  `hd`.`id` = ? ";
            $sqlQuery .= $whereCondition;
            $datatypes = "i";
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->paramSelectQuery($sqlQuery, $datatypes, $houseId);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Retrieve the list of trending houses. */
        function getTrendingHouseList() {
            $dbClass = new DatabaseClass();
            //build query
            $selectSql = $this->houseListQuery .= " AND `hd`.`is_trending` = 1";
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->simpleSelectQuery($selectSql);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Get the list of houses saved in the session variable. */
        function getFavoriteHousesList() {
            $dbClass = new DatabaseClass();
            if(isset($_SESSION['favorite_house_ids'])) $favoriteHouseIds = $_SESSION['favorite_house_ids'];
            $selectSql = $this->houseListQuery;
            //build query
            $valueString = " AND `hd`.`id` IN (";
            if(isset($favoriteHouseIds) && !empty($favoriteHouseIds)) {
                $valueString .= implode(", ", $favoriteHouseIds);  
            } else {
                $valueString .= 0;
            }
            $valueString .= ")";
            $selectSql .= $valueString;  
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->simpleSelectQuery($selectSql);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }

        /* Retrieve the list of images for the houses stored in the session variable. */
        function getFavoriteHouseImageList() {
            $dbClass = new DatabaseClass();
            if(isset($_SESSION['favorite_house_ids'])) $favoriteHouseIds = $_SESSION['favorite_house_ids'];
            $selectSql = $this->houseImagesListQuery;
            //build query
            $valueString = " AND `hd`.`id` IN (";
            if(isset($favoriteHouseIds) && !empty($favoriteHouseIds)) {
                $valueString .= implode(", ", $favoriteHouseIds);  
            } else {
                $valueString .= 0;
            }
            $valueString .= ")";
            $selectSql .= $valueString;  
            //call the select query method of the dbclass:
            try {
                $result = $dbClass->simpleSelectQuery($selectSql);
                if($result) {
                    return $result;
                }
            } catch (Exception $e) {
                echo "<script>window.alert(".$e->getMessage().")</script>";
            }
        }
    }   
?>