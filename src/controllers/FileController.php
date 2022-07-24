<?php

use App\Controllers\TwigController;
use App\Models\FileModel;

class FileController {

    public int $fileSize;
    public string $fileName;
    public string $fileType;
    public string $fileError;
    public string $fileExtension;

    public DateTime $fileDate;
    public DateTime $fileTime;

    public TwigController $twig;
    public FileModel $model;

    public function __construct()
    {
        $this->model = new FileModel();
        $this->twig = new TwigController();
    }

    public function actionIndex(): void
    {
        $data = $this->model->getFiles();
        $data = array_diff($data, ['.', '..']);
        echo $this->twig->getAll($data);
    }

    public function actionUpload(): void
    {
        if (isset($_FILES['file'])) {
            $data = $this->getData();
            $error = $this->model->uploadFile($data['extension'], $data['size'], $data['tmp_name']);
            $this->model->updateLog($data['name'], $data['convertedSize'], $error);
        }
//        print_r($data);
//        echo $this->twig->isUploaded($error);
  //      header('Location: /');
    }

    public function getData(): array
    {
        return [
            'name' => $_FILES['file']['name'],
            'size' => $_FILES['file']['size'],
            'type' => $_FILES['file']['type'],
            'error' => $_FILES['file']['error'],
            'tmp_name' => $_FILES['file']['tmp_name'],
            'extension' => $this->getExtension($_FILES['file']['name']),
            'convertedSize' => $this->getConvertedSize($_FILES['file']['size'])
        ];
    }

    public function getConvertedSize(int $fileSize): string
    {
        $prefix = 0;
        while ($fileSize >= 1024) {
            $fileSize = round($fileSize / 1024, 2);
            $prefix++;
        }
        switch ($prefix) {
            case 0: return "$fileSize b";
            case 1: return "$fileSize kb";
            case 2: return "$fileSize mb";
            case 3: return "$fileSize gb";
        }
        return $fileSize;
    }

    public function getExtension(string $fileName): string
    {
        $file = explode('.', $fileName);
        return strtolower(end($file));
    }

}