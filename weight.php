<?php
    include 'connect_db.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    };

    if(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>GymBro - Home</title>

  <!-- Custom font links -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dongle&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">

  <!-- Bootstrap include link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FontAwesome Kit -->
  <script src="https://kit.fontawesome.com/8e14032615.js" crossorigin="anonymous"></script>
  <!-- Plotly JS -->
  <script src="https://cdn.plot.ly/plotly-2.20.0.min.js" charset="utf-8"></script>
  <!-- Custom External Stylesheet -->
  <link href="style.css" rel="stylesheet" type="text/css" />
  <!-- Custom Javascript file -->
  <script type="text/javascript" src="script.js"></script>
</head>

<body class="nunito">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand ml-3" href="home.php">
        <div class="row justify-content-center">
            <i class="fas fa-dumbbell fa-2x orange"></i>
        </div>
        <div class="row justify-content-center">
            <span>GymBro</span>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="goals.php">Goals<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="calorie.php">Calorie Logger</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="weight.php">Weight Logger</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="workout.php">Workout Logger</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="protein.php">Protein Shake Logger</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="progress.php">My Progress</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="workout.php?logout=<?php echo $user_id; ?>">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

    <div class="jumbotron stripes-blue mb-0 pb-3">
        <h1 class="display-4">Weight Logger</h1>
        <p class="lead">Log and track your progress towards your target weight!</p>
        <hr class="my-4">
        <p>You have made 51% progress towards your target weight!</p>
        <div class="progress w-50 mb-3">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p class="lead">
            <a class="btn btn-warning btn-lg" href="#" role="button">View Goals</a>
        </p>
    </div>

    <div class="websitePage text-left">
        <div id="myDiv" style="width: 500px; height: 500px; background-color: beige;">
        </div>

        <div class="grayBackdrop mt-5 mb-5 p-3 p-lg-5 mx-auto">

            <!-- Before displaying form -->
                <div id="logWeightBtnDiv" style="height:100%; justify-content: center;">
                    <div class="row">
                        <div class="col" style="margin: auto">
                            <?php 
                                if(isset($_POST['weightSubmitBtn'])){
                                    $weighInLbs = $_POST['weight'];
                                    $weighInDate = $_POST['dateWeight'];
                                    $bodyFat = (!empty($_POST['bodyFat']) ? $_POST['bodyFat'] : "NULL");
                                    $bmi = (!empty($_POST['bmi']) ? $_POST['bmi'] : "NULL");
                                    $water = (!empty($_POST['water']) ? $_POST['water'] : "NULL");
                                    $bone = (!empty($_POST['bone']) ? $_POST['bone'] : "NULL");
                                    $readableDate = date("F jS, Y", strtotime($weighInDate));

                                    $insertWeighInQuery = "INSERT INTO weight_log (userid, weighInLbs, fat, bmi, water, bone, weighInDate, createdOn) VALUES($user_id, $weighInLbs, $bodyFat, $bmi, $water, $bone, '$weighInDate', NOW());" or die("Weight Log: Error inserting weight into database!");
                                    try{
                                        $result = mysqli_query($conn, $insertWeighInQuery);
                                        if($result){
                                            echo "<h4 style='color: green;'>Successfully logged your weight for $readableDate!</h4>";
                                        }
                                    } catch (Throwable $t) {
                                        echo "<h4 style='color: red;'>Error occurred while logging your weight!</h4>";
                                    }
                                } else {
                                    echo "<h2>Log Today's Weigh-In</h2>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="margin: auto">
                            <button id="logWeightBtn" class="btn btn-warning">Start New Log</button>
                        </div>                 
                    </div>
                </div>
            <!-- -->

            <form id="logWeightForm" class="myForm" method="post" action="weight.php">

                <div id="dateWeightItem" class="logEntryItem">
                    <i class="fa-regular fa-calendar fa-5x" style="color: #3299e9;"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="dateWeight">Date of Weigh-In</label>
                        </div>
                        <div class="form-item-question">
                            <input type="date" name="dateWeight" min="2022-01-01" max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" class="logInput"></input>
                        </div>
                    </div>
                </div>

                <div id="weightItem" class="logEntryItem">
                <i class="fa-solid fa-weight-scale fa-5x" style="color: #3299e9;"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="weight">Weight (Lbs)</label>
                        </div>
                        <div class="form-item-question">
                            <input type="number" step="0.1" min="1" max="1000" name="weight" placeholder="Enter weight" class="logInput" required></input>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    
                    <div class="col">
                        <hr>
                    </div>

                    <div class="col" id="weighInAdvancedBtn">
                        <div class="row justify-content-center">
                            Advanced Options
                        </div>
                        <div class="row justify-content-center">
                            <i id="weighInAdvancedDown" class="fa-solid fa-caret-down fa-2x weighInAdvancedIcon" style="color: #3299e9;"></i>
                            <i id="weighInAdvancedUp" class="fa-solid fa-caret-up fa-2x weighInAdvancedIcon" style="color: #3299e9;"></i>
                        </div>
                    </div>

                    <div class="col">
                        <hr>
                    </div>
                </div>

                <div class="advancedWeighInItems">

                    <div id="bodyFatItem" class="logEntryItem">
                    <i class="fa-solid fa-person fa-5x" style="color: #3299e9;"></i>
                        <div class="my-auto ml-5">
                            <div>
                                <label for="bodyFat">Body Fat %</label>
                            </div>
                            <div class="form-item-question">
                                <input type="number" step="0.1" min="1" max="100" name="bodyFat" placeholder="Enter Body Fat %" class="logInput"></input>
                            </div>
                        </div>
                    </div>

                    <div id="BMIItem" class="logEntryItem">
                    <i class="fa-solid fa-scale-balanced fa-5x ml-2" style="color: #3299e9;"></i>
                        <div class="my-auto mx-3">
                            <div>
                                <label for="bmi">BMI</label>
                            </div>
                            <div class="form-item-question">
                                <input type="number" step="0.1" min="1" max="50" name="bmi" placeholder="Enter BMI" class="logInput"></input>
                            </div>
                        </div>
                    </div>

                    <div id="waterItem" class="logEntryItem">
                    <i class="fa-solid fa-droplet fa-5x" style="color: #3299e9;"></i>
                        <div class="my-auto ml-5">
                            <div>
                                <label for="water">Water Weight %</label>
                            </div>
                            <div class="form-item-question">
                                <input type="number" step="0.1" min="1" max="100" name="water" placeholder="Enter Water %" class="logInput"></input>
                            </div>
                        </div>
                    </div>

                    <div id="boneItem" class="logEntryItem">
                    <i class="fa-solid fa-bone fa-5x" style="color: #3299e9;"></i>
                        <div class="my-auto ml-4">
                            <div>
                                <label for="bone">Bone Weight %</label>
                            </div>
                            <div class="form-item-question">
                                <input type="number" step="0.1" min="1" max="50" name="bone" placeholder="Enter Bone %" class="logInput"></input>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="weightSubmit" class="logEntryItem text-center">
                    <div class="col-10">
                        <input type="submit" name="weightSubmitBtn" class="btn btn-warning" value="Submit Log"></input>
                    </div>
                </div>

            </form>
        </div> <!-- End of grayBackdrop -->

        <div class="blueBackdrop mt-5 mb-5 px-5 py-3 mx-auto text-center">
            <h2>My Weigh-In History</h2>
            <hr>
            <ul class="list-group">
                <?php 
                    $checkIfUserHasAnyWeighInLogs = "SELECT * FROM weight_log WHERE userid='$user_id' ORDER BY createdOn DESC" or die("WeighIn History: Error checking database for existing weigh-in logs!");
                    $resultWeighIn = mysqli_query($conn, $checkIfUserHasAnyWeighInLogs);
                    
                    if(mysqli_num_rows($resultWeighIn) <= 0){
                        echo   "<li class='list-group-item list-group-item-action list-group-item-warning m-1'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='col'>
                                                Start tracking your weight above!
                                            </div>
                                        </div>
                                    </div>
                                </li>";
                    } else {
                        $logs = array();
                        while ($row = mysqli_fetch_assoc($resultWeighIn)){ //Get row from database table
                            $logs[] = $row;
                        }
                        $aqua = true;
                        foreach ($logs as $log){
                            if($aqua){
                                echo   "<li class='list-group-item list-group-item-action list-group-item-primary m-1' style='border-radius: 5px;'>";
                                $aqua = false;
                            } else {
                                echo   "<li class='list-group-item list-group-item-action list-group-item-light m-1' style='border-radius: 5px;'>";
                                $aqua = true;
                            }
                            echo   "<div class='container'>
                                        <div class='row'>
                                            <div class='col-7 text-left'>
                                                <span class='workoutHistoryTopLeft'>" .
                                                $log['typeOfCardio'] . " Session"
                                            . "</span>
                                            </div>
                                            <div class='col-5 text-right'>" .
                                                date("F jS, Y", strtotime($log['cardioDate']))
                                            . "</div>
                                        </div>

                                        <div class='row'>
                                            <div class='col-5'>
                                                <span class='workoutHistoryBottomLeft'>" .
                                                    ($log['timeSpentMins'] > 60 ? number_format((float) $log['timeSpentMins'] / 60, 2, '.', '') . ' hrs' : number_format((float) $log['timeSpentMins'], 2, '.', '') . ' mins')
                                                . "</span>
                                            </div>
                                            <div class='col-7 text-right mt-auto'>
                                                <span class='workoutHistoryBottomRight'>Logged " .
                                                date("F jS g:i a", strtotime($log['createdOn']))
                                                . "</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>";
                        }
                    }
                ?>

            </ul>
        </div> <!-- end of blueBackdrop -->
        
    </div>

</body>
</html>
