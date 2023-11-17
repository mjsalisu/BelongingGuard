<?php
error_reporting(0);
include("./function/checkLogin.php");
checklogin();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Check-Out | Belonging Guard MSSN BUK</title>
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
              <h5 class="card-title fw-semibold mb-4">
                Item Check-Out and Collection
              </h5>
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                    <div class="mb-3">
                      <input
                        class="form-control"
                        type="text"
                        name="trackingID"
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

                <form>
                  <div id="subPage">
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Item name</label>
                          <p>{{itemName}}</p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Item type</label>
                          <p>{{itemType}}</p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Quantity</label>
                          <p>{{itemQuantitye}}</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-in date</label>
                          <p>{{checkInDate}}</p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-in by</label>
                          <p>{{checkInBy}}</p>
                        </div>
                      </div>
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Status</label>
                          <p>{{checkInStatus }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-in note</label>
                          <p>{{checkInNote }}</p>
                        </div>
                      </div>
                    </div>
                    <input
                      class="form-control"
                      type="hidden"
                      placeholder="checkInBy"
                      name="checkInBy"
                      value="checkOutBy"
                      readonly
                    />
                    <hr />
                    <div class="row">
                      <div class="col-sm">
                        <div class="mb-3">
                          <label class="form-label">Check-out note </label>
                          <textarea
                            class="form-control"
                            rows="3"
                            name="checkOutNote"
                            placeholder="Enter check-out note"
                          ></textarea>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success m-2">
                      Checkout
                    </button>
                    <button type="submit" class="btn btn-light">Cancel</button>
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
