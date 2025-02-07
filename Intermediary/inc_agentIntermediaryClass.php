<?php
/*************
 * created by Ganamukkula
 * PHP Intermediary Class File 
*/

include"../Database/inc_databaseClass.php";

//intermediary class
class AgentSearchIntermediaryclass{
    public $error;

    //method for connecting to the database
    function getAgentData($location, $agentName){
        $dbClass = new DatabaseClass();
        $result = NULL; // to store data
        $selectQuery = 'SELECT `ar`.`agent_id`, `ar`.`agent_name`, `ar`.`agent_number`,`ar`.`agent_company`,`ar`.`agent_photo`,`ar`.`agent_rating`, `l`.`zip_code`, `a`.`name` `neighbourhood`, `c`.`name` `city`, `s`.`name` `state`, `hd`.`id` `house_id`, `hd`.`name` `house_name`  
        FROM `agent_info` `ar` 
        LEFT JOIN `house_details` `hd` ON `hd`.`agent_id` = `ar`.`agent_id`
        JOIN `location` `l` ON `ar`.`location_id` = `l`.`id` 
        JOIN `area` `a` ON `l`.`area_id` = `a`.id 
        JOIN `city` `c` ON `a`.`city_id` = `c`.`id` 
        JOIN `state` `s` ON `c`.`state_id` = `s`.`id`   
        WHERE 1 ';

        //doing validation for the input variables and building the where conditions if the value is given. 
        $whereCondition = "";
        $datatypes = "";
        if(!empty($agentName)) {
            $whereCondition .= " AND `ar`.`agent_name` = ? ";
            $datatypes .= "s";
        } 
        if(!empty($location)) {
            $searchTextArray = explode(" ", $location);
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
        $selectQuery .= $whereCondition;
        //call the select query method of the dbclass:
        //Check for query arguments. If present, use the param query method; otherwise, use the simple query method.
        try {
            if(!empty($datatypes)) $result = $dbClass->paramSelectQuery($selectQuery, $datatypes, $agentName);
            else $result = $dbClass->simpleSelectQuery($selectQuery);
            if($result) {
                return $result;
            }
        } catch (Exception $e) {
            echo "<script>window.alert(".$e->getMessage().")</script>";
        }
    }
}
?>