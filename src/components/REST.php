<?php

class REST {

    private array $configs;

    public function __construct()
    {
        $configPath = file_build_path(ROOT, 'configs', 'configREST.php');
        $this->configs = include $configPath;
    }

    public static function getContent(): string
    {
        try {
            $content = file_get_contents(self::getURL());
            return $content;
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getURL(): string
    {
        return $this->configs['url'];
    }

    public function getToken(): string
    {
        return $this->configs['token'];
    }
}
