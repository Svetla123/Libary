<?php
require APPROOT . '/views/includes/head.php';
?>

<?php
require APPROOT . '/views/includes/navigation.php';
?>

<body data-new-gr-c-s-check-loaded="14.1062.0" data-gr-ext-installed="">
    <nav class="notificaticationHead">
        <ul>
            <li>
                <a class="memberHeader" href="<?php echo URLROOT; ?>/clanoviKnjiznice/index">
                    <h1>Članovi knjižnice</h1>
                </a>
            </li>
        </ul>
    </nav>

    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">

                    <table id="tableMembers">
                        <thead>
                            <tr class="table100-head">
                                <th class="column1">Broj</th>
                                <th class="column2">Ime</th>
                                <th class="column3">Prezime</th>
                                <th class="column4">Adresa</th>
                                <th class="column5">Email</th>
                                <th class="column6">Mobitel</th>
                                <th class="column7">Grad</th>
                                <th class="column8">Vrsta članarine</th>
                                <th class="column9">Status</th>
                                <th class="column10">Posudbe</th>
                                <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                                    <th class="column11"></th>
                                    <th class="column12"></th>
                                    <th class="column13"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                                <tr>
                                    <form action="<?php echo URLROOT ?>/clanoviKnjiznice/index" method="POST">

                                        <td class="column1">
                                            <input class="clan_knjiznice_ID form-control adding border-bottom" type="text" name="clan_knjiznice_ID" style="height:25px;
                                    font-size: 12px;
                                    width: 50px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['clan_knjiznice_IDError']; ?>
                                            </span>
                                        </td>

                                        <td class="column2">
                                            <input class="ime_clana form-control adding" type="text" name="ime_clana" style="height:25px;
                                    font-size: 12px;
                                    width: 100px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['ime_clanaError']; ?>
                                            </span>
                                        </td>

                                        <td class="column3">
                                            <input class="prezime_clana form-control adding" type="text" name="prezime_clana" style="height:25px;
                                    font-size: 12px;
                                    width: 100px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['prezime_clanaError']; ?>
                                            </span>
                                        </td>

                                        <td class="column4">
                                            <input class="adresa_clana form-control adding" type="text" name="adresa_clana" style="height:25px;
                                    font-size: 12px;
                                    width: 125px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['adresa_clanaError']; ?>
                                            </span>
                                        </td>

                                        <td class="column5">
                                            <input class="email_clana form-control adding" type="email" name="email_clana" style="height:25px;
                                    font-size: 12px;
                                    width: 170px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['email_clanaError']; ?>
                                            </span>
                                        </td>

                                        <td class="column6">
                                            <input class="telefosnki_broj_clana form-control adding" type="text" name="telefosnki_broj_clana" style="height:25px;
                                    font-size: 12px;
                                    width: 120px;
                                    text-align: center;">
                                            <span class=" invalidFeedback">
                                                <?php echo $data['telefosnki_broj_clanaError']; ?>
                                            </span>
                                        </td>

                                        <td class="column7">

                                            <select class="form-control" id="labelNadredeni" name="grad_ID" style="height:30px;
                                    font-size: 12px;
                                    width: 95px;
                                    text-align: center;
                                ">
                                                <option selected value></option>
                                                <?php foreach ($data['gradovi'] as $grad) : ?>
                                                    <option>
                                                        <?php echo $grad->ime_grada; ?>
                                                    <?php endforeach;  ?>
                                                    </option>
                                            </select>
                                            <span class="invalidFeedback">
                                                <?php echo $data['grad_IDError']; ?>
                                            </span>
                                        </td>

                                        <td class="column8">
                                            <select class="form-control" id="labelNadredeni" name="vrsta_clanarine_ID" style="height:30px;
                                        font-size: 12px;
                                        width: 95px;
                                        text-align: center;
                                    ">
                                                <option selected value></option>
                                                <?php foreach ($data['vrsteClanarine'] as $vrsta) : ?>
                                                    <option>
                                                        <?php echo $vrsta->ime_vrste_clanarine; ?>
                                                    <?php endforeach;  ?>
                                                    </option>
                                            </select>
                                            <span class="invalidFeedback">
                                                <?php echo $data['vrsta_clanarine_IDError']; ?>
                                            </span>
                                        </td>

                                        <td class="column12">
                                            <button name="submit" type="submit">
                                                <a class="nav-link icon" href="<?php echo URLROOT; ?>/clanoviKnjiznice/index">
                                                    <i class="fa fa-solid fa-plus"></i>
                                                </a>
                                            </button>
                                        </td>
                                </tr>
                            <?php endif; ?>


                            <?php foreach ($data['clanoviKnjiznice'] as $clan) : ?>
                                <tr>
                                    <td class="column1"><?php echo $clan->clan_knjiznice_ID; ?></td>
                                    <td class="column2"><?php echo $clan->ime_clana; ?></td>
                                    <td class="column3"><?php echo $clan->prezime_clana; ?></td>
                                    <td class="column4"><?php echo $clan->adresa_clana; ?></td>
                                    <td class="column5"><?php echo $clan->email_clana; ?></td>
                                    <td class="column6"><?php echo $clan->telefosnki_broj_clana; ?></td>
                                    <td class="column7"><?php echo $clan->ime_grada; ?></td>
                                    <td class="column8"><?php echo $clan->ime_vrste_clanarine; ?></td>
                                    <td class="column9">
                                        <?php if ($clan->clanarina_vrijedi == 1) : ?>
                                            <p class="text-success" style="font-size: 12px;"><?php echo "Aktivno"; ?></p>
                                        <?php else : ?>
                                            <p class="text-danger" style="font-size: 12px;"><?php echo "Neaktivno"; ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="column10"><?php echo $clan->broj_posudba; ?></td>

                                    <?php if (isLoggedIn('zaposlenik_ID')) : ?>
                                        <td class="column11">
                                            <a class="nav-link icon" href="<?php echo URLROOT . "/clanoviKnjiznice/update/" . $clan->clan_knjiznice_ID ?>">
                                                <i class="fa-solid fa-wrench"></i>
                                            </a>
                                        </td>

                                        <!-- href ="<?php echo URLROOT . "/clanoviKnjiznice/delete/" . $clan->clan_knjiznice_ID ?>" -->
                                        <td class="column12">
                                            <form action="<?php echo URLROOT . "/clanoviKnjiznice/delete/" . $clan->clan_knjiznice_ID ?>" method="POST">
                                                <button name="delete" type="submit" class="btnDelete" onclick="return confirm('Izbrisati člana: <?php echo $clan->prezime_clana ?> <?php echo $clan->ime_clana ?>?')">
                                                    <a class="nav-link icon">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </button>
                                            </form>
                                        </td>

                                        <td class="column13">
                                            <a class="nav-link icon" href="<?php echo URLROOT . "/clanoviKnjiznice/update/" . $clan->clan_knjiznice_ID ?>">
                                                <i class="fa fa-solid fa-comment-dollar"></i>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- bootstrap -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/public/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT ?>/public/js/popper.js"></script>
<!-- date picker -->
<script src="<?php echo URLROOT ?>/public/js/rome.js"></script>
<script src="<?php echo URLROOT ?>/public/js/datepicker.js"></script>

<?php
require APPROOT . '/views/includes/footer.php';
?>
</div>