<?php

require file_build_path(ROOT, 'components', 'REST.php');

class UserModel
{
    private array $optionValue = [
        'receive' => [
            'Content-Type: application/json'
        ],
        'accept' => [
            'Accept: application/json',
            'Content-Type: application/json'
        ]
    ];

    public function getUser(int $id): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "GET", $id);
        curl_close($curl_handle);

        return $response;
    }

    public function getUserList(int $pageIndex): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptionsAndPage($curl_handle, "GET", $pageIndex);
        curl_close($curl_handle);

        return $response;
    }

    public function addUser(array $data): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "POST", -1, $data);
        curl_close($curl_handle);

        return $response;
    }

    public function editUser(int $id, array $data): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "PUT", $id, $data);
        curl_close($curl_handle);

        return $response;
    }

    public function deleteUser(int $id): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "DELETE", $id);
        curl_close($curl_handle);
        return $response;
    }

    public function getCurlByOptionsAndPage(CurlHandle $curl, string $action, int $pageIndex = 1): string
    {
        $url = REST::getConfigs('url') . "?page=" . $pageIndex . "&access-token=" . REST::getConfigs('token');

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $action);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->optionValue['receive']);

        return curl_exec($curl);
    }

    public function getCurlByOptions(CurlHandle $curl, string $action, int $id = -1, array $data = []): string
    {
        $url = $id < 0
            ? REST::getConfigs('url') . "?access-token=" . REST::getConfigs('token')
            : REST::getConfigs('url') . "/$id?access-token=" . REST::getConfigs('token');

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $action);

        switch ($action) {
            case 'DELETE':
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->optionValue['receive']);
                break;
            case 'GET':
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->optionValue['accept']);
                break;
            case 'POST':
            case 'PUT':
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->optionValue['accept']);
                break;
        }
        return curl_exec($curl);
    }

}