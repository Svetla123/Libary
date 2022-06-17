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
                    <h2 class="heading-section">Popis naslova</h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#insertModal" style="margin-bottom: 10px;">
                            <!-- <a class="nav-link icon" href="<?php echo URLROOT . "/posudbe/create/" ?>" style="font-size:20px"> -->
                            <h3 class="h5 text-right" style="color: #ffffff">Dodaj naslov
                                <i class="fa-solid fa-user-plus"></i>
                            </h3>
                            <!-- </a> -->
                        </button>
                </div>

                <!-- mdoel for inserting -->
                <?php
                        require APPROOT . '/views/knjige/modelInsert.php';
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
                            require APPROOT . '/views/knjige/naslovi/modelError.php';
                ?>
            <?php endif; ?>
        <?php endif; ?>

        <div class="table-wrap">
            <table class="table myaccordion table-hover" id="accordion">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Naslov knjige</th>
                        <th>Godina objave</th>
                        <th>Autor knjige</th>
                        <th>Žanr</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['knjige'] as $knjiga) : ?>
                        <tr data-toggle="collapse" data-target="#collapse<?php echo $knjiga->isbn ?>" aria-expanded="false" aria-controls="collapse<?php echo $knjiga->isbn ?>" class="collapsed">

                            <th scope="row"><?php echo (string) $knjiga->isbn ?></th>
                            <td><?php echo $knjiga->naslov_knjige ?> </td>
                            <td><?php echo $knjiga->godina_objave ?></td>
                            <td><?php echo $knjiga->prezime_autora . ', ' . $knjiga->ime_autora; ?></td>
                            <td><?php echo $knjiga->ime_zanra ?></td>
                            <td>
                                <i class="fa" aria-hidden="true"></i>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" id="collapse<?php echo $knjiga->isbn ?>" class="collapse acc" data-parent="#accordion">
                                <div class="modal-body row">
                                    <p>-➤Prevoditelj knjige: <?php echo $knjiga->prezime_prevoditelja . ', ' . $knjiga->ime_prevoditelja ?>.
                                    </p>
                                    <p>-➤Jezik knjige: <?php echo $knjiga->ime_jezika ?>. </p>
                                    <p>-➤Broj kopija knjige: <?php echo $knjiga->broj_kopija  ?>. </p>
                                    <p>-➤Izvdavačka kuća: <?php echo $knjiga->ime_izdavacke_kuce  ?>. </p>
                                    <p>-➤Dostupnost knjige(<?php echo $knjiga->broj_kopija  ?>): GK Ivanič Grad:<?php echo $knjiga->broj_slobodnih_GKIV ?>, Knjižnica Kloštar Ivanić: <?php echo $knjiga->broj_slobodnih_klostar ?>.
                                    </p>
                                </div>

                                <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                                    <div class="col-md-2 text-right">
                                        <form action="<?php echo URLROOT . "/knjige/naslovi/delete/" . $knjiga->isbn ?>" method="POST">
                                            <button class="btn btn-danger" name="delete" type="submit" onclick="return confirm('Izbrisati naslov(<?php echo $knjiga->isbn ?>) knjige `<?php echo $knjiga->naslov_knjige ?>`.`">
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
                                        require APPROOT . '/views/knjige/modelUpdate.php';
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