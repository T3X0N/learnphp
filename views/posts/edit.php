<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="container">
  <h1 class="mb-4">Edit post #<?= e($post->id) ?></h1>
  <?php if ($error !== null): ?>
    <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
  <?php endif; ?>
  <form action="/admin/posts/edit?id=<?= e($post->id) ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label" for="title">Title</label>
      <input class="form-control" id="title" name="title" type="text" value="<?= e($post->title) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="body">Content</label>
      <textarea class="form-control" id="body" name="body" rows="5" required><?= e($post->body) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label" for="category">Category</label>
      <input class="form-control" id="category" name="category" type="text" value="<?= e($post->category) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="author">Author</label>
      <input class="form-control" id="author" name="author" type="text" value="<?= e($post->author) ?>" required>
    </div>
    <?php if ($post->image_path !== null): ?>
      <div class="mb-3">
        <p>Current image</p>
        <img class="img-thumbnail mb-2" src="<?= e($post->image_path) ?>" alt="" style="max-width: 240px">
      </div>
    <?php endif; ?>
    <div class="mb-3">
      <label class="form-label" for="image">Replace image (optional, max 5 MB)</label>
      <input class="form-control" id="image" name="image" type="file" accept="image/jpeg,image/png,image/gif,image/webp">
    </div>
    <button class="btn btn-primary" type="submit">Save changes</button>
    <a class="btn btn-secondary" href="/admin/posts">Cancel</a>
  </form>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
