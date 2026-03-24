<?php

namespace App\Cores;
class Controller
{
    public function __construct()
    {
        // echo "Controller class is loaded.";
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
        // Include the model file
        require_once "../app/models/$model.php";

        // Instantiate the model class
        return new $model();
    }
}
?>