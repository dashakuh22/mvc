<?php

class REST
{

    public static function getConfigFileContent(): array
    {
        $configPath = file_build_path(ROOT, 'config', 'configREST.php');
        return include $configPath;
    }

    public static function getConfigs(string $config): string
    {
        if (self::getConfigFileContent()['token'] === 'YOUR-TOKEN') {
            header('Location: /noAccessToken');
        }
        return self::getConfigFileContent()[$config];
    }

}
