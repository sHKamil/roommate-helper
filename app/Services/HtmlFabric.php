<?php

class HtmlFabric
{
    public static function buildHeader($title = "RHelper", $custom_css_url = NULL): string
    {
        $custom_css = '';
        if ($custom_css_url != NULL) {
            $custom_css = '<link rel="stylesheet" href="' . $custom_css_url . '">';
        }
        $head =
            '<!DOCTYPE html>
            <html lang="pl">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
                <link rel="stylesheet" href="../../app/Views/assets/css/style.css">
                ' . $custom_css . '
                <title>' . $title . '</title>
            </head>';
        return $head;
    }

    public function buildFooter(): string
    {
        $footer =
            '<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <div class="text-white mb-3 mb-md-0">
                    Copyright © 2023. All rights reserved.
                </div>
                <div>
                    <!-- Right -->
                </div>
            </div>';
        return $footer;
    }
}
