<?php include ("topHeader.php"); ?>

<br></br>


<!-- Page Content -->

<div class="container" style="margin-bottom: 10px;">

    <div class="row">

        <div class="col-lg-10 d-flex justify-content-center">

            <div class="container">
                <div class="card mx-auto mt-6" style="margin-left: 200px !important;">
                    <div class="card-header">Users Login Page</div>
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab"
                                    aria-controls="student" aria-selected="true">Student Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                    aria-controls="admin" aria-selected="false">Lecturer Login</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="student">
                            <div class="tab-pane active" id="student" role="tabpanel" aria-labelledby="student-tab">
                                <br>
                                <form action="index.php" method="POST" id="StudentForm">
                                    <div class="form-group">
                                        <label for="stud_email">Email Address</label> <input class="form-control"
                                            type="text" name="stud_email" id="stud_email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="stud_email">Password</label> <input class="form-control"
                                            type="password" name="stud_pass" id="stud_pass" placeholder="Enter password">
                                    </div>

                                    <button type="submit" name="action" value="student-login" class="btn btn-success btn-block">Login</button>
                                    <br>
                                    <div class="studResult"></div>
                                </form>
                                Email: 40544605@mylife.unisa.ac.za &nbsp; Password: 9876543 &nbsp; StudNum: 54502349
                            </div>

                            <div class="tab-pane" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                <br>
                                <form method="POST" action="" id="LecturerForm" name="LecturerLogs">
                                    <div class="form-group">
                                        <label for="lect_email">Email Address</label> <input class="form-control"
                                            type="text" name="lect_email" id="lect_email" placeholder="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="lect_pass">Password</label> <input class="form-control"
                                            type="password" name="lect_pass" id="lect_pass" placeholder="password">
                                    </div>

                                    <button type="submit" name="action" value="lecture-login" class="btn btn-success btn-block">Login</button>
                                    <br>
                                    <div class="lectResult"></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
    </div>
</div>

<?php include ("footer.php"); ?>