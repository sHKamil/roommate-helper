<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css", "/assets/css/checkbox.css"]);
?>
<div class="nav-component">
	<div class="logo">
		<img src="/assets/images/logo_helper6.png" alt="Logo" width="100px">
	</div>
	<div class="nav-buttons">
		<form method="POST" action="">
			<div>
				<input type="hidden" name="_method" value="LOGOUT">
				<button class="btns btn__danger" type="submit">Wyloguj</button>
			</div>
		</form>
		<a class="abtn" href="event/create">
			<div class="btns btn__primary">
				Create Event
			</div>
		</a>
		<a class="abtn" href="group">
			<div class="btns btn__primary">
				My group
			</div>
		</a>
		<a class="abtn" href="supply">
			<div class="btns btn__primary">
				Supply
			</div>
		</a>
	</div>
	<div class="profile">
		<div class="username">
			<div class="username-spacer">
			</div>
			<p>Username</p>
		</div>
		<div class="avatar">
			<img src="/assets/images/avatar.png" alt="Avatar" width="100px">
		</div>
	</div>
</div>

<div class="container">
	<div class="component-form">
		<form action="" method="post">
            <div class="info">
                <p>Last edit by: <?php echo $last_user ?> </p>
                <p>Expected end: <?php echo $data['expected_end'] ?> </p>
                <p>Supply ID: <?php echo $data['id'] ?> </p>
            </div>
            
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value=<?php echo $data['id'] ?>>
            <input class="form__input" type="text" name="name" placeholder="Name" value=<?php echo $data['name'] ?> required>
            <input class="form__input" type="text" name="quantity_max" placeholder="Max quantity" value=<?php echo $data['quantity_max'] ?> required>
            <input class="form__input" type="text" name="quantity" placeholder="Actual quantity" value=<?php echo $data['quantity'] ?> required>
            <input class="form__input" type="text" name="days_until_ends" placeholder="Days until ends" required>
            <input  type="submit" class="btns btn__primary">
            
            <a href="supply" class="abtn" >
                <div class="btns btn__second"> Back </div>
            </a>
    </form>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
