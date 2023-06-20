<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/clock.css"]);
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

<div class="container-main">
	<div class="component-form">
		<form action="" method="post">
            <input class="form__input" type="text" name="name" placeholder="Name">
            <input class="form__input" type="text" name="quantity_max" placeholder="Max quantity">
            <input class="form__input" type="text" name="quantity" placeholder="Actual quantity">
            <input class="form__input" type="text" name="days_until_ends" placeholder="Days until ends">
            <input  type="submit" class="btns btn__primary">
        </form>
	</div>
	<div class="component-schedule">
        <form action="" method="post">
            <input type="hidden" name="_method" value="delete">
            <?php echo $table; ?>
            <input type="submit" class="btns btn__danger" value="DELETE">
        </form>
		<!-- <table class="table">
			<thead>
				<tr>
				<th scope="col" style="text-align:center;">Godziny</th>
				<th scope="col" colspan="3" style="text-align:center;">PONIEDZIAŁEK</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th scope="row">12:00</th>
				<td colspan="3" rowspan="2" style="text-align: center;vertical-align: middle;">Sprzątanie mieszkania</td>
				</tr>
				<tr>
				<th scope="row">16:00</th>
				</tr>
				<tr>
				<th scope="row">17:00</th>
				<td colspan="3" style="text-align: center;vertical-align: middle;">Sprzątanie klatki schodowej</td>
				</tr>
			</tbody>
		</table> -->
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
