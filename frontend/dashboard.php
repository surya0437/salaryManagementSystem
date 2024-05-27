<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
$sql =mysqli_query($conn, "SELECT * FROM `employee`");
$numberOfEmployee = mysqli_num_rows($sql);

$sql1 =mysqli_query($conn, "SELECT * FROM `salary`");
$numberOfSalary = mysqli_num_rows($sql1);
?>
<title>Dashboard</title>
</head>

<body>
  <?php
  include('../backend/include/navbar.php');
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Employee</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $numberOfEmployee ?></h6>
                      <a href="employeeList.php">

                        <span class="text-success small pt-1 fw-bold">View</span>
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Salary</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $numberOfSalary ?></h6>
                      <a href="salaryTypeList.php">
                        <span class="text-success small pt-1 fw-bold">View</span>
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>
    </section>

  </main>
  <?php
  include('../backend/include/footer.php');
  ?>