<?php $this->extend('layout/layout'); ?>

<?php $this->section('page_title') ?> Rai Rai Refugio Petshop <?php $this->endSection() ?>

<?php $this->section('body') ?>

<div class="container">
  <div class="card shadow-sm rounded-3 mx-auto">
    <div class="card-body">
      <div class="row g-4">
        
        <!-- Profile Picture -->
        <div class="col-md-4 text-center">
          <picture>
            <img src="uploads/users/<?= $user['photo'] ?>" 
                 class="rounded-circle border-success border border-3" 
                 style="width: 200px; height: 200px;" alt="">
          </picture>
          <div><strong>Profile Picture</strong></div>
        </div>

        <!-- Tabs + Forms -->
        <div class="col-md-8">
          <h5 class="fw-bold mb-4">Profile Settings</h5>

          <!-- Nav Tabs -->
          <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="view-tab" data-bs-toggle="tab" data-bs-target="#view" type="button" role="tab">View Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="update-tab" data-bs-toggle="tab" data-bs-target="#update" type="button" role="tab">Update Profile</button>
            </li>
          </ul>

          <!-- Tab Content -->
          <div class="tab-content pt-4" id="profileTabsContent">

            <!-- View Profile Tab -->
            <div class="tab-pane fade show active" id="view" role="tabpanel" aria-labelledby="view-tab">
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name:</label>
                <div class="col-sm-9">
                  <input type="text" readonly value="<?= ucfirst(esc($user['firstname'])) ?>" class="form-control-plaintext">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name:</label>
                <div class="col-sm-9">
                  <input type="text" readonly value="<?= ucfirst(esc($user['lastname'])) ?>" class="form-control-plaintext">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username:</label>
                <div class="col-sm-9">
                  <input type="text" readonly value="<?= esc($user['username']) ?>" class="form-control-plaintext">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password:</label>
                <div class="col-sm-9">
                  <input type="text" readonly value="*******" class="form-control-plaintext">
                </div>
              </div>
            </div>

            <!-- Update Profile Tab -->
            <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
              <form method="post" action="updateProfile/<?= $user['user_id'] ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" name="firstname" value="<?= esc($user['firstname']) ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" name="lastname" value="<?= esc($user['lastname']) ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" value="<?= esc($user['username']) ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">New Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                </div>
                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-success">Save Changes</button>
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
              </form>
            </div>

          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

<?php $this->endSection() ?>
