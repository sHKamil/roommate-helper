<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container-main">
	<div class="component-left">
		<div class="clock-box">
			<div class="clock">
				<div class="hand hours"></div>
				<div class="hand minutes"></div>
				<div class="hand seconds"></div>
				<div class="point"></div>
				<div class="marker">
					<span class="marker__1"></span>
					<span class="marker__2"></span>
					<span class="marker__3"></span>
					<span class="marker__4"></span>
				</div>
			</div>
			<div class="date">
				<p id="actual_date"></p>
			</div>
		</div>
		<a href="supply" class="supply">
			<div class="form_title" style="margin-bottom: 2rem;">Supply</div>
			<?php if(isset($supply) && !empty($supply)) {
				echo $supply;
			 } else {
				echo '<h1 style="text-align:center; color: var(--danger-dark); font-size: 4rem;">Click to add</h1>';
			 } ?>
		</a>
	</div>
	<a href="event" class="component-schedule event">
		<div class="form_title" style="margin-bottom: 2rem;">Schedule</div>
		<?php 
		if(isset($schedule) && !empty($schedule)) {
			echo $schedule;
		} else {
			echo '<h1 style="text-align:center; color: var(--danger-dark); font-size: 4rem;">Click to add</h1>';
		}
		?>
	</a>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
