<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UNISA Homepage - Online Exam Portal</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">

  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="?action=lecturer-home">Online Exam Portal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php if(isset($_SESSION['admin'])) { ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="?action=lecturer-home"><i class="fa fa-home"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=list-exams"><i class="fa fa-desktop"></i> Exams</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=reports"><i class="fa fa-bar-chart"></i> Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?action=logout"><i class="fa fa-power-off"></i> Logout</a>
          </li>
        </ul>
      <?php } ?>
      </div>
    </div>
  </nav>
