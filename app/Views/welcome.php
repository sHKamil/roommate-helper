<?php

use app\Services\HtmlFabric;

echo HtmlFabric::buildHeader("Rhelper - LogIn");

if(isset($_SESSION)){
    echo '<a href="/schedule"><button>Schedule</button></a>';
}else{
    echo '<a href="/login"><button>Login</button></a>';
    echo '<a href="/register"><button>Register</button></a>';
}

?>

dwaDAW2@

<?php echo HtmlFabric::buildFooter(); ?>
