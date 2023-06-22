<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css", "/assets/css/checkbox.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container">
	<div class="component-form">
		<form action="" method="post">
            <div class="info">
                <p>Last edit by: <?php echo $last_user ?> </p>
                <p>Event ID: <?php echo $data['id'] ?> </p>
            </div>
            
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value=<?php echo $data['id'] ?>>
            <input class="form__input" type="text" name="event_name" placeholder="Event name" value=<?php echo $data['event_name'] ?> required>
            <input class="form__input" type="text" name="content" placeholder="Content" value=<?php echo $data['content'] ?> required>
            <input class="form__input" type="date" name="day" placeholder="Day" value=<?php echo $data['day'] ?> required>
            <input class="form__input" type="time" name="start" placeholder="Start" value=<?php echo $data['start'] ?> required>
            <input class="form__input" type="time" name="end" placeholder="End" value=<?php echo $data['end'] ?> required>
            <input  type="submit" class="btns btn__primary">
            
            <a href="event" class="abtn" >
                <div class="btns btn__second"> Back </div>
            </a>
    </form>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
