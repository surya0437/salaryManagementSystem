<?php
include('../backend/include/header.php');
if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']){
  header('location: dashboard.php');
  exit;
}
?>
<title>Login</title>
</head>

<body>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/SMSlogo.png" alt="" style="max-height: 90px;">
                  <!-- <span class="d-none d-lg-block">PayMaster</span> -->
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3" action="../backend/include/code.php" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <input type="text" name="email" class="form-control" id="yourUsername">
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php
  include('../backend/include/footer.php');
  ?>