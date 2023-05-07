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

    <div class="jumbotron stripes mb-0 pb-3">
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
        <div class="grayBackdrop mt-3 mb-3">

            <!-- Before displaying form -->
            <div id="logWorkoutBtnDiv" style="height:100%; justify-content: center;">
                <div class="row">
                    <div class="col" style="margin: auto">
                        <h2>Log Today's Workout</h2>
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

            <form id="cardioForm" class="myForm">
                <div id="typeCardioItem" class="logEntryItem">
                    <i class="fa-solid fa-person-biking fa-5x orange"></i>
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
                        <div class="form-item-question">
                            <label for="timeCardio"></label>
                            <input type="text" name="timeCardio" placeholder="Enter amount" class="logInput"></input>
                        </div>
                    </div>
                </div>
            </form>

            <form id="liftForm" class="myForm">
                <div id="exerciseItem" class="logEntryItem">
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
                            <label for="weight-lifted">Weight Lifted</label>
                        </div>
                        <div class="form-item-question">
                            <input type="text" name="weight-lifted" placeholder="Enter amount" class="logInput"></input>
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
                            <input type="text" name="numReps" placeholder="Enter # of reps" class="logInput"></input>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>

</body>
</html>
