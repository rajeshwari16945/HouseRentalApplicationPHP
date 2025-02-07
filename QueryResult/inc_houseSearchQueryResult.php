<?php
    /*
    *created by Ganamukkula
    *PHP result logic file
    */
    //include the php function file here to access the database:
    include '../Intermediary/inc_housesearchIntermediaryClass.php';

    $houseListResult;
    $houseImagesList;
    $isFavorite = FALSE;

    function filterHouseList() {
        global $houseListResult;
        global $houseImagesList;

        //validate and assign the values to the variables
        $searchText = (isset($_POST['showResult']) && isset($_POST['search-content']) && !empty($_POST['search-content'])) ? $_POST['search-content'] : NULL;
        $price = (isset($_POST['showResult']) && isset($_POST['price']) && !empty($_POST['price'])) ? $_POST['price'] : NULL;
        $beds = (isset($_POST['showResult']) && isset($_POST['beds']) && !empty($_POST['beds'])) ? $_POST['beds'] : NULL;
        $bathrooms = (isset($_POST['showResult']) && isset($_POST['bath']) && !empty($_POST['bath'])) ? $_POST['bath'] : NULL;
        $sortBy = (isset($_POST['showResult']) && isset($_POST['sortBy']) && !empty($_POST['sortBy'])) ? $_POST['sortBy'] : NULL;
        $property_type = (isset($_POST['showResult']) && isset($_POST['property_type']) && !empty($_POST['property_type'])) ? $_POST['property_type'] : NULL;

        //create an instance of the class HouseSearchIntermediaryClass
        $intermediaryClass =  new HouseSearchIntermediaryClass();

        //call the method by passing the arguments to execute the query and store the result.
        $houseListResult = $intermediaryClass->getHouseList($searchText, $price, $beds, $bathrooms, $property_type, $sortBy);
        $houseImagesList = $intermediaryClass->getHouseImageList();
    }

    function eachHouseDetails($houseId) {
        global $houseListResult;
        global $houseImagesList;

        //create an instance of the class HouseSearchIntermediaryClass
        $intermediaryClass =  new HouseSearchIntermediaryClass();

        //call the method by passing the arguments to execute the query and store the result.
        $houseListResult = $intermediaryClass->getEachHouse($houseId);
        $houseImagesList = $intermediaryClass->getEachHouseImageList($houseId);        
    }

    function getTrendingHouses() {
        global $houseListResult;
        global $houseImagesList;

        //create an instance of the class HouseSearchIntermediaryClass
        $intermediaryClass =  new HouseSearchIntermediaryClass();

        //call the method by passing the arguments to execute the query and store the result.
        $houseListResult = $intermediaryClass->getTrendingHouseList();
        $houseImagesList = $intermediaryClass->getHouseImageList();        
    }

    function getFavoriteHouses() {
        global $houseListResult;
        global $houseImagesList;
        global $isFavorite;

        //create an instance of the class HouseSearchIntermediaryClass
        $intermediaryClass =  new HouseSearchIntermediaryClass();

        //call the method by passing the arguments to execute the query and store the result.
        $houseListResult = $intermediaryClass->getFavoriteHousesList();
        $houseImagesList = $intermediaryClass->getFavoriteHouseImageList();   
        $isFavorite = TRUE;
    }

    function getCardsData() {
        global $houseListResult;
        global $houseImagesList;
        global $isFavorite;
        if(isset($_SESSION['favorite_house_ids'])) $favoriteHouseIds = $_SESSION['favorite_house_ids'];
        if($isFavorite && $houseListResult->num_rows <= 0) {
            echo "<div class='no-favorites'>";
            echo "<h1>You haven't saved any houses yet.</h1>";
            echo "<a class='home-button-in-favorite' href='homePage.php'>Start Searching</a>";
            echo "</div>";
        } else if($houseListResult->num_rows <= 0) {
            echo "<div class='no-house-found'>";
            echo "<h1>0 Houses Found.</h1>";
            echo "<p>Based on these filters, we couldn't find any houses for rent in this area.</p>";
            echo "<p>Try removing some filters or search in a different city or neighborhood.</p>";
            echo "</div>";
        } else {
            /*Fetch a result row as an associate array fetch_assoc returns an associate array that corresponds to the fetched row or NULL if there are no more rows.*/
            while($houseRows = $houseListResult->fetch_assoc()) {  
                if($isFavorite) { if(!in_array($houseRows['id'], $favoriteHouseIds)) { continue; } }           
                $isActive = (isset($favoriteHouseIds) && in_array($houseRows['id'], $favoriteHouseIds)) ? " active" : "";
                //display the data in cards
                echo '<div class="card">';
                echo '<div class="carousel-container">';
                echo '<div class="carousel">';
                $i = 0;
                // Reset the result set pointer to the beginning
                mysqli_data_seek($houseImagesList, 0);
                // Loop through the result set
                while($imageRows = mysqli_fetch_assoc($houseImagesList)) {
                    if($houseRows['id'] == $imageRows['house_id']) {
                        $i++;
                        echo '<img class="card-carousel-image" src="../images/' . $imageRows["path"] . '" alt="Image ' . $i .'">';
                    }
                }
                echo '</div>';
                echo '<button class="prev">&#10094;</button>';
                echo '<button class="next">&#10095;</button>';
                echo '</div>';
                echo '<div class="card-info">';
                //place the data in the card-info
                echo '<button data-id="'.$houseRows['id'].'" class="favorite-button'. $isActive .'" id="favoriteButton"  >&#x2764;</button>';
                echo '<h3> $'. $houseRows['rent_amount'] . '</h3>';
                echo '<p>'. $houseRows['name'] . '</p>';
                echo '<p>'. $houseRows['address'] . '</p>';
                echo '<p>'. $houseRows['bedrooms'] . ' - Beds, ' . $houseRows['bathrooms'] . ' - Baths</p>';
                $path = "../pages/houseInfo.php?id=" . $houseRows['id'];
                echo '<a href='. $path .' class="card-readmore-link" id = "readHouseInfo">Read More</a>';
                echo '</div>';
                echo '</div>';
            }
        } 
    }

    function housesCount() {
        global $houseListResult;
        //no of houses found count
        $countHouses = $houseListResult->num_rows;
        echo ("Count:" . $countHouses . "Houses found");
    }

    function getHouseDetails() {
        global $houseListResult;
        global $houseImagesList;

        if($houseListResult->num_rows > 0) {
            while($houseRows = $houseListResult->fetch_assoc()){
                echo '<div id="section1" class="images-section" style="background-color: black;">';
                echo '<div class="carousel">';
                echo '<div class="carousel-inner">';
                $i = 0;
                while($imageRows = mysqli_fetch_assoc($houseImagesList)) {
                    if($houseRows['id'] == $imageRows['house_id']) {
                        $i++;
                        echo '<img src="../images/' . $imageRows["path"] . '" alt="Image ' . $i .'">';
                    }
                }
                echo '</div>';
                echo '<button class="prev">&#10094;</button>';
                echo '<button class="next">&#10095;</button>';
                echo '</div></div>';
                echo '<div class="house-details">';
                echo '<h1>Charleston at Fannin Station</h1>';
                echo '<p class="location">Location: '. $houseRows["neighbourhood"].', '. $houseRows["city"].', '.$houseRows["state"].'</p>';
                echo '<div class="basic-details">';
                echo '<div class="detail">';
                echo '<span class="details-label">Bedrooms:</span>';
                echo '<span class="details-value">'. $houseRows["bedrooms"].'</span>';
                echo '</div>';
                echo '<div class="detail">';
                echo '<span class="details-label">Bathrooms:</span>';
                echo '<span class="details-value">'. $houseRows["bathrooms"].'</span>';
                echo '</div>';
                echo '<div class="detail">';
                echo '<span class="details-label">Type:</span>';
                echo '<span class="details-value">'. $houseRows["property_type"].'</span>';
                echo '</div>';
                echo '<div class="detail">';
                echo '<span class="details-label">Rent:</span>';
                echo '<span class="details-value">'. $houseRows["rent_amount"].'</span>';
                echo '</div></div></div>';
                echo '<div class="house-overview">';
                echo '<h1>Overview</h1>';
                echo '<p>'.$houseRows["description"].'</p>';
                echo '</div>';
                echo '<div class="house-agent">';
                echo '<h1>Agent Details</h1>';
                echo '<div class="detail">';
                echo '<span class="details-label">Name:</span>';
                echo '<span class="details-value">'. $houseRows["agent"].'</span>';
                echo '</div>';
                echo '<div class="detail">';
                echo '<span class="details-label">Mobile Number:</span>';
                echo '<span class="details-value">'. $houseRows["number"].'</span>';
                echo '</div></div>';
                echo '<div class="house-features">';
                echo '<h1>Features</h1>';
                echo '<p><input class="textbox" type="text" value="Washing Machine" disabled>';
                echo '<input class="textbox" type="text" value="Dryer" disabled>';
                echo '<input class="textbox" type="text" value="Dishwasher" disabled>';
                echo '<input class="textbox" type="text" value="Swimming Pool" disabled>';
                echo '<input class="textbox" type="text" value="Fitness Center" disabled>';
                echo '<input class="textbox" type="text" value="Extra Storage" disabled>';
                echo '</p></div>';
                echo '<div class="pet-policy">';
                echo '<h1>Pet Policy</h1>';
                echo '<p>The conditions of having pets.</p>';
                echo '<h4>Dogs and Cats</h4>';
                echo '<p class="pet-description">We are a pet-friendly community with no weight limits! Our policy allows 3 pets per apartment home.We would love for your dog or cat to live here with you & we are sure your pet will enjoy all of the wonderful pet amenities we have to offer!</p>';
                echo '<div class="detail">';
                echo '<span class="details-label">Fee:</span>';
                echo '<span class="details-value">$200</span>';
                echo '</div><div class="detail">';
                echo '<span class="details-label">Maximum Pets:</span>';
                echo '<span class="details-value">3</span>';
                echo '</div><div class="detail">';
                echo '<span class="details-label">Additional Rent:</span>';
                echo '<span class="details-value">$20</span>';
                echo '</div></div>';
            }
        } else {
            echo "No Records Found";
        }
    }
?>