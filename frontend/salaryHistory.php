<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
$employeeId = $_SESSION['emplID'];
if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
    $sql = "SELECT 
                e.*, sp.*
            FROM 
                salarypaid sp
            LEFT JOIN 
                employee e ON sp.employeeId = e.id";
} else {
    $sql = "SELECT 
                e.*, sp.*
            FROM 
                salarypaid sp
            LEFT JOIN 
                employee e ON sp.employeeId = e.id
            WHERE sp.employeeId = $employeeId";
}

$result = mysqli_query($conn, $sql);
$name = array();
$year = array();
$month = array();
$paidAmount = array();
$paidDate = array();

while ($row = mysqli_fetch_assoc($result)) {

    $name[] = $row['name'];
    $year[] = $row['year'];
    $month[] = $row['month'];
    $paidAmount[] = $row['totalPaidAmount'];
    $paidDate[] = date("Y-m-d", strtotime($row['date']));
}
?>
<title>Salary History</title>
</head>

<body>
    <?php
    include('../backend/include/navbar.php');

    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Salary History</h1>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Salary History</h5>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Paid Amount</th>
                                            <th scope="col">Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($name); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i + 1;  ?></td>
                                                <td><?php echo $name[$i];  ?></td>
                                                <td><?php echo $year[$i];  ?></td>
                                                <td><?php echo $month[$i];  ?></td>
                                                <td><?php echo $paidAmount[$i];  ?></td>
                                                <td><?php echo $paidDate[$i];  ?></td>
                                                <td>

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