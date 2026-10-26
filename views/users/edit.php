<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <h1 class="mb-4">Edit user #<?= e($user->id) ?></h1>

  <?php if ($error !== null): ?>
    <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
  <?php endif; ?>

  <form action="/admin/users/edit?id=<?= e($user->id) ?>" method="POST">
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control" id="name" name="name" type="text" value="<?= e($user->name) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control" id="email" name="email" type="email" value="<?= e($user->email) ?>" required>
    </div>
    <button class="btn btn-primary" type="submit">Save changes</button>
    <a class="btn btn-secondary" href="/admin/users">Cancel</a>
  </form>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
