<?php 
$this->extend('petshop/users/admin/layout/layout');
?>
<?php $this->section('title') ?> Admin Pendings <?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="container">
    <div class="container">
        <form action="" class="d-flex align-items-center form-group">
            <?= csrf_field() ?>
            <input type="text" name="search" placeholder="Search Users" class="form-control">
            <button class="btn btn-primary ms-2">Find</button>
        </form>
    </div>

    <?php if(session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3">
            <?= session()->getFlashdata('success') ?>
            <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
        </div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3">
            <?= session()->getFlashdata('error') ?>
            <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
        </div>
    <?php endif ?>

    <div class="container mt-5">
        <h4 class="text-warning">Pending Users</h4>
        <hr>

    <?php if(!empty($users)) : ?>
        <table class="table table-responsive text-center">
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
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u['firstname'] ?></td>
                    <td><?= $u['lastname'] ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= $u['contact'] ?></td>
                    <td><a style="text-decoration: none; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#img_<?= $u['photo'] ?>"><img src="uploads/users/<?= $u['photo'] ?>" width="50px" alt=""></a></td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#edit_<?= $u['user_id'] ?>" class="btn btn-success text-white"><i class="bi bi-person-fill-check fs-5"></i></button>
                        <button data-bs-toggle="modal" data-bs-target="#reject_<?= $u['user_id'] ?>" class="btn btn-danger"><i class="bi bi-person-fill-dash fs-5"></i></button>
                    </td>
                </tr>
            </tbody>

        <!-- USERS PROFILE PIC SHOW -->
            <div class="modal fade" id="img_<?= $u['photo'] ?>">
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

            <div class="modal fade" id="edit_<?= $u['user_id'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title text-white">Confirmation for User Approval</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="/admin/users/pending/approved/<?= $u['user_id'] ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $u['user_id'] ?>">
                                <h4 class="text-center text-success">Are You Sure You want to Approve this user?</h4>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success">Approve</button>
                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="reject_<?= $u['user_id'] ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title text-white">Confirmation for User Rejection</h4>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="/admin/users/pending/rejected/<?= $u['user_id']?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $u['user_id'] ?>">
                                <h4 class="text-center text-danger">Are You Sure You want to Reject this user?</h4>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger">Reject</button>
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