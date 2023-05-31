<?php



use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - LogIn");

if(isset($_SESSION['user_type'])){
    echo '<a href="/schedule"><button>Schedule</button></a>';
}else{
    echo '<a href="/login"><button>Login</button></a>';
    echo '<a href="/register"><button>Register</button></a>';
}

?>

dwaDAW2@

<?php echo HtmlFactory::buildFooter(); ?>
