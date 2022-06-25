<?php

namespace App\View;

class ContentView
{
    private $twig;

    function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function showTable($table)
    {
        return $this->twig->render('content.twig', ['table' => $table]);
    }
}
