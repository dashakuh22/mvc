<?php

include_once file_build_path(ROOT, 'models', 'FileModel.php');
include_once file_build_path(ROOT, 'controllers', 'TwigController.php');

class FileController
{

    public TwigController $twig;
    public FileModel $model;

    public string $fileError;

    public function __construct()
    {
        $this->model = new FileModel();
        $this->twig = new TwigController();
        $this->fileError = '';
    }

    public function actionIndex(): void
    {
        $this->fileError = '';
        $this->checkUploads();
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
        echo $this->twig->getAll($newData, $this->fileError);
    }

    public function checkUploads(): void
    {
        if (isset($_FILES['file'])) {
            $data = $this->getData();
            $this->fileError = $this->model->uploadFile($data['name'], $data['extension'], $data['size'], $data['tmp_name']);
            $this->model->updateLog($data['name'], $data['convertedSize'], $this->fileError);
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