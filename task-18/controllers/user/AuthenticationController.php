<?php

use App\components\Logger;
use App\models\UserModel;
use App\controllers\user\TwigController;

class AuthenticationController
{

    public const ATTEMPTS_COUNT = 3;

    public const BLOCK_TIME = 15 * 60;
    public const COOKIE_WEEK = 7 * 24 * 60 * 60;
    public const COOKIE_MINUTE = 60;

    public array $error;

    public array $errors = [
        'success' => "Welcome back, ",
        'bad login' => 'Login is incorrect.',
        'bad attempts' => 'Only 3 attempts are allowed. Please, wait for 15 minutes.',
        'bad connection' => 'Check yor database params before using this app.',
    ];

    public TwigController $twig;
    public UserModel $model;
    public Logger $logger;

    public function __construct()
    {
        $this->error = [];

        $this->logger = new Logger('attacks_log');
        $this->model = new UserModel();
        $this->twig = new TwigController();
    }

    public function actionIndex(): void
    {
        if (!isset($_COOKIE['userID'])) {
            $this->twig->getAuthentication();
            exit();
        } else {
            header('Location: /file-form');
        }
    }

    public function actionFail(): void
    {
        $this->error[] = $this->errors['bad connection'];
        $this->twig->getNotification(false, $this->error);
        exit();
    }

    public function actionLogout(): void
    {
        if (isset($_COOKIE['userID'])) {
            setcookie('userID', '', time() - self::COOKIE_WEEK);
        }
        header('Location: /');
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

                $userName = $this->model->getUserAttribute('first_name', $data['email'], $data['password']);
                $userID = $this->model->getUserAttribute('id', $data['email'], $data['password']);

                if (!empty($userName)) {

                    unset($_SESSION['attempts']);

                    if (isset($_POST['remember'])) {
                        setcookie('userID', $userID, time() + self::COOKIE_WEEK);
                    } else {
                        setcookie('userID', $userID, time() + self::COOKIE_MINUTE);
                    }

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
            $_SESSION['attempts'][$userIP] = 1;
            $_SESSION['block'][$userIP] = false;
            $_SESSION['last_attempt_time'][$userIP] = time();
        }

        if ($this->isTooManyAttempts($userIP)) {

            if ($this->isIpBlocked($userIP)) {
                $this->error[] = $this->errors['bad attempts'];
                $this->error[] = 'Left time: ' . $this->getLeftMinutes($userIP) . ' minutes';

                if (!$_SESSION['block'][$userIP]) {
                    $this->logger->notice('Attack', [
                        'ip' => $userIP,
                        'email' => $_POST['email'],
                        'start' => date('d-m-Y H:i:s', $this->getLastTimeAttempt($userIP)),
                        'end' => date('d-m-Y H:i:s', $this->getEndOfBlock($userIP))
                    ]);
                }

                $_SESSION['block'][$userIP] = true;

            } else {
                unset($_SESSION['attempts'][$userIP]);

                return true;
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
        return time() < $this->getEndOfBlock($ip);
    }

    public function getLastTimeAttempt(string $ip): int
    {
        return $_SESSION['last_attempt_time'][$ip];
    }

    public function getEndOfBlock(string $ip): int
    {
        return $_SESSION['last_attempt_time'][$ip] + self::BLOCK_TIME;
    }

    public function getLeftMinutes(string $ip): int
    {
        return $this->getMinutes($this->getEndOfBlock($ip) - time());
    }

    public function getMinutes(int $time): int
    {
        return ceil($time / 60);
    }

    public function getIP(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $_SERVER['REMOTE_ADDR'];
    }

}