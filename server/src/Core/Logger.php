<?php

namespace App\Core;

class Logger
{
    private $logFile;
    private $logLevel;
    private $logToFile;
    private $logToConsole;

    const LEVEL_INFO = 'INFO';
    const LEVEL_ERROR = 'ERROR';
    const LEVEL_DEBUG = 'DEBUG';

    public function __construct(
        $logFile,
        $logLevel = self::LEVEL_INFO,
        $logToFile = true,
        $logToConsole = false
    ) {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
        $this->logToFile = $logToFile;
        $this->logToConsole = $logToConsole;
    }

    public function log($message, $level = null)
    {
        $level = $level ?: $this->logLevel;

        $logEntry = sprintf(
            "[%s] [%s]: %s",
            date('Y-m-d H:i:s'),
            $level,
            $message
        );

        if ($this->logToFile) {
            file_put_contents($this->logFile, $logEntry . PHP_EOL, FILE_APPEND);
        }

        if ($this->logToConsole) {
            error_log($logEntry);
        }
    }

    // Специальные методы для разных уровней логирования
    public function info($message)
    {
        $this->log($message, self::LEVEL_INFO);
    }

    public function error($message)
    {
        $this->log($message, self::LEVEL_ERROR);
    }

    public function debug($message)
    {
        $this->log($message, self::LEVEL_DEBUG);
    }
}

/* class Logger
{
    private $logFile;
    private $logLevel;

    const LEVEL_INFO = 'INFO';
    const LEVEL_ERROR = 'ERROR';
    const LEVEL_DEBUG = 'DEBUG';

    public function __construct($logFile, $logLevel = self::LEVEL_INFO)
    {
        $this->logFile = $logFile;
        $this->logLevel = $logLevel;
    }

    public function log($message, $level = null)
    {
        $level = $level ?: $this->logLevel;

        $logEntry = sprintf(
            "[%s] [%s]: %s%s",
            date('Y-m-d H:i:s'),
            $level,
            $message,
            PHP_EOL
        );

        file_put_contents($this->logFile, $logEntry, FILE_APPEND);
    }

    public function info($message)
    {
        $this->log($message, self::LEVEL_INFO);
    }

    public function error($message)
    {
        $this->log($message, self::LEVEL_ERROR);
    }

    public function debug($message)
    {
        $this->log($message, self::LEVEL_DEBUG);
    }
}
 */