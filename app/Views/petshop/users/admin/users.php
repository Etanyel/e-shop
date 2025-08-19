<?php 
$this->extend('petshop/users/admin/layout/layout');
?>
<?php $this->section('title') ?> Admin Users <?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="container">
    <div class="container">
        <form action="" class="d-flex align-items-center form-group">
            <?= csrf_field() ?>
            <input type="text" name="search" placeholder="Search Users" class="form-control">
            <button class="btn btn-primary ms-2">Find</button>
        </form>
    </div>

    <div class="container mt-5">
        <h4>Active Users</h4>
        <hr>

    <?php if(!empty($users)) : ?>
        <table class="table table-responsive text-center text-align-center">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Contact</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
        <?php $no = 1; foreach($users as $u):?>
            <tbody>
                <tr class="align-items-center">
                    <td><?= $no++ ?></td>
                    <td><?= $u['firstname'] ?></td>
                    <td><?= $u['lastname'] ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= $u['contact'] ?></td>
                    <td><a data-bs-target="#img<?= $u['photo'] ?>" data-bs-toggle="modal"  style="text-decoration: none; cursor: pointer;"><img src="uploads/users/<?= $u['photo'] ?>" width="50px" alt=""></a></td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#edit_<?= $u['firstname'] ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                        <button data-bs-toggle="modal" data-bs-target="#delete_<?= $u['firstname'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>

            <div class="modal fade" id="img<?= $u['photo'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white">User's Profile Picture</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="text-center p-2">
                                <img src="uploads/users/<?= $u['photo'] ?>" width="400" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit_<?= $u['firstname'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white">Update User</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="/admin/users/update/<?= $u['user_id'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="form-label">Firstname</label>
                                        <input type="text" name="" placeholder="Firstname Here" value="<?= htmlspecialchars($u['firstname']) ?>" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="form-label">Lastname</label>
                                        <input type="text" name="" placeholder="Lastname Here" value="<?= htmlspecialchars($u['lastname']) ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="" class="form-label">Username</label>
                                        <input type="text" name="" placeholder="Username Here" value="<?= htmlspecialchars($u['username']) ?>" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="form-label">Contact</label>
                                        <input type="number" name="" placeholder="Contact No. Here" value="<?= htmlspecialchars($u['contact']) ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <select name="role" value="" class="form-select">
                                        <option value="admin"  <?= 'admin' == $u['role'] ? 'selected' : '' ?>>Admin</option>
                                        <option value="employee" <?= 'employee' == $u['role'] ? 'selected' : '' ?>>Employee</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <input type="file" name="photo" id="" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary">Update</button>
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="delete_<?= $u['firstname'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="text-white">Confirmation for User's Deletion</h4>
                            <span class="btn btn-close"></span>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-danger text-center">Are you sure You want to remove this user? <br> This action cannot undone.</h4>
                        </div>
                        <form action="/admin/users/delete/<?= $u['user_id'] ?>" method="POST">
                            <?= csrf_field() ?> 
                            <input type="hidden" name="id" value="<?= $u['user_id'] ?>">
                            <div class="modal-footer">
                                <button class="btn btn-danger">Confirm</button>
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <?php else: ?>
            <p class="text-center container">No Active User Yet.</p>
    <?php endif ?>
        </table>
        
    </div>
</div>
<?php $this->endSection() ?>