<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The Ultimate Destination</title>
        <!-- Created by Ganamukkula -->
        <!-- This page is to display the saved houses list -->
        <link type="text/css" rel="stylesheet" href="../css/style.css">
        <script src="../js/carouselSlide.js"></script>
        <script src="../js/favorite.js"></script>
    </head>
    <body style="background-color: white; color: black; height: 100%; margin: 0; padding: 0;">
        <!-- begin:: navigation bar -->
        <?php include("inc_navigationbar.php");?>
        <!-- end:: navigation bar -->
        <?php  
            //including the query result page and calling the function to get the list of houses saved.
            include '../QueryResult/inc_houseSearchQueryResult.php';
            getFavoriteHouses(); 
        ?>
        <div class="favoriteClass">
            <main>
                <h1 class="favorite-heading">Saved Houses</h1>
                <div id="section1" class="cards-section">
                    <!-- Printing the saved houses list in cards -->
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