<?php

use App\controllers\TwigController;
use App\models\UserModel;

class UserController
{

    public array $error;

    public array $errors = [
        'success' => 'You have successfully registered!',
        'bad user' => 'This email has already used.',
        'bad email' => 'Check your email for correctness.',
        'bad first name' => 'Check your first name for correctness.',
        'bad last name' => 'Check your last name for correctness.',
        'bad password' => 'Check your password for correctness.',
        'bad connection' => 'Check yor database params before using this app.',
        'wrong email' => 'The email confirmation does\'t match.',
        'wrong password' => 'The password confirmation does\'t match.',
    ];

    public const PASSWORD_INFO = "Your password should have at least:<ul>
                       <li>1 digit</li><li>1 small character</li><li>1 capital character</li>
                       <li>1 special character</li><li>be >= 6 characters long</li></ul>";

    public TwigController $twig;

    public function __construct()
    {
        $this->error = [];
        $this->twig = new TwigController();
    }

    public function actionIndex(): void
    {
        $this->twig->getIndex();
        exit();
    }

    public function actionFail(): void
    {
        $this->error[] = $this->errors['bad connection'];
        $this->twig->getFail($this->error);
        exit();
    }

    public function actionRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_SESSION['check_value']) && $_POST['check_value'] == $_SESSION['check_value']) {

                $data = $this->makeDataSecure($_POST);

                $_SESSION['email'] = $data['email'];
                $_SESSION['first_name'] = $data['first_name'];
                $_SESSION['last_name'] = $data['last_name'];

                $isRegistered = $this->registration($data);
                $this->twig->getResult($isRegistered, $this->error,
                    $_SESSION['email'], $_SESSION['first_name'], $_SESSION['last_name']);
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

    public function registration(array $data): bool
    {

        $this->checkEmail($data['email'], $data['confirm_email']);
        $this->checkFirstName($data['first_name']);
        $this->checkLastName($data['last_name']);
        $this->checkPassword($data['password'], $data['confirm_password']);

        if (empty($this->error)) {
            UserModel::addUser($data['email'], $data['first_name'], $data['last_name'], $data['password']);
            $_SESSION['email'] = '';
            $_SESSION['first_name'] = '';
            $_SESSION['last_name'] = '';
            $this->error[] = $this->errors['success'];

            return true;
        }

        return false;
    }

    public function checkEmail(string $email, string $confirmEmail): void
    {
        if (!$this->checkEmailValidation($email)) {
            $this->error[] = $this->errors['bad email'];
            $_SESSION['email'] = '';
            return;
        }

        if (UserModel::getUserByEmail($email)) {
            $this->error[] = $this->errors['bad user'];
            $_SESSION['email'] = '';
            return;
        }

        if ($email !== $confirmEmail) {
            $this->error[] = $this->errors['wrong email'];
            $_SESSION['email'] = '';
        }
    }

    public function checkEmailValidation(string $email): string
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function checkFirstName(string $firstName): void
    {
        if (!$this->checkNameValidation($firstName)) {
            $this->error[] = $this->errors['bad first name'];
            $_SESSION['first_name'] = '';
        }
    }

    public function checkLastName(string $lastName): void
    {
        if (!$this->checkNameValidation($lastName)) {
            $this->error[] = $this->errors['bad last name'];
            $_SESSION['last_name'] = '';
        }
    }

    public function checkNameValidation(string $name): string
    {
        $name = ucfirst($name);
        return preg_match('@^[A-z]*$@', $name);
    }

    public function checkPassword(string $password, string $confirmPassword): void
    {
        if (!$this->checkPasswordValidation($password)) {
            $this->error[] = $this->errors['bad password'];
            return;
        }

        if ($password !== $confirmPassword) {
            $this->error[] = $this->errors['wrong password'];
            $_SESSION['password'] = '';
        }
    }

    public function checkPasswordValidation(string $password): bool
    {
        return preg_match('@\d@', $password) && preg_match('@\W@', $password)
            && preg_match('@[A-ZА-Я]@', $password) && preg_match('@[a-zа-я]@', $password)
            && !preg_match('@\s@', $password) && strlen($password) >= 6;
    }

}