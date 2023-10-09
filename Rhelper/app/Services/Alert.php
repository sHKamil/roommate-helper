<?php

namespace app\Services;

class Alert
{
    public static function success($title = "Sukces", $text = '')
    {
        return "
        <script>
            Swal.fire({
                title: '$title',
                text: '$text',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        </script>
        ";
    }

    public static function failed($title = "Błąd", $text = '')
    {
        return "
        <script>
            Swal.fire({
                title: '$title',
                text: '$text',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        </script>
        ";
    }
}
