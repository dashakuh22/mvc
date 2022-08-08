<?php

use App\models\FileModel;
use App\controllers\file\TwigController;

class FileController
{

    public TwigController $twig;
    public FileModel $model;

    public array $fileError;
    public bool $isFileUploaded;

    public function __construct()
    {
        $this->model = new FileModel();
        $this->twig = new TwigController();
        $this->fileError = [];
        $this->isFileUploaded = false;
    }

    public function actionIndex(): void
    {
        if (isset($_COOKIE['userID'])) {

            if (isset($_SESSION['check_value']) && isset($_POST['check_value'])
                && $_POST['check_value'] == $_SESSION['check_value']) {
                $this->checkUploads();
            }

            $data = $this->model->getFiles();
            $newData = [];

            foreach ($data as $file) {
                $info = explode('.', $file);
                $newData[] = [
                    'id' => $info[0],
                    'name' => $info[1],
                    'fullName' => $file,
                    'type' => $info[2],
                    'size' => $this->getConvertedSize($info[3]),
                    'extension' => $info[4],
                    'meta' => $this->getFlattenArray($this->model->getEXIF($file, $info[4]))
                ];
            }
            $this->twig->getFiles($newData, $this->fileError, $this->isFileUploaded);
            exit();

        } else {
            header('Location: /');
        }
    }

    public function checkUploads(): void
    {
        if (isset($_FILES['file'])) {
            $data = $this->getData();
            $this->isFileUploaded = $this->model->isFileUploaded(
                $data['name'], $data['extension'], $data['size'], $data['tmp_name']
            );
            $this->fileError[] = $this->model->getFileError();
        }
    }

    public function getData(): array
    {
        return [
            'name' => $this->getName($_FILES['file']['name']),
            'size' => $_FILES['file']['size'],
            'type' => $_FILES['file']['type'],
            'error' => $_FILES['file']['error'],
            'tmp_name' => $_FILES['file']['tmp_name'],
            'extension' => $this->getExtension($_FILES['file']['name']),
            'convertedSize' => $this->getConvertedSize($_FILES['file']['size'])
        ];
    }

    public function getName(string $fileName): string
    {
        $file = explode('.', $fileName);

        return strtolower($file[0]);
    }

    public function getConvertedSize(int $fileSize): string
    {
        $prefix = 0;
        while ($fileSize >= 1024) {
            $fileSize = round($fileSize / 1024, 2);
            $prefix++;
        }

        return match ($prefix) {
            0 => "$fileSize b",
            1 => "$fileSize kb",
            2 => "$fileSize mb",
            3 => "$fileSize gb",
            default => $fileSize,
        };
    }

    public function getExtension(string $fileName): string
    {
        $file = explode('.', $fileName);

        return strtolower(end($file));
    }

    public function getFlattenArray(array|bool $items, array $flattened = []): array
    {
        if (is_array($items)) {
            foreach ($items as $item => $value) {
                if (is_array($value)) {
                    $flattened = $this->getFlattenArray($value, $flattened);
                    continue;
                }
                $flattened[$item] = $value;
            }
        }
        return $flattened;
    }

}