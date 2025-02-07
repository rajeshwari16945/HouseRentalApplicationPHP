<?php
//created by Ganamukkula
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the house ID is received via POST.
    if(isset($_POST['houseId'])) {
        $houseId = $_POST['houseId'];
        //if the action is add then insert the house Id into the session variable. else if the action is delete then remove the houseId from the session variable.
        if($_POST['action'] == "add") {
            //validate whether the variable exists in the session. If not, create an array variable within the session.
            if(!isset($_SESSION['favorite_house_ids'])) {
                $_SESSION['favorite_house_ids'] = array();
            }
            // Store the house ID in the session
            if(!in_array($houseId, $_SESSION['favorite_house_ids'])) array_push($_SESSION['favorite_house_ids'], $houseId); 
        }
        else if($_POST['action'] == "delete") {
            // Find the index of the value
            $indexToDelete = array_search($houseId, $_SESSION['favorite_house_ids']);
            echo $indexToDelete;
            // Check if the value exists in the array
            if ($indexToDelete !== false) {
                // Delete the value at the found index
                unset($_SESSION['favorite_house_ids'][$indexToDelete]);
            }
        }
        echo "<script>let previousPath = document.referrer; window.location.href = previousPath;</script>";
    }
}
?>
