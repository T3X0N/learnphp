<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function registerForm(): void
    {
        $title = 'Register';
        $error = null;
        $name = '';
        $email = '';
        view('auth/register', compact('title', 'error', 'name', 'email'));
    }

    public function register(): void
    {
        $name = $this->postString('name');
        $email = $this->postString('email');
        $password = $this->postString('password');
        $passwordConfirm = $this->postString('password_confirm');

        $title = 'Register';
        $error = null;
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Enter your name and a valid email address.';
        } elseif (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters long.';
        } elseif ($password !== $passwordConfirm) {
            $error = 'The passwords do not match.';
        } elseif (User::where('email', $email)) {
            $error = 'An account with that email already exists.';
        }

        if ($error !== null) {
            http_response_code(422);
            view('auth/register', compact('title', 'error', 'name', 'email'));
            return;
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        redirect('/login');
    }

    public function loginForm(): void
    {
        $title = 'Login';
        $error = null;
        $email = '';
        view('auth/login', compact('title', 'error', 'email'));
    }

    public function login(): void
    {
        $email = $this->postString('email');
        $password = $this->postString('password');
        $users = User::where('email', $email);
        $user = $users[0] ?? null;

        if ($user === null) {
            http_response_code(422);
            $title = 'Login';
            $error = 'The email or password is incorrect.';
            view('auth/login', compact('title', 'error', 'email'));
            return;
        }

        $passwordMatches = password_verify($password, $user->password);
        if (!$passwordMatches) {
            $legacyPasswords = [
                $user->name . $email . $password . md5('yolo'),
                $user->name . $email . $password,
            ];
            foreach ($legacyPasswords as $legacyPassword) {
                if (password_verify($legacyPassword, $user->password)) {
                    $passwordMatches = true;
                    $user->password = password_hash($password, PASSWORD_DEFAULT);
                    $user->save();
                    break;
                }
            }
        }

        if (!$passwordMatches) {
            http_response_code(422);
            $title = 'Login';
            $error = 'The email or password is incorrect.';
            view('auth/login', compact('title', 'error', 'email'));
            return;
        }

        session_regenerate_id(true);
        $_SESSION['userID'] = $user->id;
        redirect('/');
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $cookie = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }
        session_destroy();
        redirect('/');
    }

    private function postString(string $field): string
    {
        $value = $_POST[$field] ?? '';
        return is_string($value) ? trim($value) : '';
    }
}
