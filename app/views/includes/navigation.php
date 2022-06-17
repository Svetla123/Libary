<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom border-secondary bg-dark">
    <a href="<?php echo URLROOT; ?>/index" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-white text-decoration-none">
        <img src="<?php echo URLROOT; ?>/public/img/logoLibary.png" class="logoImage d-inline-block">
        GK Ivanić-Grad
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:#ffffff;">Članovi</a>
            <div class="dropdown-menu">
                <a href="<?php echo URLROOT; ?>/clanoviKnjiznice/index" class="dropdown-item">Profil</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URLROOT; ?>/clanarine/index" class="dropdown-item">Članarine</a>
            </div>

        <li><a href="<?php echo URLROOT; ?>/posudbe/index" class="nav-link px-2 text-white">
                Posudbe</a></li>
        <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:#ffffff;">Knjige</a>
            <div class="dropdown-menu">
                <a href="<?php echo URLROOT; ?>/knjige/index" class="dropdown-item">Naslovi</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URLROOT; ?>/inventari/index" class="dropdown-item">Inventar</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color:#ffffff;">Pisci</a>
            <div class="dropdown-menu">
                <a href="<?php echo URLROOT; ?>/autori/index" class="dropdown-item">Autori</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo URLROOT; ?>/prevoditelji/index" class="dropdown-item">Prevoditelji</a>
            </div>
        </li>
        <!-- <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 text-white">About</a></li> -->
    </ul>

    <div class="col-md-3 text-end">

        <?php if (isset($_SESSION['zaposlenik_ID'])) : ?>
            <a type="button" class="btn btn-outline-secondary me-2" href="<?php echo URLROOT; ?>/korisnici/logout">
                Odjava</a>

        <?php else : ?>
            <a type="button" class="btn btn-outline-secondary me-2" href="<?php echo URLROOT; ?>/korisnici/login">
                Prijava</a>

            <a type="button" class="btn btn-secondary" href="<?php echo URLROOT; ?>/korisnici/register">
                Registracija</a>
        <?php endif; ?>
    </div>
</header>