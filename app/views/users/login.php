<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h3>Login to RocketChat</h3>
                <form action="<?= URL_ROOT . '/users/login'; ?>" method="POST" id="login-form"class="mt-3">
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input id="register-email" type="email" name="email" class="form-control" value="<?= $data['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input id="register-password" type="password" name="password" class="form-control" value="<?= $data['password']; ?>">
                        <p id="password-length-error"></p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Submit" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="<?= URL_ROOT . '/users/register'; ?>" class="btn btn-light btn-block">Don't have an account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    document.querySelector('#login-form').addEventListener('submit', function (e) {
        const password = e.target.elements.password.value;
        if (password === '') {
            e.preventDefault();
            document.querySelector('#password-length-error').innerHTML = 'Please enter password';
        }
    })
</script>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>