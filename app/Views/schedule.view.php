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

		</div>
		<div></div>
	</div>
	<div class="component-schedule">
	<table class="table">
  <thead>
    <tr>
      <th scope="col" style="text-align:center;">Godziny</th>
      <th scope="col" colspan="3" style="text-align:center;">PONIEDZIAŁEK</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">12</th>
      <td colspan="3" rowspan="2" style="text-align: center;vertical-align: middle;">Sprzątanie mieszkania</td>
    </tr>
    <tr>
      <th scope="row">16</th>
    </tr>
    <tr>
      <th scope="row">17</th>
      <td colspan="3" style="text-align: center;vertical-align: middle;">Sprzątanie klatki schodowej</td>
    </tr>
  </tbody>
</table>
	</div>
</div>




<!-- <form method="POST" action="">
	<div>
		<input type="hidden" name="_method" value="LOGOUT">
		<button type="submit">Wyloguj</button>
	</div>
</form>
<a href="event/create">
	<div class="btns btn__primary">
		Create Event
	</div>
</a>
<a href="group">
	<div class="btns btn__primary">
		My group
	</div>
</a>
<div class="container text-center">
	<div class="row justify-content-md-center bg-dark mt-3">
		<div class="col col-lg-4 text-center bg-secondary">
			<button class="btn btn-dark"><i class="bi bi-arrow-left"></i></button>
		</div>
		<div id="actual_date" class="col-lg-4 text-light">
			Data dzisiejsza
		</div>
		<div class="col col-lg-4 bg-secondary">
			<button class="btn btn-dark"><i class="bi bi-arrow-right"></i></button>
		</div>
		<table class="table table-bordered table-lf text-light" style="table-layout: fixed;">
			<thead>
				<tr>
					<th scope="col">Poniedziałek</th>
					<th scope="col">Wtorek</th>
					<th scope="col">Środa</th>
					<th scope="col">Czwartek</th>
					<th scope="col">Piątek</th>
					<th scope="col">Sobota</th>
					<th scope="col">Niedziela</th>
				</tr>
			</thead>
			<tbody>
				<tr class="schedule-rows">
					<td class="actual_day" id="d01">1</td>
					<td id="d02">2</td>
					<td id="d03">3</td>
					<td id="d04">4</td>
					<td id="d05">5</td>
					<td id="d06">6</td>
					<td id="d07">7</td>
				</tr>
				<tr class="schedule-rows">
					<td id="d08">8</td>
					<td id="d09">9</td>
					<td id="d10">10</td>
					<td id="d11">11</td>
					<td id="d12">12</td>
					<td id="d13">13</td>
					<td id="d14">14</td>
				</tr>
				<tr class="schedule-rows">
					<td id="d15">15</td>
					<td id="d16">16</td>
					<td id="d17">17</td>
					<td id="d18">18</td>
					<td id="d19">19</td>
					<td id="d20">20</td>
					<td id="d21">21</td>
				</tr>
				<tr class="schedule-rows">
					<td id="d22">22</td>
					<td id="d23">23</td>
					<td id="d24">24</td>
					<td id="d25">25</td>
					<td id="d26">26</td>
					<td id="d27">27</td>
					<td id="d28">28</td>
				</tr>
				<tr class="schedule-rows">
					<td id="d29">29</td>
					<td id="d30">30</td>
					<td id="d31">31</td>
					<td id="d32">32</td>
					<td id="d33">33</td>
					<td id="d34">34</td>
					<td id="d35">35</td>
				</tr>
			</tbody>
		</table>
	</div>
</div> -->
<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
