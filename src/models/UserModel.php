<?php

require file_build_path(ROOT, 'components', 'REST.php');

class UserModel
{
    private REST $rest;

    public function __construct()
    {
        $this->rest = new REST();
    }

    public function getUser(int $id): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "GET", $id);
        curl_close($curl_handle);

        return $response;
    }

    public function getUserList(): string
    {
        $curl_handle = curl_init();
        $response = $this->getCurlByOptions($curl_handle, "GET");
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

    public function getCurlByOptions(CurlHandle $curl, string $action, int $id = -1, array $data = []): string
    {
        $url = $id < 0 ? $this->rest->getURL() . "?access-token=" . $this->rest->getToken() :
                         $this->rest->getURL() . "/$id?access-token=" . $this->rest->getToken();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $action);

        switch ($action) {
            case 'DELETE':
            case 'GET' && $id < 0:
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                break;
            case 'POST':
            case 'PUT':
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            case 'GET' && $id > 0:
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json',
                                                                    'Content-Type: application/json'));
                break;
        }
        return curl_exec($curl);
    }

}