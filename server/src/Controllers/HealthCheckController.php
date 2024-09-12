<?php

namespace App\Controllers;

class HealthCheckController
{
    public function handle()
    {
        http_response_code(200);
        echo json_encode([
            'status' => 'OK',
            'message' => 'API is healthy'
        ]);
    }
}
