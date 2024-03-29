<?php

namespace app\Services;

use app\Controllers\AvatarController;

class HtmlFactory
{

    public static function buildHeader($title = "Rhelper", $css_url = NULL): string
    {   
        $default_css = [
            // '/assets/css/style.css',
            '/bootstrap/css/bootstrap.min.css',
            'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css',
            '/assets/css/basic.css',
            '/assets/css/footer.css',
            '/assets/css/form_errors.css'
        ];
        $css = static::_createLinks($css_url, $default_css, '<link rel="stylesheet" href="', '">');
        $head =
<<<END
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    $css<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>$title</title>
</head>
<body>

END;
        return $head;
    }

    public  static function buildNav() : string
    {
        $avatar_path = AvatarController::getUserAvatar();
        return '
        <div class="nav-component">
            <a href="/">
            <div class="logo">
                <img src="/assets/images/logo.png" alt="Logo" width="350px">
            </div>
            </a>
        <div class="nav-buttons">

        </div>
        <div class="profile-box">
            <a class="abtn" href="profile">
                <div class="profile">
                    <div class="username">
                        <div class="username-spacer">
                        </div>
                        <p>' . $_SESSION['user_name'] . '</p>
                    </div>
                    <div class="avatar">
                    <img src= "' . $avatar_path . '" alt="Avatar">
                    </div>
                </div>
            </a>
            <form method="POST" action="">
                <div>
                    <input type="hidden" name="_method" value="LOGOUT">
                    <button class="btns btn__danger" type="submit" style="width: 4rem; height: 4rem; font-size: 3rem; line-height: 1.5rem;"><i class="bi bi-dash-circle"></i></button>
                </div>
            </form>
        </div>
    </div>';
    }

    public static function buildFooter($js_url = NULL): string
    {
        $default_js = ['/assets/js/sweetAlert2.js'];
        $js = static::_createLinks($js_url, $default_js, '<script src="', '"></script>');
        $footer =
<<<END
<footer>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2023. All rights reserved.
        </div>
        <div>
            <!-- Right -->
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
$js</body>
</html>
END;
            
        return $footer;
    }

    private static function _createLinks($url, $default, $tag_start, $tag_end)
    {
        $result = '';
        if ($url != NULL) {
            foreach ($default as $path ) {
                array_push($url, $path);
            }
        }else {
            $url = $default;
        }
        foreach ($url as $link) {
            $result .= <<<END
                $tag_start$link$tag_end                    
                
                END;
        }
        return $result;
    }

}
