<?php

namespace App\Cores;

require_once '../app/cores/Helper.php';

class Controller
{
    private $db;

    public function __construct()
    {
        //
    }

    public function view($view, $data = [])
    {
        // Extract the data array into variables
        extract($data);

        // Include the view file
        require_once "../app/views/$view.php";
    }

    public function model($model)
    {
        $parts = explode('\\', $model);
        $modelClassName = end($parts);
        // Include the model file
        require_once "../app/models/$modelClassName.php";

        // Instantiate the model class
        return new $model();
    }
}
?>