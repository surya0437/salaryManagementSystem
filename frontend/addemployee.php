<?php
include('../backend/include/header.php');
include('../backend/include/database.php');
include('../backend/include/auth.php');
// $sql = "SELECT * FROM `salary`";
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

$sql1 = "SELECT * FROM `employeetype`";
$result1 = mysqli_query($conn, $sql1);
$emptid = array();
$employeeType = array();
while ($row = mysqli_fetch_assoc($result1)) {
    $emptid[] = $row['id'];
    $employeeType[] = $row['employeeType'];
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
            <h1>Add Employee</h1>

        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Employee</h5>

                            <form class="row g-3" action="../backend/include/code.php" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Gender</label>
                                    <div class="d-flex gap-5 flex-wrap">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Male">
                                            <label class="form-check-label" for="gridRadios1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                                            <label class="form-check-label" for="gridRadios2">
                                                Female
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="others">
                                            <label class="form-check-label" for="gridRadios3">
                                                Others
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address">
                                </div>

                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Employee Type</label>
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="employeeType" style="cursor: pointer;">
                                        <option value="">Select</option>
                                        <?php
                                        for ($i = 0; $i < count($emptid); $i++) {
                                        ?>
                                            <option value="<?php echo $emptid[$i]; ?>"><?php echo $employeeType[$i]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Salary Type</label>
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="salaryType" style="cursor: pointer;">
                                        <option value="">Select</option>
                                        <?php
                                        for ($i = 0; $i < count($id); $i++) {
                                        ?>
                                            <option value="<?php echo $id[$i]; ?>"><?php echo $salaryType[$i]; ?> (<?php echo $amount[$i]; ?>) </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Role</label>
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="role" style="cursor: pointer;">
                                        <option value="">Select</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Employee">Employee</option>
                                        
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="addEmployee">Submit</button>
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