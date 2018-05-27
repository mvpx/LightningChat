<?php require_once APP_ROOT . '/views/includes/header.php'; ?>

  <div class="jumbotron bg-white">
    <h2>Welcome to LightningChat</h2>
    <p class="lead">A very very simple chat application</p>
    <p class="lead">
      <a class="btn btn-primary" href="<?= URL_ROOT . '/users/register'; ?>" role="button">Register</a>
      <a class="btn btn-success" href="<?= URL_ROOT . '/users/login'; ?>" role="button">Login</a>
    </p>
  </div>

<?php require_once APP_ROOT . '/views/includes/footer.php'; ?>