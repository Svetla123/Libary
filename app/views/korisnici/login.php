<div class="section-landing">
    <?php
       require APPROOT . '/views/includes/head.php';
    ?>
    
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>

<section class="vh-70 h-70">
  <div class="container py-5 h-90">
    <div class="row d-flex justify-content-center align-items-center h-70">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img 
                src ="<?php echo URLROOT; ?>/public/img/knjiznica.jpg"
                alt="login form" 
                class="img-fluid" 
                style="border-radius: 1rem 0 0 1rem; height: 100%;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                
                <div 
                class="d-flex align-items-center mb-3 pb-1">
                <img 
                src ="<?php echo URLROOT; ?>/public/img/logoLibary.png"
                class="img-fluid rounded loginImage mx-auto d-block"
                style ="width: 100px; height: 100px;">
              </div>
              
              <h1 
              class="fw-normal mb-3 pb-3 text-center bottomBorder" style="letter-spacing: 1px;">Prijava na račun</h1>
              
              <form 
                action="<?php echo URLROOT; ?>/korisnici/login"
                method ="POST">
                  <div class="form-outline mb-4 emailInput">

                    <input 
                    type="email" 
                    id="labelEmail" 
                    name="email_zaposlenika"
                    class="form-control form-control-lg border-bottom"/>

                    <span class="invalidFeedback">
                      <?php echo $data['emailError']; ?>
                    </span>

                    <label 
                    class="form-label" 
                    for="labelEmail">Email adresa</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input 
                    type="password" 
                    id="labelLozinka"
                    name="lozinka" 
                    class="form-control form-control-lg border-bottom" />

                    <span class="invalidFeedback">
                      <?php echo $data['lozinkaError']; ?>
                    </span>

                    <label class="form-label" for="labelLozinka">Lozinka</label>
                  </div>

                  <div class="d-flex pt-1 mb-4 justify-content-center">
                    <button 
                    class="btn btn-dark btn-lg btn-block"
                    style ="width: 100%;"
                    id="submit" 
                    value="submit"
                    type="submit">Login</button>
                  </div>

                  <p class="mb-5 pb-lg-2" 
                  style="color: #393f81;">Nemaš račun? <a href="<?php echo URLROOT;?>/korisnici/register"
                      style="color: #393f81;">Registriraj se ovdje!</a></p>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
<?php
    require APPROOT . '/views/includes/footer.php';
?>
<!-- bootstrap -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>