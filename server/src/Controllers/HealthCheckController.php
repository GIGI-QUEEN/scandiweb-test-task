<?php

namespace App\Controllers;

class HealthCheckController
{
    public function index()
    {
        echo json_encode(["status" => "ok"]);
    }
}
