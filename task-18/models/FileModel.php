<?php

namespace App\models;

use PNGMetadata\PNGMetadata;

class FileModel
{

    private mixed $configs;
    private string $curDir;
    private string $error;

    private array $errors = [
        'Ok' => 'This file has been uploaded successfully.',
        'Bad extension' => 'This file extension is not supported.',
        'Bad size' => 'This file size is too big.',
        'Bad file' => 'This file can\'t be uploaded.'
    ];

    private array $supported_extensions = [
        'image' => [
            'jpg', 'jpeg', 'gif', 'png', 'psd', 'ico',
        ],
        'text' => [
            'doc', 'docx', 'txt', 'tex', 'pdf', 'rtf'
        ]
    ];

    /** Use @ to suppress error messages **/
    public function __construct()
    {
        $this->configs = require_once file_build_path(ROOT, 'config', 'configDirectories.php');
        $this->error = '';
        $this->curDir = getcwd();
        @mkdir($this->curDir . $this->configs['files']);
        @mkdir($this->curDir . $this->configs['logs']);
        date_default_timezone_set('Europe/Minsk');
    }

    public function getFiles(): array
    {
        $files = scandir($this->curDir . $this->configs['files']);

        return array_diff($files, ['.', '..']);
    }

    public function uploadFile(string $name, string $extension, string $size, string $tempName): string
    {
        if ($this->checkFileExtension($extension)
            && $this->checkFreeSpace($size)
            && $this->checkFileIsUploaded($name, $tempName, $size, $extension)) {
            return $this->error = $this->errors['Ok'];
        }
        return $this->error;
    }

    public function updateLog(string $name, string $size, string $error): void
    {
        $date = date('d-m-Y');
        $time = date("H:i:s");
        $logFileName = $this->curDir . $this->configs['logs'] . 'upload_' . date('dmY') . '.log';
        $info = "
        Date: $date\n
        Time: $time\n
        File name: $name\n
        File size: $size\n
        File info: $error\n
        *****************\n";
        file_put_contents($logFileName, $info, FILE_APPEND);
    }

    public function checkFileExtension(string $fileExtension): bool
    {
        if (!$this->checkByType($fileExtension, 'image') &&
            !$this->checkByType($fileExtension, 'text')) {
            $this->error = $this->errors['Bad extension'];
            return false;
        }
        return true;
    }

    public function checkByType(string $fileExtension, string $type): bool
    {
        return in_array($fileExtension, $this->supported_extensions[$type]);
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

    public function checkFileIsUploaded(string $name, string $tempName, int $size, string $extension): bool
    {
        $destination = $this->createFileName($name, $size, $extension);
        if (!move_uploaded_file($tempName, $destination)) {
            $this->error = $this->errors['Bad file'];
            return false;
        }
        return true;
    }

    public function createFileName(string $name, int $size, string $extension): string
    {
        $id = str_replace('.', '', uniqid('', true));
        $type = $this->checkByType($extension, 'text') ? 'text' : 'image';

        return $this->curDir . $this->configs['files'] . $id . '.' . $name . '.' . $type . '.' . $size . '.' . $extension;
    }

    public function getEXIF(string $fileName, string $fileExtension): array|bool
    {
        if ($this->checkByType($fileExtension, 'image')) {
            if ($fileExtension === 'png') {
                return PNGMetadata::extract($this->curDir . $this->configs['files'] . $fileName)->toArray();
            }
            return @exif_read_data($this->curDir . $this->configs['files'] . $fileName);
        }
        return false;
    }

}