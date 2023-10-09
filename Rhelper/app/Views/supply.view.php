<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css", "/assets/css/checkbox.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container-main">
	<div class="component-form">
		<form action="" method="post">
            <input class="form__input" type="text" name="name" placeholder="Name">
            <input class="form__input" type="number" name="quantity_max" placeholder="Max quantity">
            <input class="form__input" type="number" name="quantity" placeholder="Actual quantity">
            <input class="form__input" type="number" name="days_until_ends" placeholder="Days until ends">
			<div class="error_slot">
				<?php 
				if(isset($errors) && !empty($errors)){
					foreach ($errors as $error) {
						echo '<p>' . $error . '</p>';
					}
				}
					?>
			</div>
            <input  type="submit" class="btns btn__primary" value="Create">
                        <a href="../schedule" style = "text-decoration: none;">
                            <div class="btns btn__secondary">
                                Schedule
                            </div>
                        </a>
        </form>
	</div>
	<div class="component-schedule">
        <form action="" method="post">
			<div class="form_title">Supply</div>
			<button id="delete" name="_method" value="delete" type="submit" class="btns btn__danger"><i class="bi bi-trash"></i></button>
            <?php echo $table; ?>
        </form>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
