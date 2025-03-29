<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    
    protected string $logFile;

    public function __construct()
    {
        $this->logFile = storage_path('logs/notifications.log');
    }

    public function notifications() 
    {
        if(!file_exists($this->logFile)) {
            return response(['status' => 404, 'message' => 'failed', 'error' => 'log file not found']);
        }

        $lines = array_reverse(file($this->logFile, FILE_IGNORE_NEW_LINES));

        $usersLogs = array_filter($lines, function ($line) use ($lines) {
            return \Str::between(str_contains($line, '"user":' . auth()->id()), ': ', ' {');
        });

        return view('admin.notifications', ['notifications' => array_values($usersLogs)]);
    }
    
}
