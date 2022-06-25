<?php

namespace App\Controller;

class UsersController
{
    private $authView;
    private $usersRepository;

    function __construct($authView, $usersRepository)
    {
        $this->authView = $authView;
        $this->usersRepository = $usersRepository;
    }

    public function SignIn($login, $password)
    {
        $user = $this->usersRepository->findUser($login);

        if ($user != null && $user->getPassword() == $password)
        {
            setcookie('user', json_encode($user));
            header('Location: /');
            return 'Загрузка...';
        }
        else
        {
            return 'Не верные логин или пароль!';
        }
    }

    public function SignUp($username, $password)
    {
        $this->usersRepository->addUser($username, $password);

        header('Location: /signIn');

        return $this->authView->showSignIn();
    }
}
