<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
$sql = "SELECT * FROM `employeetype`";
$result = mysqli_query($conn, $sql);

$id = array();
$salaryType = array();
$date = array();

while ($row = mysqli_fetch_assoc($result)) {
    $id[] = $row['id'];
    $employeeType[] = $row['employeeType'];
    $date[] = date("Y-m-d", strtotime($row['date']));
}

?>
<title>Add Employee Type</title>
</head>

<body>
    <?php
    include('../backend/include/navbar.php');
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Employee Type</h1>

        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Employee Type</h5>

                            <form class="row g-3" action="../backend/include/code.php" method="post">
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Employee Type</label>
                                    <input type="text" class="form-control" id="inputNanme4" name="employeeType">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="addEmployeeType">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Salary</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Employee Type</th>
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
                                            <td scope="row"><?php echo $employeeType[$i];  ?></td>
                                            <td scope="row"><?php echo $date[$i];  ?></td>
                                            <td>
                                                <button class="btn" onclick="popUp(<?php echo $id[$i]; ?>, 'deleteEmployeeType')"><i class="bi bi-trash text-danger"></i></button>
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
        function popUp(id, deleteEmployeeType) {
            swal({
                    title: "Are you sure?",
                    text: "This data will be delete permanently !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        window.location.href = '../backend/include/code.php?' + deleteEmployeeType + '=' + id;
                    } else {

                    }
                });
        }
    </script>

    <?php
    include('../backend/include/footer.php');
    ?>