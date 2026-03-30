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
    <?php require_once __DIR__. "/../../layouts/sidebar.php" ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php require_once __DIR__."/../../layouts/topbar.php" ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
            <div class="col-12">
              <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
                <div class="col-10 d-flex align-items-center">
                  <h5 style="font-weight: bold; margin-left: 50px;">
                    User management
                  </h5>
                </div>
                <div class="col-2">
                  <a href="<?= Helper::fullPath('/admin/users/create') ?>" class="btn btn-success"><b>+</b> Create user</a>
                </div>
              </div>

              <div style="display: block; width: 90%; height: 70vh; margin-left: 50px; margin-right: 50px; overflow-y: scroll; background: #fff; border: solid #eee;">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="col-1">No.</th>
                        <th scope="col" class="col-3">Username</th>
                        <th scope="col" class="col-3">Fullname</th>
                        <th scope="col" class="col-1">Status</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
<?php               $userNo = 1;
                    foreach($users as $user): ?>
                      <tr>
                        <td><?= $userNo++ ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['fullname'] ?></td>
                        <td><?= $user['status'] ?></td>
                        <td></td>
                      </tr>
<?php               endforeach; ?>
                    </tbody>
                  </table>
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