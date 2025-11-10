<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <title><?= $this->renderSection('title', true) ?></title>
    <link rel="icon" href="assets/images/logo.png" type="image/png">
    <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="<?= base_url("assets/bootstrap/css/bootstrap.min.css") ?>">
     <link rel="stylesheet" href="<?= base_url('bootstrap-icons/font/bootstrap-icons.css'); ?>">
     <link rel="stylesheet" href="<?= base_url("assets/bootstrap/css/bootstrap-icons.min.css")?>">
     <link rel="stylesheet" href="<?= base_url('sweetalert2/dist/sweetalert2.min.css'); ?>">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> -->
  <style>
    *{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    #sidebar {
      width: 250px;
      transition: width 0.3s ease;
    }
    #sidebar.collapsed {
      width: 70px;
    }
    #sidebar .nav-link span {
      transition: opacity 0.3s;
    }
    #sidebar.collapsed .nav-link span {
      opacity: 0;
    }
    #mainContent {
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }
    #sidebar.collapsed + #mainContent {
      margin-left: 70px;
    }

    #sidebar .nav-link {
    border-radius: 0.5rem;
    margin-bottom: 5px;
    padding: 8px 12px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #sidebar .nav-link:hover {
        background-color: rgba(255, 196, 0, 1); /* light transparent effect */
        transform: translateX(5px); /* slight movement to the right */
    }

    #sidebar .nav-link.active {
        background-color: #ffffff33; /* semi-transparent white for active */
    }

        /* When sidebar is collapsed */
    #sidebar.collapsed {
        width: 70px; /* or whatever width you set */
    }

    /* Hide the text but keep icons visible */
    #sidebar.collapsed .nav-link span {
        display: none;
    }

    /* Adjust button hover style in collapsed mode */
    #sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 10px;
        border-radius: 50%; /* make them icon-circle like */
        width: 45px;
        margin: 0 auto 10px;
    }

    /* Optional: refine hover to just background behind icon */
    #sidebar.collapsed .nav-link:hover {
        background-color: rgba(255, 196, 0, 1);
        transform: none; /* no movement when minimized */
    }


    .title-nav {
    cursor: pointer;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    color: white;
    position: relative;
    display: inline-block;
    background-image: linear-gradient(to right, orange 50%, white 50%);
    background-size: 200% 100%;
    background-position: right bottom;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: background-position 0.4s ease;
    }

    .title-nav:hover {
        background-position: left bottom;
    }
  </style>

</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div id="sidebar" class="bg-success text-white position-fixed h-100 collapsed">
    <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-secondary">

      <button id="burgerToggle" class="btn btn-outline-light btn-sm">
        <i class="bi bi-list"></i>
      </button>

    </div>
    <nav class="nav flex-column p-2">
      <a class="nav-link text-white d-flex align-items-center" href="/dashboard">
        <i class="bi bi-house-door-fill me-2"></i> <span>Home</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/admin/users">
        <i class="bi bi-people-fill me-2"></i> <span>Users</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/admin/users/rejected">
        <i class="bi bi-person-fill-slash me-2"></i> <span>Rejected Users</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/admin/users/pending">
        <i class="bi bi-person-fill-exclamation me-2"></i> <span>Pending Users</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/admin/sales">
        <i class="bi bi-receipt-cutoff me-2"></i> <span>Sales Report</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/admin/schedules">
        <i class="bi bi-clock me-2"></i> <span>Devices & Schedules</span>
      </a>
      <a class="nav-link text-white d-flex align-items-center" href="/logout">
        <i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span>
      </a>
    </nav>
  </div>

  <!-- Main Content -->
  <div id="mainContent" class="flex-grow-1">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm sticky-top">
  <div class="container-fluid align-items-center">
    <a class="navbar-brand d-flex align-items-center text-white fw-bold" href="/dashboard">
      <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" style="height: 40px; margin-right: 10px;">
      <span class="title-nav">Rai Rai Refugio Petshop</span>
    </a>
  </div>
</nav>


    <div class="container mt-2 mb-2 py-4 shadow-lg rounded">
        <!-- contents -->
      <?= $this->renderSection('content') ?>

    </div>
  </div>
</div>







<?php if(session()->getFlashdata('success')): ?>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success'); ?>',
                showConfirmButton: true,
            });
        });
        </script>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session()->getFlashdata('error'); ?>',
                showConfirmButton: true,
            });
        });
        </script>
        <?php endif; ?>

<!--SWEET ALERT  -->
<script src="<?= base_url('sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    


<!-- Bootstrap 5 JS -->
 <script src="<?= base_url("assets/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<!--<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
script for sidebar -->
<script>
  const toggleBtn = document.getElementById('burgerToggle');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
  });
</script>
</body>
</html>