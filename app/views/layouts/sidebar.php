<?php use App\Cores\Helper; ?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Helper::fullPath('/.') ?>">
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