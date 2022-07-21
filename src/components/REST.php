<?php

class REST {

    public static function getConfigFileContent(): array
    {
        $configPath = file_build_path(ROOT, 'configs', 'configREST.php');
        return include $configPath;
    }

    public static function getConfigs(string $config): string
    {
        return self::getConfigFileContent()[$config];
    }

}
