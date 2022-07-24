<?php

namespace App\Models;

class FileModel {

    private $configs;
    private string $curDir;
    private string $error;

    private array $errors = [
        'Ok' => 'Congratulations! File Uploaded Successfully.',
        'Bad extension' => 'This file extension is not supported.',
        'Bad size' => 'This file size is too big.',
        'Bad file' => 'This file can\'t be uploaded.'
    ];

    private array $supported_extensions = [
        'jpg', 'jpeg', 'gif', 'png', 'psd', 'ico',
        'doc', 'docx', 'txt', 'tex', 'pdf', 'rtf'
    ];

    /** Use @ to ignore error messages **/
    public function __construct()
    {
        $this->configs = require_once file_build_path(ROOT, 'configs', 'configDirectories.php');
        $this->error = '';
        $this->curDir = getcwd();
        @mkdir($this->curDir . $this->configs['files']);
        @mkdir($this->curDir . $this->configs['logs']);

    }

    public function getFiles(): array
    {
        $files = scandir($this->curDir . $this->configs['files']);
        return $files;
    }

    public function getLogs(): array
    {
        $logs = scandir($this->curDir . $this->configs['logs']);
        return $logs;
    }

    public function uploadFile(string $extension, string $size, string $tempName): string
    {
        if ($this->checkFileExtension($extension)
            && $this->checkFreeSpace($size)
            && $this->checkFileIsUploaded($tempName, $extension)) {
            return $this->error = $this->errors['Ok'];
        }
        return $this->error;
    }

    public function updateLog(string $name, string $size, string $error): void
    {
        $date = date('d-m-Y');
        $time = date("h:i:s");
        $logFileName = $this->curDir . $this->configs['logs'] . 'upload_' . date('dmY') . '.log';
        $info = "Date: $date\nTime: $time\nFile name: $name\nFile size: $size\nFile error: $error\n*****************\n";
        file_put_contents($logFileName, $info, FILE_APPEND);
    }

    public function checkFileExtension(string $fileExtension): bool
    {
        if (!in_array($fileExtension, $this->supported_extensions)) {
            $this->error = $this->errors['Bad extension'];
            return false;
        }
        return true;
    }

    public function checkFreeSpace(string $fileSize): bool
    {
        $space = disk_free_space($this->curDir);
        if ($fileSize > $space) {
            $this->error = $this->errors['Bad size'];
            return false;
        }
        return true;
    }

    public function checkFileIsUploaded(string $tempName, string $extension): bool
    {
        $destination = $this->curDir . $this->configs['files'] . uniqid('', true) . '.' . $extension;
        if (!move_uploaded_file($tempName, $destination)) {
            $this->error = $this->errors['Bad file'];
            return false;
        }
        return true;
    }

}