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
  <title>FitnessTracker - Home</title>

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
            <span>FitnessTracker</span>
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
          <a class="nav-link" href="progress.php">My Progress</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="workout.php?logout=<?php echo $user_id; ?>">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

    <div class="jumbotron stripes-orange mb-0 pb-3">
        <h1 class="display-4">Workout Logger</h1>
        <p class="lead">Log and track your progress on several popular exercises over time!</p>
        <hr class="my-4">
        <p>You have made 51% progress towards completing your Bench Press goal!</p>
        <div class="progress w-50 mb-3">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">View Goals</a>
        </p>
    </div>

    <div class="websitePage text-left">
        <div class="grayBackdrop mt-5 mb-5 p-3 p-lg-5 mx-auto">

            <!-- Before displaying form -->
                <div id="logWorkoutBtnDiv" style="height:100%; justify-content: center;">
                    <div class="row">
                        <div class="col" style="margin: auto">
                            <?php 
                                if(isset($_POST['cardioSubmitBtn'])){
                                    $typeOfCardio = $_POST['typeOfCardio'];
                                    $timeSpent = $_POST['timeCardio'];
                                    $minOrHr = $_POST['cardioTime'];
                                    $cardioDate = $_POST['dateCardio'];
                                    $readableDate = date("F jS, Y", strtotime($cardioDate));
                                    $timeSpentMins = $timeSpent;

                                    if($minOrHr == "hr"){
                                        $timeSpentMins = $timeSpent * 60;
                                    }

                                    $insertCardioQuery = "INSERT INTO cardio_log VALUES($user_id, '$typeOfCardio', $timeSpentMins, '$cardioDate', NOW());" or die("Cardio Log: Error inserting cardio session into database!");
                                    try{
                                        $result = mysqli_query($conn, $insertCardioQuery);
                                        if($result){
                                            echo "<h4 style='color: green;'>Successfully logged your $timeSpent $minOrHr $typeOfCardio session on $readableDate!</h4>";
                                        }
                                    } catch (Throwable $t) {
                                        echo "<h4 style='color: red;'>Error occurred while logging your cardio session!</h4>";
                                    }
                                } elseif (isset($_POST['liftSubmitBtn'])){
                                    $typeOfLift = $_POST['exercise'];
                                    $weightAmount = $_POST['weight-lifted'];
                                    $numSets = $_POST['numSets'];
                                    $numReps = $_POST['numReps'];
                                    $liftDate = $_POST['dateLift'];

                                    $readableDate = date("F jS, Y", strtotime($liftDate));

                                    $insertLiftQuery = "INSERT INTO lift_log VALUES($user_id, '$typeOfLift', $weightAmount, $numSets, $numReps, '$liftDate', NOW());" or die("Lift Log: Error inserting weightlifting session into database!");
                                    try{
                                        $result = mysqli_query($conn, $insertLiftQuery);
                                        if($result){
                                            echo "<h4 style='color: green;'>Successfully logged your $typeOfLift $numSets x $numReps on $readableDate!</h4>";
                                        }
                                    } catch (Throwable $t) {
                                        echo "<h4 style='color: red;'>Error occurred while logging your weightlifting session!</h4>";
                                    }
                                } else {
                                    echo "<h2>Log Today's Workout</h2>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="margin: auto">
                            <button id="logWorkoutBtn" class="btn btn-warning">Start New Log</button>
                        </div>                 
                    </div>
                </div>
            <!-- -->

            <form id="cardioOrLiftForm" class="myForm">
                <div id="typeExerciseItem" class="logEntryItem">
                    <i class="fa-solid fa-person-running fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="typeExercise">Type of Exercise</label>
                        </div>
                        <div>
                            <select name="typeExercise" class="logInput" required autofocus>
                                <option value="Select an Option">Select an Option</option>
                                <option value="Cardio">Cardio</option>
                                <option value="Weightlifting">Weightlifting</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <form id="cardioForm" class="myForm" method="post" action="workout.php">
                <div id="typeCardioItem" class="logEntryItem">
                    <i class="fa-solid fa-person-biking fa-5x orange ml-3"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="typeOfCardio">Type of Cardio</label>
                        </div>
                        <div>
                            <select name="typeOfCardio" class="logInput" required autofocus>
                                <option value="Treadmill">Treadmill</option>
                                <option value="Bicycle">Bicycle</option>
                                <option value="Swimming">Swimming</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="timeCardioItem" class="logEntryItem">
                    <i class="fa-solid fa-clock fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="timeCardio">Time Spent</label>
                        </div>
                        <div class="row ml-2">
                            <div class="form-item-question">
                                <input type="number" step="0.1" min="0.1" max="1440" name="timeCardio" placeholder="Enter amount" class="logInput" style="width: 200px;" required></input>
                            </div>
                            <div class="ml-2">
                                <label for="cardioTime">
                                    <input type="radio" name="cardioTime" value="min"checked>mins</input>
                                </label>
                                <label for="cardioTime">
                                    <input type="radio" name="cardioTime" value="hr">hrs</input>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="dateCardioItem" class="logEntryItem">
                    <i class="fa-regular fa-calendar fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="dateCardio">Date of Workout</label>
                        </div>
                        <div class="form-item-question">
                            <input type="date" name="dateCardio" min="2022-01-01" max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" class="logInput"></input>
                        </div>
                    </div>
                </div>

                <div id="cardioSubmit" class="logEntryItem text-center">
                    <div class="col-10">
                        <input type="submit" name="cardioSubmitBtn" class="btn btn-warning" value="Submit Log"></input>
                    </div>
                </div>

            </form>

            <form id="liftForm" class="myForm" method="post" action="workout.php">
                <div id="exerciseItem" class="logEntryItem ml-1 ml-lg-0">
                    <i class="fas fa-dumbbell fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="exercise">Exercise</label>
                        </div>
                        <div>
                            <select name="exercise" class="logInput" required autofocus>
                                <option value="Bench Press">Bench Press</option>
                                <option value="Deadlift">Deadlift</option>
                                <option value="Squat">Squat</option>
                                <option value="Overhead Press">Overhead Press</option>
                                <option value="Leg Press">Leg Press</option>
                                <option value="Bicep Curls">Bicep Curls</option>
                                <option value="Tricep Extensions">Tricep Extensions</option>
                                <option value="Lat Pulldowns">Lat Pulldowns</option>
                                <option value="Lat Raises">Lat Raises</option>
                                <option value="Bench Press">Dips</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="weightLiftedItem" class="logEntryItem">
                <i class="fa-solid fa-weight-hanging fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="weight-lifted">Weight Lifted (Lbs)</label>
                        </div>
                        <div class="form-item-question">
                            <input type="number" step="0.5" min="0.5" max="2000" name="weight-lifted" placeholder="Enter amount" class="logInput" required></input>
                        </div>
                    </div>
                </div>

                <div id="numSetsItem" class="logEntryItem">
                <i class="fa-solid fa-toolbox fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="numSets">Number of Sets</label>
                        </div>
                        <div class="form-item-question">
                            <input type="number" step="0.5" min="0.5" max="100" name="numSets" placeholder="Enter # of sets" class="logInput" required></input>
                        </div>
                    </div>
                </div>

                <div id="numRepsItem" class="logEntryItem">
                <i class="fa-solid fa-repeat fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="numReps">Number of Reps</label>
                        </div>
                        <div class="form-item-question">
                            <input type="number" step="0.5" min="0.5" max="1000" name="numReps" placeholder="Enter # of reps" class="logInput" required></input>
                        </div>
                    </div>
                </div>

                <div id="dateLiftItem" class="logEntryItem">
                    <i class="fa-regular fa-calendar fa-5x orange"></i>
                    <div class="my-auto mx-3">
                        <div>
                            <label for="dateLift">Date of Workout</label>
                        </div>
                        <div class="form-item-question">
                            <input type="date" name="dateLift" min="2022-01-01" max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" class="logInput"></input>
                        </div>
                    </div>
                </div>

                <div id="liftSubmit" class="logEntryItem text-center">
                    <div class="col-10">
                        <input type="submit" name="liftSubmitBtn" class="btn btn-warning" value="Submit Log"></input>
                    </div>
                </div>

            </form>
        </div> <!-- End of grayBackdrop -->

        <div class="orangeBackdrop mt-5 mb-5 px-5 py-3 mx-auto text-center">
            <h2>My Workout History</h2>
            <hr>
            <ul class="list-group">
                <?php 
                    $checkIfUserHasAnyCardioLogs = "SELECT * FROM cardio_log WHERE userid='$user_id' ORDER BY createdOn" or die("Cardio History: Error checking database for existing cardio logs!");
                    $resultCardio = mysqli_query($conn, $checkIfUserHasAnyCardioLogs);
                    
                    $checkIfUserHasAnyLiftLogs = "SELECT * FROM lift_log WHERE userid='$user_id' ORDER BY createdOn" or die("Lift History: Error checking database for existing lift logs!");
                    $resultLift = mysqli_query($conn, $checkIfUserHasAnyLiftLogs);
                    
                    if(mysqli_num_rows($resultCardio) <= 0 && mysqli_num_rows($resultLift) <= 0){
                        echo   "<li class='list-group-item list-group-item-action list-group-item-warning m-1'>
                                    <div class='container'>
                                        <div class='row'>
                                            <div class='col'>
                                                You haven't logged any workouts!
                                            </div>
                                        </div>
                                    </div>
                                </li>";
                    } else {
                        $logs = array();
                        while ($row = mysqli_fetch_assoc($resultCardio)){ //Get row from database table
                            $logs[$row['createdOn']] = $row;
                        }
                        while ($row = mysqli_fetch_assoc($resultLift)){ //Get row from database table
                            $logs[$row['createdOn']] = $row;
                        }
                        krsort($logs);
                        $yellow = true;
                        foreach($logs as $log){
                            if($yellow){
                                echo   "<li class='list-group-item list-group-item-action list-group-item-warning m-1' style='border-radius: 5px;'>";
                                $yellow = false;
                            } else {
                                echo   "<li class='list-group-item list-group-item-action list-group-item-light m-1' style='border-radius: 5px;'>";
                                $yellow = true;
                            }
                            if (array_key_exists("cardioDate", $log)){
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
                            } elseif (array_key_exists("liftDate", $log)){
                                echo   "<div class='container'>
                                            <div class='row'>
                                                <div class='col-7 text-left'>
                                                    <span class='workoutHistoryTopLeft'>" .
                                                        $log['typeOfLift']
                                                    . "</span>
                                                </div>
                                                <div class='col-5 text-right'>" .
                                                    date("F jS, Y", strtotime($log['liftDate']))
                                                . "</div>
                                            </div>

                                            <div class='row'>
                                                <div class='col-4'>
                                                    <span class='workoutHistoryBottomLeft'>" .
                                                        $log['numSets'] . "x" . $log['numReps'] . " @ " . $log['weightAmount'] . " Lbs"
                                                    . "</span>
                                                </div>
                                                <div class='col-8 text-right mt-auto'>
                                                    <span class='workoutHistoryBottomRight'>Logged " .
                                                        date("F jS g:i a", strtotime($log['createdOn']))
                                                    . "</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>";
                            }
                        }
                    }
                ?>

            </ul>
        </div> <!-- end of orangeBackdrop -->
        
    </div>

</body>
</html>
