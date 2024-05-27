<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
if ($_GET['editid']) {
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM `salary` WHERE `id` = '$editid'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $SalaryType = $row['SalaryTypeId'];
        $amount = $row['amount'];
    }
}
?>
<title>Dashboard</title>
</head>

<body>
    <?php
    include('../backend/include/navbar.php');
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Salary</h1>

        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Salary</h5>

                           <form class="row g-3" action="../backend/include/code.php" method="post">
                                <input type="hidden" name="editid" id="" value="<?php echo $editid; ?>">
                               

                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Salary Amount</label>
                                    <input type="text" class="form-control" name="salaryType" id="inputEmail4" value="<?php echo $SalaryType; ?>">
                                </div>

                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Salary Amount</label>
                                    <input type="number" class="form-control" name="salaryAmount" id="inputEmail4" value="<?php echo $amount; ?>">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="editSalary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>


    </main>
    <?php
    include('../backend/include/footer.php');

    ?>