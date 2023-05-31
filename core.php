<?php

function dd($data)
{
    return die(var_dump(($data)));
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('/app/Views/' . $path);
}

function autoloader($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $filePath = base_path($className . '.php');
    if (file_exists($filePath)) {
        return require $filePath;
    }
}
