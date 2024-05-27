<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
$sql = "SELECT 
        e.*, et.employeeType, s.salaryTypeId
    FROM 
        employee e
    LEFT JOIN 
        employeetype et ON e.employeeType = et.id
    LEFT JOIN 
        salary s ON e.id = s.id";

$result = mysqli_query($conn, $sql);
$id = array();
$name = array();
$salaryType = array();
$employeeType = array();
$image = array();
$date = array();

while ($row = mysqli_fetch_assoc($result)) {

  $id[] = $row['id'];
  $name[] = $row['name'];
  $image[] = $row['image'];
  $employeeType[] = $row['employeeType'];
  $salaryType[] = $row['salaryType'];
}
?>
<title>Salary Payment</title>
</head>

<body>
  <?php
  include('../backend/include/navbar.php');

  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Salary Payment</h1>

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pay Salary</h5>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Employee Type</th>
                      <th scope="col">Salary</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($i = 0; $i < count($id); $i++) {
                    ?>
                      <tr>
                        <th><?php echo $i + 1;  ?></th>
                        <th><?php echo $name[$i];  ?></th>
                        <td><?php echo $employeeType[$i];  ?></td>
                        <td><?php echo $salaryType[$i];  ?></td>
                        <td>
                          <a href="calculateSalary.php?id=<?php echo $id[$i] ?>&name=<?php echo $name[$i] ?>"style="margin-left: 15px;"><i class="bi bi-calculator text-success"></i></a>
                          <!-- <a href="" style="margin-left: 15px;"><i class="bi bi-credit-card"></i></a> -->
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->

              </div>
            </div>

          </div>
        </div>
      </section>

  </main><!-- End #main -->

  <script>
    function popUp(id, deleteEmployee) {
      swal({
          title: "Are you sure?",
          text: "This data will be delete permanently !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {
            window.location.href = '../backend/include/code.php?' + deleteEmployee + '=' + id;
          } else {

          }
        });
    }
  </script>
  <?php
  include('../backend/include/footer.php');

  ?>