<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <h1 class="mb-4"><?= e($post->title) ?></h1>
  <dl class="row">
    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9"><?= e($post->id) ?></dd>
    <dt class="col-sm-3">Content</dt>
    <dd class="col-sm-9"><?= nl2br(e($post->body)) ?></dd>
    <dt class="col-sm-3">Category</dt>
    <dd class="col-sm-9"><?= e($post->category) ?></dd>
    <dt class="col-sm-3">Author</dt>
    <dd class="col-sm-9"><?= e($post->author) ?></dd>
    <dt class="col-sm-3">Created</dt>
    <dd class="col-sm-9"><?= e($post->created_at) ?></dd>
    <dt class="col-sm-3">Updated</dt>
    <dd class="col-sm-9"><?= e($post->updated_at) ?></dd>
    <?php if ($post->image_path !== null): ?>
      <dt class="col-sm-3">Image</dt>
      <dd class="col-sm-9"><img class="img-fluid" src="<?= e($post->image_path) ?>" alt="<?= e($post->title) ?>" style="max-width: 640px"></dd>
    <?php endif; ?>
  </dl>
  <a class="btn btn-secondary" href="/admin/posts">Back to posts</a>
  <a class="btn btn-primary" href="/admin/posts/edit?id=<?= e($post->id) ?>">Edit post</a>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
