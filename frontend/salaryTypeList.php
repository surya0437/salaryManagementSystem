<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
$sql = "SELECT * FROM `salary`";
$result = mysqli_query($conn, $sql);

$id = array();
$salaryType = array();
$amount = array();
$date = array();

while ($row = mysqli_fetch_assoc($result)) {
  $id[] = $row['id'];
  $salaryType[] = $row['SalaryTypeId'];
  $amount[] = $row['amount'];
  $date[] = date("Y-m-d", strtotime($row['date']));
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
      <h1>Salary Type</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Salary Type</h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Salary Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < count($id); $i++) {
                  ?>
                    <tr>
                      <td scope="row"><?php echo $i + 1;  ?></td>
                      <!-- <td scope="row"><?php echo $id[$i]; ?></td> -->
                      <td scope="row"><?php echo $salaryType[$i];  ?></td>
                      <td scope="row"><?php echo $amount[$i];  ?></td>
                      <td scope="row"><?php echo $date[$i];  ?></td>
                      <td>
                        <button class="btn" onclick="popUp(<?php echo $id[$i]; ?>, 'deleteSalary')"><i class="bi bi-trash text-danger"></i></button>
                        <!-- <a href=""><i class="bi bi-trash text-danger"></i></a> -->
                        <a href="editSalary.php?editid=<?php echo $id[$i]; ?>" style="margin-left: 15px;"><i class="bi bi-pencil text-primary"></i></a>
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
    function popUp(id, deleteSalary) {
      swal({
          title: "Are you sure?",
          text: "This data will be delete permanently !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {
            window.location.href = '../backend/include/code.php?' + deleteSalary + '=' + id;
          } else {

          }
        });
    }
  </script>
  <?php
  include('../backend/include/footer.php');

  ?>
