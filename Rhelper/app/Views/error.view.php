<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Error");
?>
 <div class="nav-component">
    <a href="/">
        <div class="logo">
            <img src="/assets/images/logo.png" alt="Logo" width="350px">
        </div>
    </a>
</div>
<div class="component" style="margin: 5vh 5vw; display: block; text-align:center;">
        <h1 style="font-size: 5rem;">ERROR 404: Page not found! </h1><br>
        <h2 style="font-size: 5rem;">Go back to <a href="/">home page.</a></h2>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
