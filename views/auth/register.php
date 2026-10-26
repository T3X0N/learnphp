<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <h1 class="mb-4">Register</h1>
  <?php if ($error !== null): ?>
    <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
  <?php endif; ?>
  <form action="/register" method="POST">
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control" id="name" name="name" type="text" value="<?= e($name) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control" id="email" name="email" type="email" value="<?= e($email) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input class="form-control" id="password" name="password" type="password" minlength="8" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password_confirm">Confirm password</label>
      <input class="form-control" id="password_confirm" name="password_confirm" type="password" minlength="8" required>
    </div>
    <button class="btn btn-primary" type="submit">Register</button>
  </form>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
