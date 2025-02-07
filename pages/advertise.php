<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Ultimate Destination</title>
    <!-- style sheet linking -->
    <link type="text/css" rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- begin:: navigation bar -->
    <?php include("inc_navigationbar.php");?>
    <!-- end:: navigation bar -->
    
    <!-- begin:: advertise -->
    <div class="advertiseOpt ">
        <h1 class="advh1">Lets give a dream house to client</h1>
        <p>Reach millions of buyers, sellers and renters on the largest real estate network on the web.</p>
        <h4>Select your domain to get started</h4>
        <div class="domainCards">
            <div class="agentAdv">
                <img class="advAgentSelling" src="../images/agentSelling.png" alt="agents selling photo">
                <div class="agentAdvInfo">
                    <h3>I am a Agent</h3>
                        <input class="getButton" type="button" name="" id="getOwnerAgent" value="Get started">
                </div>
            </div>
            <div class="ownerAdv">
                <img class="advOwnerSelling" src="../images/ownerSelling.png" alt="agents selling photo">
                <div class="ownerAdvInfo">
                    <h3>I am a Owner</h3>
                        <input class="getButton" type="button" name="getOwner" id="getOwner" value="Get started">
                </div>
            </div>
        </div>    
    </div>
    <script>
        const getAgentStartedButton = document.getElementById("getOwnerAgent");
        const getOwnerStartedButton = document.getElementById("getOwner");
        function detailsPopup(){
            document.getElementById("agentDetailCard").style.display = "block";
        }
        window.addEventListener("load", function(e){
        e.preventDefault();
        getAgentStartedButton.addEventListener("click", detailsPopup, false);
        getOwnerStartedButton.addEventListener("click", detailsPopup, false);
        }, false);
    </script>
    <!-- end:: advertise -->
    
    <!-- begin:: agent input details form -->
    <div class="agentDetailCardOuter">
        <div class="agentDetailCard" id="agentDetailCard">
            <form class="advertiseForm" action="">
                <label class="advertiseNameLabel" for="">Name</label>
                <input class="advertiseNameInp" type="text" name="" id="">
                <label class="advertisePhone" for="">Phone Number</label>
                <input class="advertisePhoneInp" type="text" name="" id="">
                <label class="advertiseComapnyInfo" for="">Company Name</label>
                <input class="advertiseComapnyInfoInp" type="text" name="" id="">
                <label class="advertiseAdditionalinfo" for="">Additional Info</label>
                <textarea class="advertiseAdditionalinfoText" name="" id="" cols="30" rows="10"></textarea>
                <input class="advertiseSubmit" type="submit" name="" id="agentSubmit">
            </form>
        </div>
    </div>
    <footer class = "footer">
        <p style="font-weight: 700; font-size: 25px;">The Ultimate Destination.</p>
        <p>© 2024. All rights reserved.</p>
    </footer>
</body>
</html>