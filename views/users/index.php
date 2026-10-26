<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Users</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= e($user->id) ?></td>
            <td><?= e($user->name) ?></td>
            <td><?= e($user->email) ?></td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-outline-primary" href="/admin/users/view?id=<?= e($user->id) ?>">View</a>
              <a class="btn btn-sm btn-outline-secondary" href="/admin/users/edit?id=<?= e($user->id) ?>">Edit</a>
              <form class="d-inline" action="/admin/users/delete?id=<?= e($user->id) ?>" method="POST">
                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$users): ?>
          <tr>
            <td colspan="4" class="text-center">No users found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
