<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The Ultimate Destination</title>
        <!-- Created by Ganamukkula -->
        <!-- This page is to search for the houses by filtering the data  -->
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/carouselSlide.js"></script>
        <script src="../js/favorite.js"></script>
    </head>
    <body>
        <!-- begin:: navigation bar -->
         <?php include("inc_navigationbar.php");?>
        <!-- end:: navigation bar -->
        <?php  
            //including the query result page and calling the function to get the list of houses based on the input.
            include '../QueryResult/inc_houseSearchQueryResult.php';
            filterHouseList(); 
        ?>
        <div class="houseSearch">
            <main>
                <div id="section1" class="filter-section">
                    <!-- form for filtering the houses. The user enters the input based on the requirements. -->
                    <form action="houseSearch.php" method="POST">
                        <div class="search-container">
                            <table class="filter-controls-table"><tr>
                                <td>
                                    <input type="text" class="search-text-box" name="search-content" placeholder="City, State, ZIP" value="<?php if(isset($_POST['showResult']) && isset($_POST['search-content'])) echo $_POST['search-content']?>">
                                </td>
                                <td><Select name="price" class="priceDropdown">
                                    <option value="" disabled selected hidden>Max Price</option>
                                    <option value="500" <?php if((isset($_POST['showResult']) && (isset($_POST['price'])) && ($_POST['price'] == "500"))) echo "selected" ?>>500</option>
                                    <option value="1000" <?php if((isset($_POST['showResult']) && (isset($_POST['price'])) && ($_POST['price'] == "1000"))) echo "selected"?> >1000</option>
                                    <option value="1500" <?php if((isset($_POST['showResult']) && (isset($_POST['price'])) && ($_POST['price'] == "1500"))) echo "selected"?>>1500</option>
                                    <option value="2000" <?php if((isset($_POST['showResult']) && (isset($_POST['price'])) && ($_POST['price'] == "2000"))) echo "selected"?>>2000</option>
                                </Select></td>
                                <td><Select name="beds" class="bedDropdown">
                                    <option value="" disabled selected hidden>Bedrooms</option>
                                    <option value="1" <?php if((isset($_POST['showResult']) && (isset($_POST['beds'])) && ($_POST['beds'] == "1"))) echo "selected"?> >1 Bedroom</option>
                                    <option value="2" <?php if((isset($_POST['showResult']) && (isset($_POST['beds'])) && ($_POST['beds'] == "2"))) echo "selected"?> >2 Bedroom</option>
                                    <option value="3" <?php if((isset($_POST['showResult']) && (isset($_POST['beds'])) && ($_POST['beds'] == "3"))) echo "selected"?> >3 Bedroom</option>
                                    <option value="4" <?php if((isset($_POST['showResult']) && (isset($_POST['beds'])) && ($_POST['beds'] == "4"))) echo "selected"?> >4 Bedroom</option>
                                </Select></td>
                                <td><Select name="bath" class="bathDropdown">
                                    <option value="" disabled selected hidden>Bathrooms</option>
                                    <option value="1" <?php if((isset($_POST['showResult']) && (isset($_POST['bath'])) && ($_POST['bath'] == "1"))) echo "selected"?>>1 Bathroom</option>
                                    <option value="2" <?php if((isset($_POST['showResult']) && (isset($_POST['bath'])) && ($_POST['bath'] == "2"))) echo "selected"?>>2 Bathroom</option>
                                    <option value="3" <?php if((isset($_POST['showResult']) && (isset($_POST['bath'])) && ($_POST['bath'] == "3"))) echo "selected"?>>3 Bathroom</option>
                                </Select></td>
                                <td><Select name="property_type" class="propertyTypeDropdown">
                                    <option value="" disabled selected hidden>House Type</option>
                                    <option value="Apartments" <?php if((isset($_POST['showResult']) && (isset($_POST['property_type'])) && ($_POST['property_type'] == "Apartments"))) echo "selected"?> >Apartments</option>
                                    <option value="TownHouses" <?php if((isset($_POST['showResult']) && (isset($_POST['property_type'])) && ($_POST['property_type'] == "TownHouses"))) echo "selected"?> >TownHouses</option>
                                    <option value="Houses" <?php if((isset($_POST['showResult']) && (isset($_POST['property_type'])) && ($_POST['property_type'] == "Houses"))) echo "selected"?>>Houses</option>
                                </Select></td>
                                <td><select name="sortBy" class="sortDropdown">
                                    <option value="" disabled selected hidden>Sort By</option>
                                    <option value="low-high" <?php if((isset($_POST['showResult']) && (isset($_POST['sortBy'])) && ($_POST['sortBy'] == "low-high"))) echo "selected"?> >Price (Low to High)</option>
                                    <option value="high-low" <?php if((isset($_POST['showResult']) && (isset($_POST['sortBy'])) && ($_POST['sortBy'] == "high-low"))) echo "selected"?> >Price (High to Low)</option>
                                    <option value="ratings" <?php if((isset($_POST['showResult']) && (isset($_POST['sortBy'])) && ($_POST['sortBy'] == "ratings"))) echo "selected"?> >Ratings (High to Low)</option>
                                </select></td>
                                <td><input type="submit" name="showResult" value="Show Results" class="filter-button"></td>
                                <td><button class="clear-all-button" id="clear-all-controls">Clear All</button></td>
                            </tr></table>
                        </div>
                        <!-- showing the number of houses found based on the inputs-->
                        <div class="count-result">
                            <input type="text" value=<?php housesCount(); ?> name="countResult" disabled style="border: none; outline: none; background-color: #edeaea;"> 
                        </div>
                    </form>
                </div>
                <div id="section2" class="cards-section"  style="padding-top: 300px;">
                    <!-- making a php function call to print the filtered houses list in the cards. -->
                    <?php getCardsData(); ?>
                </div>
            </main>
        </div>
    </body>
</html>