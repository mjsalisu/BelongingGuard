<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
checklogin();

if ($_SESSION["role"] == "0") {
  $_SESSION["msg"] = "You are not allowed to access this page";
  header("location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Check-In | Belonging Guard MSSN BUK</title>
    <link rel="icon" href="./static/images/logos/mssn.png" type="image/x-icon" />
    <link rel="stylesheet" href="./static/css/styles.min.css" />
  </head>

  <body>
    <!--  Body Wrapper -->
    <div
      class="page-wrapper"
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin6"
      data-sidebartype="full"
      data-sidebar-position="fixed"
      data-header-position="fixed"
    >
      <!-- Sidebar Start -->
      <?php include("./include/sidebar.php"); ?>
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
                if (isset($_GET["trackingID"])) {
                  $trackingId = $_GET["trackingID"];
                  $sqlItem = "SELECT * FROM `item_table` WHERE LOWER(trackId) = LOWER('$trackingId') AND status=0";
                  $itemResult = mysqli_query($con, $sqlItem);
                  $itemData = mysqli_fetch_assoc($itemResult);
                }
              ?>
              <h5 class="card-title fw-semibold mb-4">
                Item Check-In Verification
              </h5>
              <div class="container">
                <form action="./api/item.php" method="post">
                  <div id="">
                   <input type="hidden" name="trackId" value="<?php echo $itemData["trackId"];?>" readonly/>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Item name</label>
                          <input class="form-control" type="text" name="itemName" value="<?php echo $itemData["itemName"];?>" />
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Item type</label>
                          <input class="form-control" type="text" name="itemType" value="<?php echo $itemData["itemType"];?>" />
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Quantity</label>
                          <input class="form-control" type="number" name="itemQuantity" min="1"value="<?php echo $itemData["itemQuantity"];?>"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea class="form-control" rows="3" name="itemDescription" placeholder="Enter item description" required><?php echo $itemData["itemDescription"];?></textarea>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-in or Rejecting note</label>
                          <textarea class="form-control" rows="3" name="checkInNote" placeholder="Enter check-in or rejecting note"></textarea>
                          <div class="form-text" id="hint"></div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2" name="approveItem">
                      Approve
                    </button>
                    <button type="submit" class="btn btn-outline-danger" name="rejectItem">
                      Rejected
                    </button>
                  </div>
                </form>
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
