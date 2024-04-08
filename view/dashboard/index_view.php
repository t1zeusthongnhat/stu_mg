<?php require 'view/partials/header_view.php'; ?>
<?php require 'model/CourseModel.php'?>
<?php require 'model/DepartmentModel.php'?>
<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - DashBoard";
$countDepart = countDepartments();
$countCourses = countCourses();
$user = countUser();
$account = account();
?>


<div class="container">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <br>
    <div class="row">
      <div class="col-md-3">
        <div class="custom-panel" onclick="window.location.href='#'">
          <p class="disable-interaction">Total Departments: <span class="total"><?php echo $countDepart; ?></span></p>
          <hr>
          <a href="index.php?c=department" class="more">More</a>
        </div>
        
      </div>
      <div class="col-md-3">
        <div class="custom-panel" onclick="window.location.href='#'">
        <p class="disable-interaction">Total Courses: <span class="total"><?php echo $countCourses; ?></span></p>
          <hr>
          <a href="index.php?c=course" class="more">More</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="custom-panel" onclick="window.location.href='#'">
        <p class="disable-interaction">Total Users: <span class="total"><?php echo $user; ?></span></p>
          <hr>
          <a href="index.php?c=user" class="more">More</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="custom-panel" onclick="window.location.href='#'">
        <p class="disable-interaction">Total Account: <span class="total"><?php echo $account; ?></span></p>
          <hr>
          <a href="index.php?c=account" class="more">More</a>
        </div>
      </div>
    </div>
  </div>
  
</div>
<script src="public/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="public/assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<!-- <script src="public/assets/js/off-canvas.js"></script> -->
<script src="public/assets/js/hoverable-collapse.js"></script>


<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © SE06205 - 2024</span>
        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> BTec <a href="#" target="_blank">FPT.com.vn</span>
    </div>
</footer>
