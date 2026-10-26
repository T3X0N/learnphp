<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function index(): void
    {
        $title = 'Users';
        $users = User::all();
        view('users/index', compact('title', 'users'));
    }

    public function view(): void
    {
        $user = $this->requestedUser();
        if ($user === null) {
            $this->notFound();
            return;
        }

        $title = 'User';
        view('users/view', compact('title', 'user'));
    }

    public function edit(): void
    {
        $user = $this->requestedUser();
        if ($user === null) {
            $this->notFound();
            return;
        }

        $title = 'Edit user';
        $error = null;
        view('users/edit', compact('title', 'user', 'error'));
    }

    public function update(): void
    {
        $user = $this->requestedUser();
        if ($user === null) {
            $this->notFound();
            return;
        }

        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $user->name = is_string($name) ? trim($name) : '';
        $user->email = is_string($email) ? trim($email) : '';
        if ($user->name === '' || !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            $title = 'Edit user';
            $error = 'Enter a name and a valid email address.';
            view('users/edit', compact('title', 'user', 'error'));
            return;
        }

        $user->save();
        redirect('/admin/users');
    }

    public function delete(): void
    {
        $user = $this->requestedUser();
        if ($user === null) {
            $this->notFound();
            return;
        }

        $user->delete();
        redirect('/admin/users');
    }

    private function requestedUser(): ?User
    {
        $rawId = $_GET['id'] ?? null;
        if (!is_string($rawId)) {
            return null;
        }

        $id = filter_var($rawId, FILTER_VALIDATE_INT);
        if ($id === false || $id === null || $id < 1) {
            return null;
        }

        return User::find($id);
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }
}
