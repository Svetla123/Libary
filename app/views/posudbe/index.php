<?php
require APPROOT . '/views/includes/headPosudbe.php';
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
          <h2 class="heading-section">Zapis posudba</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php if (isLoggedIn('zaposlenik_ID')) : ?>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#insertModal" style="margin-bottom: 10px;">
              <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
              <h3 class="h5 text-right" style="color: #ffffff">Nova posudba
                <i class="fa-solid fa-user-plus"></i>
              </h3>
              <!-- </a> -->
            </button>
        </div>
      </div>
      <!-- mdoel for inserting -->
      <?php
            require APPROOT . '/views/posudbe/modelInsert.php';
      ?>
      <div class="row">
        <div class="col-md-12">
          <?php if ($data['datum_posudbeError']  || $data['clan_knjiznice_IDError'] || $data['inventarni_broj_IDError'] || $data['clanarinaError'] || $data['datum_vracanjaError']) : ?>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelError" style="margin-left: 0;">
              <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
              <h3 class="h5 text-right" style="color: #ffffff">Problemi
                <i class="fa fa-solid fa-triangle-exclamation"></i>
              </h3>
              <!-- </a> -->
            </button>
        </div>
      </div>
      <!-- mdoel for errors -->
      <?php
              require APPROOT . '/views/posudbe/modelError.php';
      ?>
    <?php endif; ?>
  <?php endif; ?>

  <div class="table-wrap">
    <table class="table myaccordion table-hover" id="accordion">
      <thead>
        <tr>
          <th>#</th>
          <th>Ime člana</th>
          <th>Prezime člana</th>
          <th>Naslov knjige</th>
          <th>Status posudbe</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($data['posudbe'] as $posudba) : ?>
          <tr data-toggle="collapse" data-target="#collapse<?php echo $posudba->posudena_knjiga_ID ?>" aria-expanded="false" aria-controls="collapse<?php echo $posudba->posudena_knjiga_ID ?>" class="collapsed">

            <th scope="row"><?php echo $posudba->posudena_knjiga_ID ?> </th>
            <td><?php echo $posudba->ime_clana ?> </td>
            <td><?php echo $posudba->prezime_clana ?></td>
            <td><?php echo $posudba->naslov_knjige ?></td>

            <td>
              <?php if ($posudba->datum_predvidenog_vracanja > $posudba->datum_vracanja && $posudba->ime_statusa_posudbe == "Vraćeno") : ?>
                <p class="text-success" style="font-size: 14px;"><?php echo "Vraćeno"; ?></p>
              <?php elseif ($posudba->ime_statusa_posudbe == "Posuđeno") : ?>
                <p class="text-warning" style="font-size: 14px;"><?php echo "Posuđeno"; ?></p>
              <?php elseif ($posudba->datum_vracanja > $posudba->datum_predvidenog_vracanja) : ?>
                <p class="text-danger" style="font-size: 14px;"><?php echo "Zakašnjenje"; ?></p>
              <?php endif; ?>
            </td>

            <td>
              <i class="fa" aria-hidden="true"></i>
            </td>
          </tr>

          <tr>
            <td colspan="6" id="collapse<?php echo $posudba->posudena_knjiga_ID ?>" class="collapse acc" data-parent="#accordion">
              <div class="modal-body row">
                <div class="col-md-10">
                  <p><?php echo '-➤ Datum posudbe: ' . date('j.m.Y', strtotime($posudba->datum_posudbe)) . '.' ?> </p>
                  <p><?php echo '-➤ Datum zakazonoga vračanja: ' . date('j.m.Y', strtotime($posudba->datum_predvidenog_vracanja)) . '.' ?> </p>
                  <?php if ($posudba->datum_vracanja == 0) : ?>
                    <p><?php echo '-➤ Knjiga nije vračena.' ?> </p>
                  <?php else : ?>
                    <p><?php echo '-➤ Datum vračanja: ' . date('j.m.Y', strtotime($posudba->datum_vracanja))  . '.' ?> </p>
                  <?php endif; ?>
                  <p>-➤ Zaostatak: <?php echo $posudba->novcani_zaostatak ?> kn.
                  </p>
                  <p>-➤ Knjižnica: <?php echo $posudba->ime_knjiznice ?>. </p>
                  <p>-➤ ISBN knjige: <?php echo $posudba->isbn  ?>. </p>
                  <p>-➤ Inventarni broj knjige: <?php echo $posudba->inventarni_broj_ID  ?>. </p>
                </div>

                <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                  <div class="col-md-2 text-right">
                    <form action="<?php echo URLROOT . "/posudbe/delete/" . $posudba->posudena_knjiga_ID ?>" method="POST">
                      <button class="btn btn-danger" name="delete" type="submit" onclick="return confirm('Izbrisati posudbu(<?php echo $posudba->posudena_knjiga_ID ?>) knjige `<?php echo $posudba->naslov_knjige ?>` člana `<?php echo $posudba->ime_clana ?>` <?php echo $posudba->prezime_clana ?>?')">
                        <h3 class="h5 text-right" style="color: #ffffff">Izbriši
                          <i class="fa-solid fa-ban" style="font-size:20px"></i>
                        </h3>
                      </button>
                    </form>

                    <?php if ($posudba->ime_statusa_posudbe != "Vraćeno") : ?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelUpdate">
                        <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
                        <h3 class="h5 text-right" style="color: #ffffff">Vračanje
                          <i class="fa-solid fa-wrench" style="font-size:20px"></i>
                        </h3>

                        <!-- </a> -->
                      </button>
                      <!-- mdoel for updating -->
                      <?php
                      require APPROOT . '/views/posudbe/modelUpdate.php';
                      ?>
                    <?php endif; ?>
                  </div>

                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
    </div>
    </div>
    </div>
  </section>
  <!-- table -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?php echo URLROOT ?>/public/js/tableClanarine.js"></script>
  <script src="<?php echo URLROOT ?>/public/js/bootstrap.min.js"></script>
  <script src="<?php echo URLROOT ?>/public/js/popper.js"></script>
  <!-- date picker -->
  <script src="<?php echo URLROOT ?>/public/js/rome.js"></script>
  <script src="<?php echo URLROOT ?>/public/js/datepicker.js"></script>
</body>
<?php
require APPROOT . '/views/includes/footer.php';
?>