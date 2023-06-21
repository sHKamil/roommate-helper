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
		<div class="supply">
			<table class="table">
				<thead>
					<tr>
						<th scope="col" style="text-align:center;">Quantity (last check)</th>
						<th scope="col" style="text-align:center;">ITEM</th>
						<th scope="col" style="text-align:center;">Expected end</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">3/12</th>
						<td style="text-align: center;vertical-align: middle;">Papier toaletowy</td>
						<td style="text-align: center;vertical-align: middle;">22.06.2023</td>
					</tr>
					<tr>
						<th scope="row">1/2</th>
						<td style="text-align: center;vertical-align: middle;">Ręcznik papierowy</td>
						<td style="text-align: center;vertical-align: middle;">26.06.2023</td>
					</tr>
					<tr>
						<th scope="row">40/100</th>
						<td style="text-align: center;vertical-align: middle;">Pieprz</td>
						<td style="text-align: center;vertical-align: middle;">27.06.2023</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div></div>
	</div>
	<div class="component-schedule">
		<?php echo $schedule ?>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
