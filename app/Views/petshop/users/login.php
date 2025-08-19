<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="assets/images/logo.png" type="image/png">
    <title>Rai Rai Refugio Petshop Login</title>

    <style>
        

        #registerbtn{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-2 mb-2">
        <?php if(session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show mt-3 mb-3">
                <?= session()->getFlashdata('success') ?>
                <span class="btn-close" data-bs-dismiss="alert"></span>
            </div>
        <?php endif ?>

        <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3">
            <?= session()->getFlashdata('error') ?>
            <button class="btn-close" data-bs-dismiss="alert" type="button"></button>
        </div>
    <?php endif ?>


        <form action="auth/login" method="POST" class="container shadow-lg px-4 py-2 mt-4 rounded" style="max-width: 400px;">
            <?= csrf_field() ?>
            <div class="text-center mb-4">
                <img src="assets/images/logo.png" width="200" alt="Pet Shop Logo" class="mb-2 rounded-circle">
                <h4 class="text-primary">Welcome to Rai Rai Refugio Petshop</h4>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username Here" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" id="password" class="form-control pass" placeholder="Password Here" required>
                        <span style="cursor: pointer" class="input-group-text" id="showbtn" onclick="showPass()"><i class="bi bi-eye"></i></span>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <a id="registerbtn" data-bs-toggle="modal" data-bs-target="#register" class="d-block text-center mt-2">Don't Have an Account? Register Here</a>
            </div>
        </form>
    </div>

    <script>
        function showPass()
        {
            const password = document.getElementById('password');

            if(password.type === 'password')
            {
                password.type = 'text';

            }else{
                password.type = 'password';
            }
        }
        
    </script>

    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="registerLabel">User Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/register" class="p-2" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="fname" placeholder="First Name Here" class="form-control">
                            </div>

                            <div class="col-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" placeholder="Last Name Here" class="form-control">
                        </div>
                        </div>

                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" placeholder="Username Here (For Login)" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" placeholder="Create Password" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" name="contact" placeholder="Contact Here" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" name="photo" placeholder="" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Register</button>
                        <span data-bs-dismiss="modal" class="btn btn-secondary">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
