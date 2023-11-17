<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
include("./api/updateProfile.php");
checklogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Profile | Belonging Guard MSSN BUK</title>
  <link rel="icon" href="static/images/logos/mssn.png" type="image/x-icon" />
  <link rel="stylesheet" href="static/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include("./include/sidebar.php");  ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include("./include/header.php"); ?>
      <!--  Header End -->
      <div class="container-fluid">
        <?php
        if (isset($_SESSION["msg"])) {
        ?>
          <div class="alert alert-info {% if isError %}alert-danger{% else %}alert-success{% endif %} text-center mb-4" role="alert" id="message">
            <?php echo $_SESSION["msg"]; ?>
          </div>

        <?php
        }
        unset($_SESSION["msg"]);
        ?>

        <div class="card">
          <div class="card-body">
            <?php

            $id = $_SESSION["token"];
            $sql = "SELECT * FROM `user_tbl` WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            $userData = mysqli_fetch_assoc($result);

            ?>
            <h5 class="card-title fw-semibold mb-4">My Profile</h5>
            <form action="./api/updateProfile.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;  ?>">
              <div class="container">
                <fieldset disabled>
                  <div class="row">
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input class="form-control" name="fullname" type="text" value="<?php echo $userData["name"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Phone number</label>
                        <input class="form-control" name="phoneNumber" type="text" value="<?php echo $userData["phone"];  ?>" />
                      </div>
                    </div>
                    <div class="col-sm">
                      <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" name="emailAddress" type="text" value="<?php echo $userData["email"];  ?>" />
                        <!-- <div class="form-text">
                            We'll never share your email with anyone else.
                          </div> -->
                      </div>
                    </div>
                  </div>
                </fieldset>
                <hr />
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Registration number</label>
                      <input class="form-control" type="text" name="regNumber" placeholder="Enter your registration number" value="<?php echo $userData["regNo"];  ?>" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Faculty</label>
                      <input class="form-control" type="text" name="faculty" placeholder="Enter your faculty" value="<?php echo $userData["faculty"];  ?>" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">Department</label>
                      <input class="form-control" type="text" name="department" placeholder="Enter your department" value="<?php echo $userData["department"];  ?>" />
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" name="updateProfile">Save</button>
                <hr />
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <label class="form-label">New password</label>
                      <input class="form-control" name="newPassword" type="password" placeholder="Enter a new password" />
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3"></div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3"></div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="changePass">
                Change password
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./static/libs/jquery/dist/jquery.min.js"></script>
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/sidebarmenu.js"></script>
  <script src="./static/js/app.min.js"></script>
  <script src="./static/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>