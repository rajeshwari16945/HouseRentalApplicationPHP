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
    
    <!-- begin:: budget planner -->
    <div class="budgetCalculator">
        <h1>Plan your budget home either to go for rental house or buy a house by paying mortgage by the ultimate destination calcuator </h1>
        <div class="gridRental">
        <div class="rentalBudgetCalcualtor">
            <form class="rentBudgetPlanner" action="budgetPlanner.php" method="POST">
                <label for="rentPayment">Your monthly earnings</label>
                <input type="text" name="montlyEarnings" value="" >
                <p>Expenses</p>
                <label for="houseRent">Monthly Rent for House</label>
                <input type="text" name="houseRent" value="" placeholder="Example: 1000">
                <label for="waterBill">Water Bill(estimated)</label>
                <input type="text" name="waterBill" value="" placeholder="Example: 60">
                <label for="">Gas Bill(estimated)</label>
                <input type="text" name="gasBill" value="" placeholder="Example: 50">
                <label for="">Montly Renter's Insurance (estimated)</label>
                <input type="text" name="rentersInsurance" value="" placeholder="Example: 20" >
                <label for="">Maintanence(estiamated)</label>
                <input type="text" name="maintanence" value="" placeholder="Example: 80">
                <label for="">Other Expenses(estimated)</label>
                <input type="text" name="othExpenses" value="" placeholder="Example: 100">
                <input class="rentCalculateButtton" type="submit" name="rentCalculator" id="" value ="Calculate">
            </form>
        </div>
        <div class ="rentResultDisplay">
        <?php
        // created by Ganamukkula
        // validate user inputs
        if (isset($_POST["rentCalculator"])) {
            # code...
            $monthlyEarnings = (isset($_POST["montlyEarnings"])) ? intval($_POST["montlyEarnings"]) : "";
            $houseRent = (isset($_POST["houseRent"])) ? intval($_POST["houseRent"]) : "";
            $waterBill = (isset($_POST["waterBill"])) ? intval($_POST["waterBill"]) : "";
            $gasBill = (isset($_POST["gasBill"])) ? intval($_POST["gasBill"]) : "";
            $rentersInsurance = (isset($_POST["rentersInsurance"])) ? intval($_POST["rentersInsurance"]) : "";
            $maintanence = (isset($_POST["maintanence"])) ? intval($_POST["maintanence"]) : "";
            $othExpenses = (isset($_POST["othExpenses"])) ? intval($_POST["othExpenses"]) : "";

            $monthlyOtherExp = $waterBill + $gasBill + $rentersInsurance + $maintanence + $othExpenses;
            echo "<p>Expenses other than rent</p>$monthlyOtherExp";
            $monthlyRentalExpenses = $houseRent + $monthlyOtherExp;
            echo "<p>Expenses</p>$monthlyRentalExpenses";

            $totalSavings = $monthlyEarnings - $monthlyRentalExpenses;
            echo "<p>Savings:</p>$totalSavings";
        }
        ?>
        </div>
    </div>
    <div class="gridHouseBuy">
        <div class="calculatorForm">
            <form class="houseBudgetPlanner" action="budgetPlanner.php" method="POST">
                <label for="loanAmount">Loan Amount</label>
                <input type="text" name="principalAmount" value="" placeholder="Example: 400000">
                <label for="term">Term</label>
                <input type="text" name="loanTenure" id="loanTenure" value="" placeholder ="Example: 30">
                <label for="interest">Annual Interest</label>
                <input type="text" name="interest" id="" value="" placeholder="Example: 5">
                <input class="houseCalculateButtton" type="submit" name="calculateButton" value="Calculate">
            </form>
        </div>
        <div class ="rentResultDisplay">
            <?php
        // created by Liesetty
        // validation for inputs by user
        if (isset($_POST["calculateButton"])) {
            # code...
            $principalAmount = (isset($_POST["principalAmount"])) ? intval($_POST["principalAmount"]) : "" ;
            $loanTenure = (isset($_POST["loanTenure"])) ? intval($_POST["loanTenure"]) : "" ;
            $interest = (isset($_POST["interest"])) ? intval($_POST["interest"]) : "" ;
            
            // calculating monthly payment
            $rateOfInterest = $interest/100;
            $annualPaymentsCount = 12;
            // fromula is MP(mortgage payment) = (principal(p)*(rateOfInterest(r)/annualPaymentsCount(n)))/(1-(1+(r/n)*pow(t))), t = -n*loanTenure
            $montlyInterest = $rateOfInterest/$annualPaymentsCount;
            $totalMonths = -$annualPaymentsCount*$loanTenure;
            
            if ($principalAmount == 0 && $loanTenure == 0 && $interest == 0) {
                # code...
                echo "<p>Please Enter valid Inputs</p>";
            } else {
                # code...
                $result = ($principalAmount*$montlyInterest)/(1-((1+$montlyInterest)**$totalMonths));
                $result = round($result, 2);
                echo"<p>Monthly mortage payment: $result</p>";
                echo "<p>Note: the total monthly mortgage payment is only to buy a house it excludes other bills which are added in rental house</p>";
            }
            
        }
        ?>
        </div>
    </div>
</div>
<!-- end:: budget planner -->

<footer class = "footer">
        <p style="font-weight: 700; font-size: 25px;">The Ultimate Destination.</p>
        <p>© 2024. All rights reserved.</p>
    </footer>    
</body>
</html>