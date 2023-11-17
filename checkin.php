<?php
error_reporting(0);
include("./function/checkLogin.php");
include("./api/dbcon.php");
checklogin();
if (isset($_POST["checkIn"])) {
  echo $_POST["trackingID"];
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Check-In | Belonging Guard MSSN BUK</title>
    <link rel="icon" href="static/images/logos/mssn.png" type="image/x-icon" />
    <link rel="stylesheet" href="static/css/styles.min.css" />
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
          <div class="card">
            <div class="card-body">

              <?php
                $trackingId = 'H1IZIEL';
                $sqlItem = "SELECT * FROM `item_tbl` WHERE LOWER(trackId) = LOWER('$trackingId') AND status=0";
                $itemResult = mysqli_query($con, $sqlItem);
                $itemData = mysqli_fetch_assoc($itemResult);
              ?>

              <h5 class="card-title fw-semibold mb-4">
                Item Check-In Verification
              </h5>
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <input
                        class="form-control"
                        type="text"
                        name="trackingID"
                        id="trackingIDInput"
                        placeholder="Enter item tracking id"
                      />
                      <div class="form-text" id="hint"></div>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3">
                      <button onclick="showSubPage()" class="btn btn-primary">
                        Search for item
                      </button>
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="mb-3"></div>
                  </div>
                </div>

                <hr />
                <form action="./api/item.php" method="post">
                  <div id="subPage">
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
                          <textarea class="form-control" rows="4" name="itemDescription" placeholder="Enter item description" required><?php echo $itemData["itemDescription"];?></textarea>
                        </div>
                      </div>
                    </div>
                    <input
                      class="form-control"
                      type="hidden"
                      placeholder="checkInBy"
                      name="checkInBy"
                      value="checkInBy"
                      readonly
                    />
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-in or Rejecting note</label>
                          <textarea
                            class="form-control"
                            rows="3"
                            name="checkInNote"
                            placeholder="Enter check-in or rejecting note"
                          ></textarea>
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
    <script src="static/libs/jquery/dist/jquery.min.js"></script>
    <script src="static/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/sidebarmenu.js"></script>
    <script src="static/js/app.min.js"></script>
    <script src="static/libs/simplebar/dist/simplebar.js"></script>
  </body>
</html>
