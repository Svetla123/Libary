<?php
require APPROOT . '/views/includes/head.php';
?>

<body class="updateform">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <div class="container contact-form">
        <div class="card" style="border-radius: 1rem;">

            <div class="contact-image">
                <img src="<?php echo URLROOT ?>/public/img/city.png" />
            </div>

            <form class="formUpdate" action="<?php echo URLROOT; ?>/clanoviKnjiznice/update/<?php echo $data['clanKnjiznice']->clan_knjiznice_ID ?>" method="POST">

                <h3><?php echo $data['clanKnjiznice']->ime_clana . " " . $data['clanKnjiznice']->prezime_clana ?> </h3>
                <div class="row">

                    <div class="col-md-6">
                        <!-- id clana -->
                        <div class="form-group">
                            <input type="text" id="labelIme" name="clan_knjiznice_ID" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->clan_knjiznice_ID ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['clan_knjiznice_IDError']; ?>
                            </span>
                            <label class="form-label" for="labelclan_knjiznice_ID">Broj člana</label>
                        </div>

                        <!-- ime clana -->
                        <div class="form-group">
                            <input type="text" id="labelime_clana" name="ime_clana" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->ime_clana ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['ime_clanaError']; ?>
                            </span>
                            <label class="form-label" for="labelime_clana">Ime člana</label>
                        </div>

                        <!-- prezime clana -->
                        <div class="form-group">
                            <input type="text" id="labelprezime_clana" name="prezime_clana" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->prezime_clana ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['prezime_clanaError']; ?>
                            </span>
                            <label class="form-label" for="labelprezime_clana">Prezime člana</label>
                        </div>

                        <!-- adresa clana -->
                        <div class="form-group">
                            <input type="text" id="labeladresa_clana" name="adresa_clana" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->adresa_clana ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['adresa_clanaError']; ?>
                            </span>
                            <label class="form-label" for="labeladresa_clana">Adresa člana</label>
                        </div>

                        <!-- email clana -->
                        <div class="form-group">
                            <input type="text" id="labelemail_clana" name="email_clana" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->email_clana ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['email_clanaError']; ?>
                            </span>
                            <label class="form-label" for="labelemail_clana">Email člana</label>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!-- tel.broj clana -->
                        <div class="form-group">
                            <input type="text" id="labeltelefosnki_broj_clana" name="telefosnki_broj_clana" class="form-control form-control-lg border-bottom" value="<?php echo $data['clanKnjiznice']->telefosnki_broj_clana ?>" />

                            <span class="invalidFeedback">
                                <?php echo $data['telefosnki_broj_clanaError']; ?>
                            </span>
                            <label class="form-label" for="telefosnki_broj_clana">Telefonski broj člana</label>
                        </div>

                        <div class="form-outline mb-4">
                            <select class="form-control" id="labelgrad_ID" name="grad_ID" style="height:50px;" value="<?php echo $data['clanKnjiznice']->grad_ID ?>">

                                <option disabled selected value><?php echo $data['ime_grada'] ?></option>
                                <?php foreach ($data['gradovi'] as $grad) : ?>
                                    <option>
                                        <?php echo $grad->ime_grada; ?>
                                    </option>
                                <?php endforeach;  ?>
                            </select>
                            <label for="labelgrad_ID">Grad člana</label>

                            <span class="invalidFeedback">
                                <?php echo $data['grad_IDError']; ?>
                            </span>
                        </div>

                        <div class="form-outline mb-4">
                            <select class="form-control" id="labelvrsta_clanarine_ID" name="vrsta_clanarine_ID" style="height:50px;">
                                <option disabled selected value><?php echo $data['ime_vrste_clanarine'] ?></option>
                                <?php foreach ($data['vrsteClanarine'] as $vrsta) : ?>
                                    <option>
                                        <?php echo $vrsta->ime_vrste_clanarine; ?>
                                    </option>
                                <?php endforeach;  ?>
                            </select>
                            <label for="labelvrsta_clanarine_ID">Vrsta članarine</label>

                            <span class="invalidFeedback">
                                <?php echo $data['vrsta_clanarine_IDError']; ?>
                            </span>
                        </div>

                        <div class="d-flex pt-1 mb-4 justify-content-center">
                            <button class="btn btn-dark btn-lg btn-block" style="width: 80%;" id="submit" value="submit" type="submit">Update</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</body>
<?php
require APPROOT . '/views/includes/footer.php';
?>

<script src="<?php echo URLROOT ?>/public/js/updateClanKnjiznice.js"></script>
<script src="<?php echo URLROOT ?>/public/vendor/jquery/jquery.min.js"></script>