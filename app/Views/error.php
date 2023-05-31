<?php



use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - LogIn");

?>

ERROR 404: Page not found! <br>
Go back to <a href="/">home page.</a>

<?php echo HtmlFactory::buildFooter(); ?>