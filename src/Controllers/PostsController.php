<?php

namespace App\Controllers;

use App\Models\Post;
use RuntimeException;

class PostsController
{
    private const IMAGE_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    public function index(): void
    {
        $title = 'Posts';
        $posts = Post::all();
        view('posts/index', compact('title', 'posts'));
    }

    public function create(): void
    {
        $title = 'Create post';
        $post = new Post();
        $error = null;
        view('posts/create', compact('title', 'post', 'error'));
    }

    public function store(): void
    {
        $post = new Post();
        $this->fillPost($post);
        $error = $this->validatePost($post);
        if ($error !== null) {
            http_response_code(422);
            $title = 'Create post';
            view('posts/create', compact('title', 'post', 'error'));
            return;
        }

        $post->image_path = $this->uploadImage();
        $post->save();
        redirect('/admin/posts');
    }

    public function view(): void
    {
        $post = $this->requestedPost();
        if ($post === null) {
            $this->notFound();
            return;
        }

        $title = $post->title;
        view('posts/view', compact('title', 'post'));
    }

    public function edit(): void
    {
        $post = $this->requestedPost();
        if ($post === null) {
            $this->notFound();
            return;
        }

        $title = 'Edit post';
        $error = null;
        view('posts/edit', compact('title', 'post', 'error'));
    }

    public function update(): void
    {
        $post = $this->requestedPost();
        if ($post === null) {
            $this->notFound();
            return;
        }

        $this->fillPost($post);
        $error = $this->validatePost($post);
        if ($error !== null) {
            http_response_code(422);
            $title = 'Edit post';
            view('posts/edit', compact('title', 'post', 'error'));
            return;
        }

        $newImage = $this->uploadImage();
        if ($newImage !== null) {
            $oldImage = $post->image_path;
            $post->image_path = $newImage;
            $post->save();
            $this->removeImage($oldImage);
        } else {
            $post->save();
        }

        redirect('/admin/posts');
    }

    public function delete(): void
    {
        $post = $this->requestedPost();
        if ($post === null) {
            $this->notFound();
            return;
        }

        $image = $post->image_path;
        $post->delete();
        $this->removeImage($image);
        redirect('/admin/posts');
    }

    private function requestedPost(): ?Post
    {
        $rawId = $_GET['id'] ?? null;
        if (!is_string($rawId)) {
            return null;
        }

        $id = filter_var($rawId, FILTER_VALIDATE_INT);
        if ($id === false || $id === null || $id < 1) {
            return null;
        }

        return Post::find($id);
    }

    private function fillPost(Post $post): void
    {
        foreach (['title', 'body', 'author', 'category'] as $field) {
            $value = $_POST[$field] ?? '';
            $post->$field = is_string($value) ? trim($value) : '';
        }
    }

    private function validatePost(Post $post): ?string
    {
        if ($post->title === '' || $post->body === '' || $post->author === '' || $post->category === '') {
            return 'Title, content, author, and category are required.';
        }

        return null;
    }

    private function uploadImage(): ?string
    {
        $file = $_FILES['image'] ?? null;
        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            throw new RuntimeException('Image upload failed.');
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            throw new RuntimeException('Images must be no larger than 5 MB.');
        }

        $mimeType = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!is_string($mimeType) || !isset(self::IMAGE_TYPES[$mimeType])) {
            throw new RuntimeException('Upload a JPEG, PNG, GIF, or WebP image.');
        }

        $uploadDirectory = __DIR__ . '/../../public/uploads';
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
            throw new RuntimeException('Could not create the upload directory.');
        }

        $filename = bin2hex(random_bytes(16)) . '.' . self::IMAGE_TYPES[$mimeType];
        if (!move_uploaded_file($file['tmp_name'], $uploadDirectory . '/' . $filename)) {
            throw new RuntimeException('Could not save the uploaded image.');
        }

        return '/uploads/' . $filename;
    }

    private function removeImage(?string $imagePath): void
    {
        if ($imagePath === null || !preg_match('/\A\/uploads\/[a-f0-9]{32}\.(?:jpg|png|gif|webp)\z/', $imagePath)) {
            return;
        }

        $path = __DIR__ . '/../../public' . $imagePath;
        if (is_file($path) && !unlink($path)) {
            throw new RuntimeException('Could not remove the post image.');
        }
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}
