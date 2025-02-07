<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The Ultimate Destination</title>
        <!-- Created by Ganamukkula -->
        <link type="text/css" rel="stylesheet" href="../css/style.css">
        <script src="../js/carouselSlide.js"></script>
        <script src="../js/favorite.js"></script>
    </head>
    <body style="height: 100%; margin: 0; padding: 0;">
        <!-- begin:: navigation bar -->
        <?php include("inc_navigationbar.php");?>
        <!-- end:: navigation bar -->
        <?php  
            //including the query result page and calling the function to get the list of trending houses
            include '../QueryResult/inc_houseSearchQueryResult.php';
            getTrendingHouses(); 
        ?>
        <div class="homePage">
            <main>
                <div id="section1" class="search-section" style="background-image: url('../images/homeSearchBackground.jpg'); background-size: cover; background-position: center;">
                    <h1 style="font-weight: 700; font-size: 45px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 1.0);">Find your dream home.</h1>
                    <!-- form for searching the house. The user enters the input in the text box (such as city, state, or ZIP code) -->
                    <form action="houseSearch.php" method="POST">
                        <div class="search-container">
                            <input type="text" class="search-box" name="search-content" placeholder="City, State, ZIP">
                            <input type="submit" name = "showResult" value= "Search" class="search-button">
                        </div>
                    </form>
                </div>
                <div class='trending-houses-heading'>
                    <h2>Trending houses for you.</h2>
                    <p>These properties are trending. Find the perfect place, or contact to learn more.</p>
                </div>
                <div id="section2" class="cards-section">
                    <!-- making a php function call to print the trending list in the cards. -->
                    <?php getCardsData(); ?>
                </div>
            </main>
            <footer>
                <p style="font-weight: 700; font-size: 25px;">The Ultimate Destination.</p>
                <p>© 2024. All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>