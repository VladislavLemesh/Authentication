<?php

namespace App\View;

class AuthenticationView
{
    private $twig;

    function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function showSignIn()
    {
        return $this->twig->render('signIn');
    }

    public function showSignUp()
    {
        return $this->twig->render('singUp.twig');
    }
}
