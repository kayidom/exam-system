<div class="col-lg-3">

<h3 class="my-2"></h3>
  <div class="list-group"> 
    <?php if(isset($_SESSION["lecturer-auth"])){ ?>
      <a href="?action=lecture-home" class="list-group-item">Dashboard</a>
      <a href="?action=lecture-add-exam" class="list-group-item">Add Exam</a>
      <a href="?action=lecture-logout" class="list-group-item">Logout</a>
    <?php } else { ?>
      <a href="?action=student-home" class="list-group-item">Dashboard</a>
      <a href="?action=student-modules" class="list-group-item">myModules</a>
      <a href="?action=student-exams" class="list-group-item">myExams</a>
      <a href="?action=student-logout" class="list-group-item">Logout</a>
    <?php } ?> 
  </div>

</div>
<!-- /.col-lg-3 -->