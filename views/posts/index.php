<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Posts</h1>
    <a class="btn btn-primary" href="/admin/posts/create">New post</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Author</th>
          <th>Category</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post): ?>
          <tr>
            <td><?= e($post->id) ?></td>
            <td><?= e($post->title) ?></td>
            <td><?= e($post->author) ?></td>
            <td><?= e($post->category) ?></td>
            <td><?= e($post->created_at) ?></td>
            <td><?= e($post->updated_at) ?></td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-outline-primary" href="/admin/posts/view?id=<?= e($post->id) ?>">View</a>
              <a class="btn btn-sm btn-outline-secondary" href="/admin/posts/edit?id=<?= e($post->id) ?>">Edit</a>
              <form class="d-inline" action="/admin/posts/delete?id=<?= e($post->id) ?>" method="POST">
                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$posts): ?>
          <tr><td colspan="7" class="text-center">No posts found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
