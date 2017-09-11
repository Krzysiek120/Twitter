<?php

namespace Cms\Controllers;

class UserController extends AbstractController 
{
    public function loginAction()
    {
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $stmt = $this->getDb()
            ->prepare('SELECT * FROM `Users` WHERE `userName`=:userName');
        $stmt->execute([
            ':userName' => $userName,
        ]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC); 
        
        if (empty($userName)) {
            $_SESSION['loginError'] = 'Please insert your login';
        } elseif (empty($password)) {
            $_SESSION['loginError'] = 'Please insert your password';
        } elseif (!$user['id']) {
            $_SESSION['loginError'] = 'Data insert is incorrect';
        } elseif (!password_verify($password, $user['hashPassword'])) {
            $_SESSION['loginError'] = 'Password is incorrect';
        } elseif (password_verify($password, $user['hashPassword'])){
            $_SESSION['userId'] = $user['id'];
        }
        
        header('location: index.php', 301);
        exit;
    }

    public function registerAction()
    {
        $email = $_POST['email'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->getDb()
            ->prepare("SELECT * FROM `Users` WHERE `userName`=:userName OR `email`=:email");
        $stmt->execute([
            ':userName' => $userName,
            ':email' => $email,
        ]);
        $userCount = $stmt->rowCount();

        if (empty($userName)) {
            $_SESSION['registerError'] = 'Please insert your login';
        } elseif ((strlen($userName) < 5) || strlen($userName > 15)) {
            $_SESSION['registerError'] = 'Login must have min. 5-15 signs';
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $userName)) {
          $_SESSION['registerError'] = 'Login should have only letters a-z and digits 0-9';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['registerError'] = 'Please insert correct email';
        } elseif (empty($password)) {
            $_SESSION['registerError'] = 'Please insert your password';
        } elseif ($password !== $password2) {
            $_SESSION['registerError'] = 'Passwords are different, please insert password again';
        } elseif ($userCount > 0) { 
            $_SESSION['registerError'] = 'This user already exists';
        } else {
            $_SESSION['registerSuccess'] = 'New account has been created';
        }

        if (!$_SESSION['registerError']) {
            $stmt = $this->getDb()
                ->prepare('INSERT INTO `Users` (`email`, `userName`, `hashPassword`) '
                    . 'VALUES (:email, :userName, :hashPassword)');
            $stmt->execute([
                ':email' => $email,
                ':userName' => $userName,
                ':hashPassword' => $hashPassword,
            ]);
        }
        
        header('location: index.php', 301);
        exit;
    }
} 

