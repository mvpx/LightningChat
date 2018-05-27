<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h4>Join LightningChat</h4>
                <form action="<?= URL_ROOT . '/users/register'; ?>" method="POST" id="register-form" class="mt-3">
                    <div class="form-group">
                        <label for="register-name">Name</label>
                        <input  id="register-name" type="text" name="name" class="form-control" value="<?= $data['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input id="register-email" type="email" name="email" class="form-control" value="<?= $data['email']; ?>">
                        <p><?= $data['email_error']; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input id="register-password" type="password" name="password" class="form-control" value="<?= $data['password']; ?>">
                        <p id="password-length-error"></p>
                    </div>
                    <div class="form-group">
                        <label for="register-confirm-password">Confirm Password</label>
                        <input id="register-confirm-password" type="password" name="confirm_password" class="form-control">
                        <p id="password-confirm-error"></p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Submit" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?= URL_ROOT . '/users/login'; ?>" class="btn btn-light btn-block">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>

    document.querySelector('#register-form').addEventListener('submit', function (e) {
        const password = e.target.elements.password.value;
        const confirmPassword = e.target.elements.confirm_password.value;

        if (password === '') {
            e.preventDefault();
            document.querySelector('#password-length-error').innerHTML = 'Please enter password';
        } else if (password.length < 6) {
            e.preventDefault();
            document.querySelector('#password-length-error').innerHTML = 'Password must have more than 6 characters'
        } else if (confirmPassword === '') {
            e.preventDefault();
            document.querySelector('#password-confirm-error').innerHTML = 'Please re-enter password';
        } else if (password !== confirmPassword) {
            e.preventDefault();
            document.querySelector('#password-confirm-error').innerHTML = 'Passwords do not match.'
        }
    })

</script>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>