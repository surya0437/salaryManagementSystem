<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
if (isset($_GET['id']) && isset($_GET['name'])) {
  $employeeId = $_GET['id'];
  $name = $_GET['name'];

  $sql = "SELECT a.* FROM attendance a LEFT JOIN employee emp ON a.employeeId = emp.id WHERE a.employeeId = '$employeeId'";

  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  $attendanceId = array();
  $year = array();
  $month = array();
  $date = array();
  $day = array();

  while ($row = mysqli_fetch_assoc($result)) {

    $attendanceId[] = $row['id'];
    $year[] = $row['year'];
    $month[] = $row['month'];
    $date[] = $row['day'];
    $day[] = $row['days'];

    if ($row['status'] == 1) {
      $status[] = 'Present';
    } else {
      $status[] = 'Absent';
    }
  }

  $salary = "SELECT e.salaryType, s.amount 
        FROM employee e
        LEFT JOIN salary s ON e.salaryType = s.id
        WHERE e.id = '$employeeId'";

  $res = mysqli_query($conn, $salary);

  while ($row = mysqli_fetch_assoc($res)) {
    $salaryType = $row['salaryType'];
    $salaryAmount = $row['amount'];
  }
}
?>

<title>Students List</title>
</head>

<body>
  <?php
  include('../backend/include/navbar.php');
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Calculate Salary</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Calculate Salary of <u><?php echo $name;  ?> :</u></h5>
              <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="col-lg-4">
                  <select class="form-select" id="selectYear" aria-label="State" name="year" style="cursor: pointer;" onchange="filterTable()">
                    <option value="">Select Year</option>
                    <?php
                    for ($i = 2000; $i <= 2030; $i++) {
                    ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                    }
                    $months = array(
                      "January", "February", "March", "April", "May", "June",
                      "July", "August", "September", "October", "November", "December"
                    );
                    ?>
                  </select>
                </div>
                <div class="col-lg-4">
                  <!-- <label for="inputNanme4" class="form-label">Month</label> -->
                  <select class="form-select" id="selectMonth" aria-label="State" name="month" style="cursor: pointer;" onchange="filterTable()">
                    <option value="">Select Month</option>
                    <?php
                    for ($i = 0; $i < 12; $i++) {
                    ?>
                      <option value="<?php echo $months[$i]; ?>"><?php echo $months[$i]; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="alert alert-danger alert-dismissible fade show mt-3 d-none" role="alert" id="errorMsg">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

    <!-- <section class="section" id=""> -->
      <section class="section d-none" id="salaryCalculationSection">
      <div class="row">
        <form class="col-lg-12" id="paymentForm" action="../backend/include/code.php" method="post">
          <input type="hidden" name="employeeId" id="" value="<?php echo $employeeId; ?>">
          <input type="hidden" name="setYear" id="setYear" value="">
          <input type="hidden" name="setMonth" id="setMonth" value="">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="col-lg-4">
                  <b><label for="inputNanme4" class="form-label">Total working days: <label for="inputNanme4" class="form-label" id="workingDay"></label></label></b>
                </div>
                <div class="col-lg-4">
                  <b> <label for="inputNanme4" class="form-label">Total present days: <label for="inputNanme4" class="form-label" id="presentDay"></label></label></b>
                </div>
                <div class="col-lg-4">
                  <b><label for="inputNanme4" class="form-label">Total absent days: <label for="inputNanme4" class="form-label" id="absentDay"></label></label></b>
                </div>
              </div>
              <hr>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <div class="col-lg-4">
                    <label for="inputNanme4" class="form-label"><b>Salary per month:</b> <label for="" id="netSalary"><?php echo $salaryAmount; ?></label></label>
                    <input type="hidden" name="setSalaryamount" id="setSalaryamount" value="">
                  </div>
                  <div class="col-lg-4">
                    <label for="inputNanme4" class="form-label"><b>Month:</b> <label for="" id="getMonth"></label></label></label>
                    
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <div class="col-lg-4 d-flex align-items-center justify-content-center gap-3">
                    <label for="inputNanme4" class="form-label"><b>Bonus:</b></label>
                    <input type="number" class="form-control" name="bonus" id="bonus">
                    <input type="hidden" name="setBonus" id="setBonus" value="">

                  </div>
                  <div class="col-lg-4">
                    <label for="inputNanme4" class="form-label"><b>VAT: </b>13%</label>
                    <input type="hidden" name="setVat" id="setVat" value="13">
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <div class="col-lg-4 d-flex align-items-center gap-3">
                    <label for="inputNanme4" class="form-label"><b>Total vat amount: </b><label for="inputNanme4" class="form-label" id="vatAmount"></label></label>
                    <input type="hidden" name="setVatAmount" id="setVatAmount" value="">
                  </div>
                  <div class="col-lg-4 d-flex align-items-center gap-3">
                    <label for="inputNanme4" class="form-label"><b>Total payable amount: </b><label for="inputNanme4" class="form-label" id="totalPayable"></label></label>
                    <input type="hidden" name="setPayableAmount" id="setPayableAmount" value="">
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                  <div class="col-lg-4">
                    <button class="btn btn-primary" type="button"><i class="bi bi-calculator"></i><label for="" class="px-2" onclick="calculateTotalSalary()" style="cursor: pointer;">Calculate</label></button>
                  </div>
                  <div class="col-lg-4">
                    <button class="btn btn-primary" type="button" name="paySalary" onclick="confirmPayment()"><i class="bi bi-credit-card"></i><label for="" class="px-2">Pay</label></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Attendance list</h5>
              <table class="table datatable" id="empDataTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Year</th>
                    <th scope="col">Month</th>
                    <th scope="col">Date</th>
                    <th scope="col">Day</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < count($attendanceId); $i++) {
                  ?>
                    <tr>
                      <th><?php echo $i + 1;  ?></th>
                      <td><?php echo $year[$i];  ?></td>
                      <th><?php echo $month[$i];  ?></th>
                      <td><?php echo $date[$i];  ?></td>
                      <td><?php echo $day[$i];  ?></td>
                      <td><?php echo $status[$i];  ?></td>
                      <td>
                        <a href="" style="margin-left: 15px;"><i class="bi bi-pencil text-primary"></i></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    function confirmPayment() {
      swal({
          title: "Are you sure?",
          text: "This action can not be undo !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {
            document.getElementById('paymentForm').submit();
          } else {

          }
        });
    }
  </script>
  <script src="../assets/js/salaryCalculation.js"></script>


  <?php
  include('../backend/include/footer.php');

  ?>