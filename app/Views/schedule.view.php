<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css"]);
?>
<form method="POST" action="">
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
<a href="group/create">
	<div class="btns btn__primary">
		Create Group
	</div>
</a>
<a href="group/create">
	<div class="btns btn__primary">
		Join to group
	</div>
</a>
<a href="group/menage">
	<div class="btns btn__primary">
		My groups
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
</div>
<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js']); ?>
