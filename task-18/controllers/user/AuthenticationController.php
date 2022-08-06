<?php

use App\models\UserModel;
use App\controllers\user\TwigController;

class AuthenticationController
{

    public const ATTEMPTS_COUNT = 3;

    public const BLOCK_TIME = 900;

    public array $error;

    public array $errors = [
        'success' => "Welcome back, ",
        'bad login' => 'Login is incorrect.',
        'bad attempts' => 'Only 3 attempts are allowed. Please, wait for 15 minutes.',
        'bad connection' => 'Check yor database params before using this app.',
    ];

    public TwigController $twig;

    public function __construct()
    {
        $this->error = [];
        $this->twig = new TwigController();
    }

    public function actionIndex(): void
    {
        $this->twig->getAuthentication();
        exit();
    }

    public function actionFail(): void
    {
        $this->error[] = $this->errors['bad connection'];
        $this->twig->getNotification(false, $this->error);
        exit();
    }

    public function actionLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!$this->isAttemptAvailable()) {
                $this->twig->getNotification(false, $this->error);
                exit();
            }

            if (isset($_SESSION['check_value']) && $_SESSION['check_value'] == $_POST['check_value']) {

                $data = $this->makeDataSecure($_POST);

                $_SESSION['email'] = $data['email'];
                $_SESSION['password'] = $data['password'];

                $userName = UserModel::getUserAttribute('first_name', $data['email'], $data['password']);
                $userID = UserModel::getUserAttribute('id', $data['email'], $data['password']);

                if (!empty($userName)) {
                    $this->error[] = $this->errors['success'] . $userName;
                    $this->twig->getNotification(true, $this->error);
                } else {
                    $this->error[] = $this->errors['bad login'];
                    $this->twig->getNotification(false, $this->error);
                }
                exit();

            } else {
                header('Location: /');
            }

        }
    }

    public function makeDataSecure(array $data): array
    {
        foreach ($data as $field => $value) {
            $data[$field] = $this->getSecure($value);
        }

        return $data;
    }

    public function getSecure(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function isAttemptAvailable(): bool
    {
        $userIP = $this->getIP();

        if (!isset($_SESSION['attempts'][$userIP])) {
            $_SESSION['attempts'][$userIP] = 0;
            $_SESSION['last_attempt_time'][$userIP] = time();
        }

        if ($this->isTooManyAttempts($userIP)) {

            if ($this->isIpBlocked($userIP)) {
                $this->error[] = $this->errors['bad attempts'];
                $this->error[] = 'Left time: ' . $this->getLeftMinutes($userIP) . ' minutes';
            } else {
                unset($_SESSION['attempts'][$userIP]);
            }

            return false;
        }

        $_SESSION['attempts'][$userIP]++;
        $_SESSION['last_attempt_time'][$userIP] = time();

        return true;
    }

    public function isTooManyAttempts(string $ip): bool
    {
        return $_SESSION['attempts'][$ip] >= self::ATTEMPTS_COUNT;
    }

    public function isIpBlocked(string $ip): bool
    {
        return (time() - $_SESSION['last_attempt_time'][$ip]) < self::BLOCK_TIME;
    }

    public function getLeftMinutes(string $ip): int
    {
        return (self::BLOCK_TIME - (time() - $_SESSION['last_attempt_time'][$ip])) / 60;
    }

    public function getIP(): string
    {
        $ip = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

}