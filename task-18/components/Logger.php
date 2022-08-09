<?php

namespace App\components;

use Monolog\Handler\StreamHandler;

class Logger
{

    private mixed $configs;
    private string $curDir;

    public function __construct()
    {
        $this->curDir = getcwd();
        $this->configs = require file_build_path($this->curDir, 'config', 'configDirectories.php');

        @mkdir(file_build_path($this->curDir, $this->configs['attacks_log']));
        @mkdir(file_build_path($this->curDir, $this->configs['uploads_log']));
        date_default_timezone_set('Europe/Minsk');
    }

    public function logFile(array $info): void
    {
        $log = new \Monolog\Logger('files');
        $file = file_build_path($this->curDir, $this->configs['files_log'], $this->getLogName('upload'));
        $log->pushHandler(new StreamHandler($file));
        $log->info('Upload', [
            'date' => $info['date'],
            'name' => $info['name'],
            'size' => $info['size'],
        ]);
    }

    public function logAttack(array $info): void
    {
        $log = new \Monolog\Logger('users');
        $file = file_build_path($this->curDir, $this->configs['attacks_log'], $this->getLogName('attack'));
        $log->pushHandler(new StreamHandler($file));
        $log->notice('Attack', [
            'userIP' => $info['ip'],
            'email' => $info['email'],
            'start' => $info['start'],
            'end' => $info['end'],
        ]);
    }

    public static function getLogName(string $file): string
    {
        return $file . '_' . date('dmY') . '.log';
    }

}