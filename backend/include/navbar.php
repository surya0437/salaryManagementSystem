<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="dashboard.php" class="logo d-flex align-items-center">
    <img src="../assets/img/SMSlogo.png" alt="" style="max-height: 60px;">
      <!-- <span class="d-none d-lg-block">PayMaster</span> -->
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar"></div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="../backend/images/<?php echo $_SESSION['image']; ?>" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name']; ?></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $_SESSION['name']; ?></h6>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul>
      </li>

    </ul>
  </nav>

</header>


<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
?>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="http://localhost/salaryMS/frontend/dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#salary-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-cash"></i><span>Salary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="salary-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="nav-link collapsed" href="salaryTypeList.php">
              <i class="bi bi-circle"></i>
              <span>Salary Type</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="addSalary.php">
              <i class="bi bi-circle"></i>
              <span>Add Salary Type</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed" href="salaryPayment.php">
              <i class="bi bi-circle"></i>
              <span>Pay Salary</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="salaryHistory.php">
              <i class="bi bi-circle"></i>
              <span>Salary History</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#employee-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-person"></i><span>Employee</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="employee-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="nav-link collapsed" href="employeeList.php">
              <i class="bi bi-circle"></i>
              <span>Employee List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="addemployee.php">
              <i class="bi bi-circle"></i>
              <span>Add Employee</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="addEmployeeType.php">
              <i class="bi bi-circle"></i>
              <span>Add Employee Type</span>
            </a>
          </li>

        </ul>
      </li>
    </ul>

  </aside>
<?php
} else {
?>
  <aside id="" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="http://localhost/salaryMS/frontend/dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#salary-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-cash"></i><span>My Salary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="salary-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="nav-link collapsed" href="salaryHistory.php">
              <i class="bi bi-circle"></i>
              <span>Salary History</span>
            </a>
          </li>
        </ul>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#profile-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-person"></i><span>My Profile</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="profile-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="nav-link collapsed" href="profile.php">
              <i class="bi bi-circle"></i>
              <span>Edit Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="profile.php">
              <i class="bi bi-circle"></i>
              <span>Change Password</span>
            </a>
          </li>

        </ul>
      </li>

    </ul>

  </aside>
<?php
}
?>