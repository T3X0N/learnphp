<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <h1 class="mb-4">User #<?= e($user->id) ?></h1>

  <dl class="row">
    <dt class="col-sm-3">Name</dt>
    <dd class="col-sm-9"><?= e($user->name) ?></dd>

    <dt class="col-sm-3">Email</dt>
    <dd class="col-sm-9"><?= e($user->email) ?></dd>

    <dt class="col-sm-3">Password hash</dt>
    <dd class="col-sm-9"><code><?= e($user->password) ?></code></dd>
  </dl>

  <a class="btn btn-secondary" href="/admin/users">Back to users</a>
  <a class="btn btn-primary" href="/admin/users/edit?id=<?= e($user->id) ?>">Edit user</a>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
