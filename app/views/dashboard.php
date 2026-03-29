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
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
    <div class="sidebar-brand-icon">
        <img src="<?= Helper::fullPath('/assets/img/books.png') ?>" width="50px">
    </div>
    <div class="sidebar-brand-text mx-3">Back Data Management</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
      foreach ($menuItems as $item) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= Helper::fullPath($item['url']) ?>">
          <i class="fa fa-folder"></i>
          <span><?= $item['label'] ?></span></a>
      </li>
    <?php 
      } ?>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <!-- <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li>
        <?php //require_once "homepage/alert_ui.php"; ?>
        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" style="height: 300px; overflow-y: scroll;">
            <h6 class="dropdown-header">
                Messages list
            </h6>
            <div id="message_list">
                
            </div>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $fullname ?></span>
            <img class="img-profile rounded-circle" src="assets/img/books.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#infoModal" onclick="loadInfo();">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Personal Info
            </a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassModal">
                <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                Change password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Sign out
            </a>
            </div>
        </li>
        
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Do you want to sign out?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Choose the below 'Sign out' to end the current session</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= Helper::fullPath('/api/logout') ?>">Sign out</a>
                </div>
                </div>
            </div>
        </div>

        </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
            <div class="col-12">
              <h5 style="display: block; font-weight: bold; margin-left: 50px; margin-top: 50px; margin-bottom: 20px;">
                Title
              </h5>

              <div style="display: block; width: 90%; height: 75vh; margin-left: 50px; margin-right: 50px; overflow-y: scroll; background: #fff; border: solid #eee;">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Size</th>
                        <th scope="col">Type</th>
                        <th scope="col">Last modified</th>
                      </tr>
                    </thead>
                    <tbody id="dirTableBody">
                      
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
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/popper.js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
</body>
</html>