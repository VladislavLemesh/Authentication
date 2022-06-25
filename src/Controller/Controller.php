<?php

namespace App\Controller;

class Controller
{
    private $tableView;
    private $filmsRepository;

    function __construct($tableView, $filmsRepository)
    {
        $this->tableView = $tableView;
        $this->filmsRepository = $filmsRepository;
    }

    public function showTable()
    {
        $films = $this->filmsRepository->getAll();

        return $this->tableView->showTable($films);
    }
}
