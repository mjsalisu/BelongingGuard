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
  <title>Dashboard | Belonging Guard MSSN BUK</title>
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
      <?php include("./include/header.php");  ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <?php
                $id = $_SESSION["token"];
                $role = $_SESSION["role"];

                $sql;
                if ($role == "0") {
                  $sql = "SELECT * FROM `item_tbl` WHERE regById = '$id' ORDER BY `created_at` ASC LIMIT 5";
                } else {
                  $sql = "SELECT * FROM `item_tbl` ORDER BY `created_at` DESC LIMIT 5";
                }
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);
                // print_r($data);
                ?>
                <h5 class="card-title fw-semibold mb-4">
                  Recent 5 Items
                </h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Item name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Type</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Check-in on</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Check-out on</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($num <= 0) {
                        echo "Data not fond";
                      } else {
                        // $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal"><?php echo $row["itemName"] ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <span class="fw-normal"><?php echo $row["itemType"] ?></span>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal"><?php echo ($row["checkIn"] == "" ? "------" : $row["checkIn"]);  ?></p>
                            </td>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                                <p lass="mb-0 fw-normal"><?php echo ($row["checkOut"] == "" ? "------" : $row["checkOut"]);  ?></p>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <?php
                              $status = $row["status"];

                              if ($status == "0") {
                                echo '<span class="badge bg-primary rounded-4 fw-semibold">
                              Awaiting review
                            </span>';
                              } elseif ($status == "1") {
                                echo '<span class="badge bg-danger rounded-4 fw-semibold">
                              Rejected
                            </span>';
                              } elseif ($status == "2") {
                                echo '<span class="badge bg-success rounded-4 fw-semibold">
                              Safe
                            </span>';
                              }

                              ?>
                              
                            </td>
                          </tr>
                      <?php
                          // $i++;
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
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <b>SWE GROUP E</b></p>
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