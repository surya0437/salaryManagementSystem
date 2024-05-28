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
<style>
  /* Hide the default file input */
  #imageInput {
    display: none;
  }

  /* Style the custom file upload label */
  .custom-file-upload {
    cursor: pointer;
    display: inline-block;
    color: #fff;
    /* Adjust color as needed */
    background-color: #007bff;
    /* Adjust background color as needed */
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
  }

  /* Style the icon inside the label */
  .custom-file-upload .bi {
    font-size: 20px;
    /* Adjust icon size as needed */
  }
</style>
<title>Students List</title>
</head>

<body>
  <?php
  include('../backend/include/navbar.php');
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Profile</h1>
    </div>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../backend/images/<?php echo $_SESSION['image']; ?>" alt="Profile" class="rounded-circle">
              <h2>Kevin Anderson</h2>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['email']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['phone']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['gender']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['address']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Create Date</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['date']; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form class="row g-3" action="../backend/include/code.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="empId" id="" value="<?php echo $_SESSION['emplID']; ?>">
                    <div class="row mb-3">
                      <div class="d-flex align-items-center col-md-4 col-lg-3">
                        <label for="profileImage" class=" col-form-label">Profile Image</label>
                      </div>
                      <div class="d-flex align-items-center col-md-8 col-lg-9">
                        <img src="../backend/images/<?php echo $_SESSION['image']; ?>" alt="Profile" id="img" style="max-width: 80px;">
                        <div class="mx-3 pt-2">
                          <label for="imageInput" class="custom-file-upload">
                            <input type="file" id="imageInput" name="image" onchange="loadImage()">
                            <i class="bi bi-pencil-square text-white"></i>
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="<?php echo $_SESSION['name']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="company" value="<?php echo $_SESSION['email']; ?>" disabled>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Job" value="<?php echo $_SESSION['phone']; ?>">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="d-flex gap-5 flex-wrap">

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Male" <?php if ($_SESSION['gender'] == 'Male') {
                                                                                                                        echo 'checked';
                                                                                                                      } ?>>
                            <label class="form-check-label" for="gridRadios1">Male</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female" <?php if ($_SESSION['gender'] == 'female') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="gridRadios2">Female</label>
                          </div>
                          <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="others" <?php if ($_SESSION['gender'] == 'others') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="gridRadios3">Others</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php echo $_SESSION['address']; ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="editProfile">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="../backend/include/code.php" method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirmPassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
 
  <script type="text/javascript">
    function loadImage() {
      var img = document.getElementById('img');
      var input = document.getElementById('imageInput');

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          img.style.display = "block";
          img.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>


<?php
    if (isset($_SESSION['passwordChanged'])) {
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
            <script>
                swal({
                        title: "<?php echo $_SESSION['title']; ?>",
                        text: "<?php echo $_SESSION['status']; ?>",
                        icon: "<?php echo $_SESSION['icon']; ?>",
                        button: true,
                        dangerMode: <?php echo $_SESSION['dangerMode']; ?>,
                    })
                    .then((logout) => {

                        if (logout) {
                            window.location.href = 'logout.php';
                        } else {

                        }
                    });
            </script>
        <?php
            $_SESSION['status'] == '';
            unset($_SESSION['status']);
        }
    } else {
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION['title']; ?>",
                    text: "<?php echo $_SESSION['status']; ?>",
                    icon: "<?php echo $_SESSION['icon']; ?>",
                    button: true,
                    dangerMode: <?php echo $_SESSION['dangerMode']; ?>,
                });
            </script>
    <?php
            $_SESSION['status'] == '';
            unset($_SESSION['status']);
        }
    }
    ?>


  <?php
  include('../backend/include/footer.php');

  ?>