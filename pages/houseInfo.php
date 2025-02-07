<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>The Ultimate Destination</title>
        <!-- Created by Ganamukkula -->
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/multipleCarouselSlide.js"></script>
    </head>
    <body>
        <?php  
            //including the query result page and calling the function to get the deailed house data
            include '../QueryResult/inc_houseSearchQueryResult.php';
            if(isset($_GET['id'])) {
                eachHouseDetails($_GET['id']); 
            }
        ?>
        <div class="house-details">
            <main>
                <!-- back button to go to the previous page -->
                <div id="back-section" >
                    <button class="go-back-button" id="back-button">Back</button>
                </div>
                <!-- making a php function call to print the house deatils. -->
                <?php getHouseDetails(); ?>
            </main>
        </div>
    </body>
</html>