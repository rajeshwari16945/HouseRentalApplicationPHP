<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Ultimate Destination</title>
    <!-- Created by Ganamukkula -->
    <!-- style sheet linking -->
    <link type="text/css" rel="stylesheet" href="../css/style.css">
</head>
<body class="agentBody">
     <!-- begin:: navigation bar -->
     <?php include("inc_navigationbar.php");?>
    <!-- end:: navigation bar -->
    
    <!-- begin:: Agents & owner -->
    <div class="agentIntro">
        <div class="agentLocal">
            <h1 class="localh1">
                A great agent makes all the difference
            </h1>
            <p class="localp">There's a reason 89% of buyers used an agent last year — a local agent has the inside scoop on your market and can guide you through the buying process from start to finish.</p>
        </div>
    </div>

    <div class="findAgent">
        <div class="findAgentInner">
            <h1 class="findAgenth1">
                Find An Agent
            </h1>
           <div class="agentsearchdiv">
            <form action="agents.php" method="post" id="agentsearchForm">
                <div class="locationdiv">
                    <label class="locationLabel" for="location">Location</label>
                <input class="searchInput" type="search" name="location" id="" value="" placeholder ="Neighborhood/city/zipcode">
                </div>
                <div class="namediv">
                    <label class="nameLabel" for="agentName">Name</label>
                <input class="nameInput" type="text" name="agentName" id="" value="" placeholder="Agent Name">
                </div>
                <div class="searchButtondiv">
                    <input class="searchButton" name="searchButton" type="submit" value="Search">
                </div>
            </form>
            <div class="agentsList">
                <div class="agentDetailsCard" id="agentsListTable">
                <table class="agentTable">
                    <tr class = "agentTableHead">
                        <td>
                            <p>Agent</p>
                        </td>
                        <td>
                            <p>Agent Rating</p>
                        </td>
                        <td>
                            <p>Agent Postings</p>
                        </td>
                    </tr>
            <?php
            // Created by Liesetty
            // include intermediary database class
            include "../Intermediary/inc_agentIntermediaryClass.php";
            // validating agent search
            if (isset($_POST["searchButton"])) {
                # if user clicked button. validate user inputs
                $location = (isset($_POST["location"])) ? $_POST["location"] : NULL;
                $agentName = (isset($_POST["agentName"])) ? $_POST["agentName"] : NULL;
                
                //create an instance of the class HouseSearchIntermediaryClass
                $intermediaryClass =  new AgentSearchIntermediaryclass();
                
                //call the method by passing the arguments to execute the query and store the result.
                $agentListResult = $intermediaryClass->getAgentData($location, $agentName);
                
                if($agentListResult->num_rows <= 0) {
                    echo "<p>0 Agents Found.";
                    echo "Based on these filters, we couldn't find any Agents for guide you in this area.
                    Try different names or a different city or a different neighborhood.";
                } else {
                    /*Fetch a result row as an associate array fetch_assoc returns an associate array that corresponds to the fetched row or NULL if there are no more rows.*/
                    while($agentRows = $agentListResult->fetch_assoc()) {
                    echo '<tr class ="agentTableRow">';
                        echo '<td class="agentDetailsCell">';
                        echo '<img class="agentTableImage" src="'.$agentRows["agent_photo"].'" alt="agentImage">';
                        echo '<div class="agentDetailstd">';
                            echo '<p class="agentName">'. 
                            $agentRows["agent_name"].'</p>';
                        echo '<p class="agentPNumber">'.$agentRows["agent_number"].'</p>';
                        echo '<p class="agentCompany">'.$agentRows["agent_company"].'</p>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td class="agentRatingsCell">';
                            echo '<p class="agentRating">';
                                for ($i=1; $i <=$agentRows['agent_rating'] ; $i++) { 
                                    # code...
                                    echo '<svg viewBox="0 0 32 32" aria-hidden="true" focusable="false" role="img" class="Icon-c11n-8-99-1__sc-13llmml-0 dCHekw"><path stroke="none" d="M28.28 11.46L21 10.12l-3.52-6.9c-.83-1.63-2.19-1.63-3 0L11 10.12l-7.28 1.34c-1.8.34-2.26 1.71-1 3.06l5.16 5.6-1 7.78c-.24 1.8.9 2.6 2.53 1.77L16 26.3l6.65 3.37c1.63.83 2.77 0 2.53-1.77l-1-7.78 5.16-5.6c1.2-1.35.74-2.72-1.06-3.06z"></path></svg>';
                                }
                                // <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false" role="img" class="Icon-c11n-8-99-1__sc-13llmml-0 dCHekw"><path stroke="none" d="M28.28 11.46L21 10.12l-3.52-6.9C17.09 2.41 16.55 2 16 2s-1.09.41-1.51 1.22L11 10.12l-7.28 1.34c-1.8.34-2.26 1.71-1 3.06l5.16 5.6-1 7.78c-.17 1.32.39 2.1 1.34 2.1a2.68 2.68 0 001.19-.33L16 26.3l6.65 3.37a2.68 2.68 0 001.19.33c.95 0 1.51-.78 1.34-2.1l-1-7.78 5.16-5.6c1.2-1.35.74-2.72-1.06-3.06zm-6.26 8l1.1 8.21L16 24.05V4.69l3.68 7.21 7.94 1.48z"></path></svg>
                            echo '</p>';
                        echo '</td>';
                        echo '<td class="agentPostingsCell">';
                            if(isset($agentRows["house_id"])) $path = "houseInfo.php?id=". $agentRows["house_id"];
                            echo '<a href= '. $path .' class="agentPosting">House Details - ' .  $agentRows["house_name"] . '</a>';
                        echo '</td>';
                    echo '</tr>';
                    }
                }
            }
            ?>
            </table>
            </div>
            </div>
           </div>
           <div class="agentsearchDis" id="agentSearchImage">
            <img class="searchAgentImg" id="searchAgentImg" src="../images/searchAgentImg.png" alt="search Icon">
            <div class="searchAgentMsg" id = "findAgentMsg">
                <h3 class="">Find Your Agent </h3>
                <p>To get started, enter your location or search for a specific agent by name.</p>
            </div>
           </div>
            <div class="agentUserguide">
                <p>If you are looking to rent home, The Ultimate destination's directory of local real estate agents and brokers connects you with professionals who can help meet your needs. Because the real estate market is unique, it's important to choose a real estate agent or broker with local expertise to guide you through the process of renting home. Our directory helps you find real estate professionals who specialize in relocation - among many other options. Alternatively, you could work with a local agent or real estate broker who provides an entire suite of buying and selling services.
                </p>
                <p>      
                    The Ultimate Destination is the  rental marketplace dedicated to empowering consumers with data, inspiration and knowledge around the place they call home, and connecting them with the best local professionals who can help
                </p>
                <p>
                    No matter what type of real estate needs you have, finding the local real estate professional you want to work with is the first step. The real estate directory lets you view and compare real estate agents, read reviews, see an agent's current listings, and contact agents directly from their profile pages on The Ultimate Destination.
                </p>
            </div>
    </div>
    <!-- end:: Agents & owner -->
</body>
</html>