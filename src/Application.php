<?php

namespace App;

use App\Controller\Controller;
use App\Controller\UsersController;
use App\DI\ServiceLocator;
use App\Repository\Connection;
use App\Repository\NamesRepository;
use App\Repository\UsersRepository;
use App\View\AuthenticationView;
use App\View\ContentView;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Application
{
    private $serviceLocator;

    function __construct()
    {
        $this->serviceLocator = $this->InitServices();
    }

    public function InitServices()
    {
        $serviceLocator = new ServiceLocator();

        $serviceLocator->set('twig',
            new Environment(
                new FilesystemLoader(dirname(__DIR__) . '/templates')));

        $config = include('config.php');
        $connection = new Connection(
            $config['dbHost'],
            $config['dbName'],
            $config['dbUsername'],
            $config['dbPassword']
        );
        $serviceLocator->set(UsersController::class,
            new UsersController(
                new AuthenticationView($serviceLocator->get('twig')),
                new UsersRepository($connection)));

        $serviceLocator->set(Controller::class,
            new Controller(
                new ContentView($serviceLocator->get('twig')),
                new NamesRepository($connection)));

        return $serviceLocator;
    }

    public function run()
    {
        if ($_COOKIE['user'] != null)
        {
            if ($_GET['action'] === 'logout')
            {
                unset($_COOKIE['user']);

                setcookie('user', '', time() - 3600, '/');

                header('Location: /signIn');

                return $this->serviceLocator->Get('twig')->render('signIn.twig');
            }

            return $this->serviceLocator->Get(Controller::class)->showTable();
        }

        if ($_SERVER['REQUEST_URI'] === '/signIn')
        {
            if (empty($_POST))
            {
                return $this->serviceLocator->get('twig')->render('signIn.twig');
            }
            return $this->serviceLocator->get(UsersController::class)->SignIn($_POST['username'], $_POST['password']);
        }

        if ($_SERVER['REQUEST_URI'] === '/signUp')
        {
            if (empty($_POST))
            {
                return $this->serviceLocator->get('twig')->render('signUp.twig');
            }
            return $this->serviceLocator->get(UsersController::class)->SignUp($_POST['username'], $_POST['password']);
        }

        header('Location: /signIn');
        return $this->serviceLocator->get('twig')->render('signIn.twig');
    }
}
