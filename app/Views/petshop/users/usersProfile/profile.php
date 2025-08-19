<?php $this->extend('layout/layout'); ?>

<?php $this->section('page_title') ?> Rai Rai Refugio Petshop <?php $this->endSection() ?>

<?php $this->section('body') ?>

<div class="container my-5">
  <div class="card shadow-sm rounded-3 mx-auto" style="max-width: 800px;">
    <div class="card-body">
      <div class="row g-4">
        
        <!-- Profile Picture -->
        <div class="col-md-4 text-center">
          <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" 
               style="width:100px; height:100px;">
            <i class="bi bi-person fs-1 text-white"></i>
          </div>
          <button class="btn btn-link mt-2">Edit Picture</button>
        </div>

        <!-- Form Section -->
        <div class="col-md-8">
          <h5 class="fw-bold mb-4">Profile Settings</h5>
          <form>
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" placeholder="Enter full name">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Enter password">
            </div>
            <div class="mb-3">
              <label class="form-label">Birthday</label>
              <input type="date" class="form-control">
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-success">Save Changes</button>
              <button type="button" class="btn btn-secondary">Cancel</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<?php $this->endSection() ?>