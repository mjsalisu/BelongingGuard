<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");

checklogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Users Logs | Belonging Guard MSSN BUK</title>
  <link rel="icon" href="static/images/logos/mssn.png" type="image/x-icon" />
  <link rel="stylesheet" href="static/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include("./include/sidebar.php"); ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include("./include/header.php"); ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <?php
          $id = $_SESSION["token"];
          $role = $_SESSION["role"];

          $sql = "SELECT * FROM `user` ORDER BY `name` ASC, regNo ASC;";
          $result = mysqli_query($con, $sql);
          $num = mysqli_num_rows($result);
          ?>
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
              Users Overview
            </h5>
            <p class="mb-4">
              <span class="fw-semibold">Total Users:</span> <?php echo $num;  ?>
            </p>
              <div class="table-responsive-sm p-4">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Reg No</th>
                      <th scope="col">Join Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($num <= 0) {
                      echo "<tr><td colspan='6' class='text-center text-muted py-4 h3'>
                      No item has been registered yet
                      </td></tr>";
                    } else {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $row["name"] ?></td>
                          <td><?php echo $row["phone"] ?></td>
                          <td><?php echo $row["email"] ?></td>
                          <td><?php echo ($row["regNo"] != "" ? $row["regNo"] : "—");  ?></td>
                          <td><?php echo $row["created_at"] ?></td>
                        </tr>
                    <?php
                        $i++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
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