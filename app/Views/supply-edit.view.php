<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css", "/assets/css/checkbox.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container">
	<div class="component-form">
		<form action="" method="post">
            <div class="form_title">Supply</div>
            <div class="info">
                <p>Last edit by: <?php echo $last_user ?> </p>
                <p>Expected end: <?php echo $data['expected_end'] ?> </p>
                <p>Supply ID: <?php echo $data['id'] ?> </p>
            </div>
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value=<?php echo $data['id'] ?>>
            <div class="input-with-name"><input class="form__input" type="text" name="name" placeholder="Name" value=<?php echo $data['name'] ?> required> Suppy name </div>
            <div class="input-with-name"><input class="form__input" type="text" name="quantity_max" placeholder="Max quantity" value=<?php echo $data['quantity_max'] ?> required> Max quantity </div>
            <div class="input-with-name"><input class="form__input" type="text" name="quantity" placeholder="Actual quantity" value=<?php echo $data['quantity'] ?> required> Actual quantity </div>
            <div class="input-with-name"><input class="form__input" type="text" name="days_until_ends" placeholder="Days until ends" required> Days until ends </div>
            <input  type="submit" class="btns btn__primary">
            
            <a href="supply" class="abtn" >
                <div class="btns btn__second"> Back </div>
            </a>
    </form>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
