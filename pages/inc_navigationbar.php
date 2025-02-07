<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The Ultimate Destination</title>
        <!-- Created by Ganamukkula -->
        <link type="text/css" rel="stylesheet" href="../css/style.css">
        <script src="../js/navBar.js"></script>
    </head>
    <body>
        <div class="nav">
            <div class="topnav">
                <div class="left-section">
                    <div><button class="openbtn" id="open-button">☰</button></div>
                    <div class="logo">
                        <img src="../images/logo.png" alt="Logo">
                    </div>
                    <div class="brand-name">TUD</div>
                </div>
                <div class="right-section">
                <a class="navLinks" href="favoritePage.php">
                    <div class="favoriteContainer">
                        <?php if(isset($_SESSION['favorite_house_ids']) && !empty($_SESSION['favorite_house_ids'])) echo count($_SESSION['favorite_house_ids']) ?><img class="favoriteIcon" src="../images/favoriteIcon.png" alt="Heart Icon">
                    </div>
                </a>
                    <a class="nav-items active" href="homePage.php">Home</a>
                    <a class="nav-items" href="agents.php">Agents&Owners</a>
                    <a class="nav-items" href="advertise.php">Advertisment</a>
                    <a class="nav-items" href="leasing_info.php">Leasing Details</a>
                    <a class="nav-items" href="budgetPlanner.php">Budget Planner</a>
                    <a class="nav-items" href="aboutUs.php">About US</a>
                </div>
                <div id="mySidebar" class="sidebar">
                    <a href="javascript:void(0)" class="closebtn" id="close-button">x</a>
                    <a class="nav-items" href="homePage.php">Home</a>
                    <a class="nav-items" href="agents.php">Agents&Owners</a>
                    <a class="nav-items" href="advertise.php">Advertisment</a>
                    <a class="nav-items" href="leasing_info.php">Leasing Details</a>
                    <a class="nav-items" href="budgetPlanner.php">Budget Planner</a>
                    <a class="nav-items" href="aboutUs.php">About US</a>
                </div>
            </div>
        </div>
    </body>
</html>