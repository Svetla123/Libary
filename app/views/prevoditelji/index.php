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
                    <h2 class="heading-section">Popis prevoditelja</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#insertModal" style="margin-bottom: 10px;">
                            <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
                            <h3 class="h5 text-right" style="color: #ffffff">Dodaj prevoditelja
                                <i class="fa-solid fa-user-plus"></i>
                            </h3>
                            <!-- </a> -->
                        </button>
                </div>

                <!-- mdoel for inserting -->
                <?php
                        require APPROOT . '/views/prevoditelji/modelInsert.php';
                ?>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <?php if ($data['datum_posudbeError']  || $data['clan_knjiznice_IDError'] || $data['inventarni_broj_IDError'] || $data['clanarinaError'] || $data['datum_vracanjaError']) : ?>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelError" style="margin-left: 0;">
                                <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px">
                                    <h3 class="h5 text-right" style="color: #ffffff">Problemi
                                        <i class="fa fa-solid fa-triangle-exclamation"></i>
                                    </h3>
                                </a>
                            </button>
                    </div>
                </div> -->

                <!-- mdoel for errors -->
                <?php
                            require APPROOT . '/views/prevoditelji/modelError.php';
                ?>
            <?php endif; ?>
        <?php endif; ?>

        <div class="table-wrap">
            <table class="table myaccordion table-hover" id="accordion">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ime prevoditelja</th>
                        <th>Službeni</th>
                        <th>Obrazovanje</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['prevoditelji'] as $prevoditelj) : ?>
                        <tr data-toggle="collapse" data-target="#collapse<?php echo $prevoditelj->prevoditelj_ID ?>" aria-expanded="false" aria-controls="collapse<?php echo $prevoditelj->prevoditelj_ID ?>" class="collapsed">

                            <th scope="row"><?php echo (string) $prevoditelj->prevoditelj_ID ?></th>
                            <td><?php echo $prevoditelj->ime_prevoditelja . ' ' . $prevoditelj->prezime_prevoditelja; ?></td>
                            <td><?php echo $prevoditelj->kratica_obeazovanja ?> </td>
                            <?php if ($prevoditelj->službeni_prevoditelj == 1) : ?>
                                <td class="text-success"><?php echo 'Službeni'; ?></td>
                            <?php else :  ?>
                                <td class="text-warning"><?php echo 'Neslužbeni'; ?></td>
                            <?php endif; ?>
                            <td>
                                <i class="fa" aria-hidden="true"></i>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" id="collapse<?php echo $prevoditelj->prevoditelj_ID ?>" class="collapse acc" data-parent="#accordion">
                                <div class="modal-body row">
                                    <?php foreach ($data['jezici'] as $jezik) : ?>
                                        <?php if ($jezik->prevoditelj_ID == $prevoditelj->prevoditelj_ID) : ?>
                                            <p><?php echo '-➤Prevodi: ' .  $jezik->prevodi_s . '-➤' . $jezik->prevodi_na . '.' ?>
                                            </p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </p>
                                </div>

                                <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                                    <div class="col-md-2 text-right">
                                        <form action="<?php echo URLROOT . "/prevoditelji/delete/" . $prevoditelji->prevoditelj_ID ?>" method="POST">
                                            <button class="btn btn-danger" name="delete" type="submit" onclick="return confirm('Izbrisati prevoditelja (<?php echo $prevoditelji->prevoditelj_ID ?>) `<?php echo $prevoditelj->prezime_prevoditelja . ', ' . $prevoditelj->ime_prevoditelja; ?>`.`">
                                                <h3 class="h5 text-right" style="color: #ffffff">Izbriši
                                                    <i class="fa-solid fa-ban" style="font-size:20px"></i>
                                                </h3>
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelUpdate">
                                            <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
                                            <h3 class="h5 text-right" style="color: #ffffff">Promijeni
                                                <i class="fa-solid fa-wrench" style="font-size:20px"></i>
                                            </h3>
                                        </button>
                                        <!-- mdoel for updating -->
                                        <?php
                                        require APPROOT . '/views/prevoditelji/modelUpdate.php';
                                        ?>
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
<?php
require APPROOT . '/views/includes/footer.php';
?>