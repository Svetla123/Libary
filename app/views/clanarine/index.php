<?php
require APPROOT . '/views/includes/headClanarine.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>

<body data-new-gr-c-s-check-loaded="14.1062.0" data-gr-ext-installed="">
	<!-- <nav class="notificaticationHead">
        <ul>
            <li>
              <a class="memberHeader" href ="<?php echo URLROOT; ?>/clanoviKnjiznice/index">
                <h1>Lista članova knjižnice</h1>
              </a> 
            </li>
        </ul>
</nav> -->
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section">Table #08</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="h5 mb-4 text-center">Collapsible Table</h3>
					<div class="table-wrap">
						<table>
							<tbody>
								<tr class="row100 body">
									<td class="cell100 column1">Like a butterfly</td>
									<td class="cell100 column2">Boxing</td>
									<td class="cell100 column3">9:00 AM - 11:00 AM</td>
									<td class="cell100 column4">Aaron Chapman</td>
									<td class="cell100 column5">10</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Mind &amp; Body</td>
									<td class="cell100 column2">Yoga</td>
									<td class="cell100 column3">8:00 AM - 9:00 AM</td>
									<td class="cell100 column4">Adam Stewart</td>
									<td class="cell100 column5">15</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Crit Cardio</td>
									<td class="cell100 column2">Gym</td>
									<td class="cell100 column3">9:00 AM - 10:00 AM</td>
									<td class="cell100 column4">Aaron Chapman</td>
									<td class="cell100 column5">10</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Wheel Pose Full Posture</td>
									<td class="cell100 column2">Yoga</td>
									<td class="cell100 column3">7:00 AM - 8:30 AM</td>
									<td class="cell100 column4">Donna Wilson</td>
									<td class="cell100 column5">15</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Playful Dancer's Flow</td>
									<td class="cell100 column2">Yoga</td>
									<td class="cell100 column3">8:00 AM - 9:00 AM</td>
									<td class="cell100 column4">Donna Wilson</td>
									<td class="cell100 column5">10</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Zumba Dance</td>
									<td class="cell100 column2">Dance</td>
									<td class="cell100 column3">5:00 PM - 7:00 PM</td>
									<td class="cell100 column4">Donna Wilson</td>
									<td class="cell100 column5">20</td>
								</tr>
								<tr class="row100 body">
									<td class="cell100 column1">Cardio Blast</td>
									<td class="cell100 column2">Gym</td>
									<td class="cell100 column3">5:00 PM - 7:00 PM</td>
									<td class="cell100 column4">Randy Porter</td>
									<td class="cell100 column5">10</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo URLROOT ?>/public/js/tableClanarine.js"></script>
	bootstrap.min.js
	<script src="<?php echo URLROOT ?>/public/js/bootstrap.min.js"></script>
	<script src="<?php echo URLROOT ?>/public/js/popper.js"></script>
</body>

<?php foreach ($data['clanarine'] as $clanarina) : ?>
	<?php echo $clanarina->clanarina_ID ?>
	<?php echo $clanarina->datum_placanja ?>
	<?php echo $clanarina->datum_isteka ?>
	<?php echo $clanarina->clanarina_vrijedi ?>
	<?php echo $clanarina->zaposlenik_ID ?>
	<?php echo $clanarina->clan_knjiznice_ID ?>

<?php endforeach; ?>

<?php
require APPROOT . '/views/includes/footer.php';
?>