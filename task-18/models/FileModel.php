<?php

namespace App\models;

use PNGMetadata\PNGMetadata;
use ZipArchive;

class FileModel
{

    private mixed $configs;
    private string $curDir;
    private string $curFile;

    private string $archiveName;
    private string $archiveSize;

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
        $this->error = '';
        $this->configs = require_once file_build_path(ROOT, 'config', 'configDirectories.php');

        $this->curDir = getcwd();
        @mkdir(file_build_path($this->curDir, $this->configs['files']));
        @mkdir(file_build_path($this->curDir, $this->configs['files_log']));
        @mkdir(file_build_path($this->curDir, $this->configs['files_zip']));
        date_default_timezone_set('Europe/Minsk');
    }

    public function getFiles(): array
    {
        $files = scandir(file_build_path($this->curDir, $this->configs['files']));

        return array_diff($files, ['.', '..']);
    }

    public function getFileError(): string
    {
        return $this->error;
    }

    public function isFileUploaded(string $name, string $extension, string $size, string $tempName): bool
    {
        if ($this->checkFileExtension($extension)
            && $this->checkFreeSpace($size)
            && $this->checkFileIsUploaded($name, $tempName, $size, $extension)) {

            $this->archiveFile();
            $this->updateLog(implode('.', [$name, $extension]), $size);
            $this->error = $this->errors['Ok'];

            return true;
        }
        return false;
    }

    public function updateLog(string $name, string $size): void
    {
        $date = date("d-m-Y H:i:s");
        $logFile = file_build_path($this->curDir, $this->configs['files_log'], $this->getLogName());
        $info = "$date : $name - $size - $this->archiveName - $this->archiveSize\n";

        file_put_contents($logFile, $info, FILE_APPEND);
    }

    public function getLogName(): string
    {
        return 'upload_' . date('dmY') . '.log';
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
        $this->curFile = $this->createFileName($name, $size, $extension);
        if (!move_uploaded_file($tempName, $this->createFilePath($this->curFile))) {
            $this->error = $this->errors['Bad file'];

            return false;
        }
        return true;
    }

    public function archiveFile(): void
    {
        $this->archiveName = $this->curFile . '.zip';

        $archive = new ZipArchive();

        if ($archive->open(file_build_path($this->curDir, $this->configs['files_zip'], $this->archiveName),
            ZipArchive::CREATE)) {

            $archive->addFile(file_build_path(ROOT, $this->configs['files'], $this->curFile));
            $archive->close();
        }

        //unlink(file_build_path(ROOT, $this->configs['files'], $this->curFile));

        if ($archive->open(file_build_path($this->curDir, $this->configs['files_zip'], $this->archiveName))) {

            $stat = $archive->statIndex(0);
            $this->archiveSize = $stat['comp_size'];
            $archive->close();

        }

    }

    public function createFilePath(string $name): string
    {
        return file_build_path($this->curDir, $this->configs['files'], $name);
    }

    public function createFileName(string $name, int $size, string $extension): string
    {
        $id = str_replace('.', '', uniqid('', true));
        $type = $this->checkByType($extension, 'text') ? 'text' : 'image';

        return implode('.', [$id, $name, $type, $size, $extension]);
    }

    public function getEXIF(string $fileName, string $fileExtension): array|bool
    {
        if ($this->checkByType($fileExtension, 'image')) {
            if ($fileExtension === 'png') {
                return PNGMetadata::extract(file_build_path($this->curDir, $this->configs['files'], $fileName))->toArray();
            }
            return @exif_read_data(file_build_path($this->curDir, $this->configs['files'], $fileName));
        }
        return false;
    }

}