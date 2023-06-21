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
			<?php echo $supply ?>
		</a>
		<div></div>
	</div>
	<a href="event" class="component-schedule">
		<div class="form_title" style="margin-bottom: 2rem;">Schedule</div>
		<?php echo $schedule ?>
	</a>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
