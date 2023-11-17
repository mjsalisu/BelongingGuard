<?php
include("./api/auth.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Belonging Guard MSSN BUK</title>
  <link rel="icon" href="static/images/logos/mssn.png" type="image/x-icon" />
  <link rel="stylesheet" href="static/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-12 col-md-6 col-lg-5 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">
                <h4 class="text-center mb-5">
                  Log in and ensure your valuables are protected
                </h4>
                <form action="./api/auth.php" method="post">
                  <div class="mb-3">
                    <label class="form-label">Email address or phone number</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your email address or phone number"  required/>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required />
                  </div>
                  <!-- {{ result_message }} -->
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
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="login">
                    Sign In
                  </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">
                      New to BelongingGuard?
                    </p>
                    <a class="text-primary fw-bold ms-2" href="./register.php"><b>Create an account</b></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./static/libs/jquery/dist/jquery.min.js"></script>
  <script src="./static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./static/js/app.min.js"></script>
</body>

</html>