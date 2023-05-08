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
          <a class="nav-link" href="home.php?logout=<?php echo $user_id; ?>">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="websitePage" style="height: 100%;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-2 text-lg-right">
          <i class="fas fa-dumbbell fa-5x orange"></i>
        </div>
        <div class="col-12 col-lg-3 my-auto">
          <h1 class="lighter-text text-lg-left gray-shadow-text border-text">Gym<span style="">Bro</span></h1>
        </div>
      </div>
    </div>
  </div>

</body>
</html>