<?php use App\Cores\Helper; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Back Data Management</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= Helper::fullPath('/assets/fonts/iconic/css/material-design-iconic-font.min.css') ?>">
	<link href="<?= Helper::fullPath('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= Helper::fullPath('/assets/css/login.css') ?>">
	<link href="<?= Helper::fullPath('/assets/css/mystyle.css') ?>" rel="stylesheet">
	<link href="<?= Helper::fullPath('/assets/css/google.font.css') ?>" rel="stylesheet">

	<!-- Custom styles for this template-->
	<!-- <link href="assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
	<script src="<?= Helper::fullPath('/assets/js/my_func.js') ?>"></script>
	<script src="<?= Helper::fullPath('/assets/vendor/tinymce/tinymce.min.js') ?>"></script>
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once __DIR__. "/../layouts/sidebar.php" ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php require_once __DIR__."/../layouts/topbar.php" ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
            <div class="col-3"></div>
            <div class="col-5">
              <div class="card shadow rounded-3">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">Change my password</h5>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?= Helper::fullPath('/api/change-password') ?>">
                    <!-- Username -->
                    <div class="mb-4">
                      <label class="form-label">Old password</label>
                      <input type="password" name="old_password" class="form-control" placeholder="Enter old password" required>
                    </div>
                    <!-- New Password -->
                    <div class="mb-4">
                      <label class="form-label">New password</label>
                      <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                    </div>
                    <!-- Confirm New Password -->
                    <div class="mb-4">
                      <label class="form-label">Confirm new password</label>
                      <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <!-- Error Message -->
                    <?php if(isset($error)): ?>
                      <div class="mb-4">
                        <div class="alert alert-danger" role="alert">
                          <?= $error ?>
                        </div>
                      </div>
                    <?php endif ?>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary col-3">Change Password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; JL 2026</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= Helper::fullPath('/assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= Helper::fullPath('/assets/vendor/popper.js/popper.min.js') ?>"></script>
  <script src="<?= Helper::fullPath('/assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?= Helper::fullPath('/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
  <!-- Custom scripts for all pages-->
  <script src="<?= Helper::fullPath('/assets/js/sb-admin-2.min.js') ?>"></script>
  <!-- Page level plugins -->
</body>
</html>