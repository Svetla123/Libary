<!-- <div class="section-landing"> -->
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
              class="fw-normal mb-3 pb-3 text-center bottomBorder" style="letter-spacing: 1px;">Izradite račun</h1>
              
              <form 
                action="<?php echo URLROOT; ?>/korisnici/register"
                method ="POST">

                <!-- ime -->
                <div class="form-outline mb-4">
            
                    <input 
                    type="text" 
                    id="labelIme" 
                    name="ime_zaposlenika"
                    class="form-control form-control-lg border-bottom" />

                    <span class="invalidFeedback">
                      <?php echo $data['imeError']; ?>
                    </span>

                    <label 
                    class="form-label" 
                    for="labelIme">Ime zaposlenika</label>
                  </div>

                <!-- prezime -->
                  <div class="form-outline mb-4">
                    <input 
                    type="text" 
                    id="labelPrezime" 
                    name="prezime_zaposlenika"
                    class="form-control form-control-lg border-bottom" />

                    <span class="invalidFeedback">
                      <?php echo $data['prezimeError']; ?>
                    </span>

                    <label 
                    class="form-label" 
                    for="labelPrezime">Prezime zaposlenika</label>
                  </div>

                  <!-- datumRodenja -->
                  <div class="form-outline mb-4">
                    <input 
                    class="date border-bottom" 
                    type="date" 
                    name="datum_rodenja"
                    id="labelDatumRodenja"
                    style ="width: 100%; height:50px;" >

                    <span class="invalidFeedback">
                      <?php echo $data['datumRodenjaError']; ?>
                    </span>

                    <label 
                    class="form-label" 
                    for="labelDatumRodenja">Datum rođenja</label>
                  </div>

                  <!-- razina obrazovanja -->
                  <div class="form-outline mb-4">
                    <select 
                    class="form-control" 
                    id="labelRazinaObrazovanja"
                    name="razina_obrazovanja_ID"
                    style="height:50px;" >
                      <option>NKV</option>
                      <option>PKV</option>
                      <option>KV</option>
                      <option>VKV</option>
                      <option>NSS</option>
                      <option>SSS</option>
                      <option>VŠS</option>
                      <option>VSS</option>
                      <option>MR</option>
                      <option>DR</option>
                    </select>
                    <label for="labelRazinaObrazovanja">Razina obrazovanja</label>

                    <span class="invalidFeedback">
                      <?php echo $data['razinaObrazovanjaError']; ?>
                    </span>
                  </div>

                  <!-- vrstaZaposlenika-->
                  <div class="form-outline mb-4">
                    <select 
                      class="form-control" 
                      id="labelVrstaZaposlenika"
                      name="vrsta_zaposlenika_ID"
                      style="height:50px;" >
                        <option>Knjižničar</option>
                        <option>Pomoćni knjižničar</option>
                      </select>
                      <label for="labelVrstaZaposlenika">Radno mjesto</label>

                      <span class="invalidFeedback">
                        <?php echo $data['vrstaZaposlenikaError']; ?>
                      </span>
                  </div>


                  <!-- nadredeni-->
                  <div class="form-outline mb-4">
                    <select 
                        class="form-control" 
                        id="labelNadredeni"
                        name="nadreden_ID"
                        style="height:50px;">
                        <option>Nema</option>
                        <?php foreach($data['popisNadredenih'] as $nadredeni): ?>
                          <option><?php echo $nadredeni->ime_zaposlenika;?> <?php echo $nadredeni->prezime_zaposlenika ?></option>
                        <?php endforeach;  ?>
                     
                        </select>
                        <label for="labelNadredeni">Nadređeni radnik</label>
                  </div>

                  <!-- email-->
                  <div class="form-outline mb-4">
                    <input 
                    type="email" 
                    id="labelEmail"
                    name="email_zaposlenika" 
                    class="form-control form-control-lg border-bottom" />
  
                    <span class="invalidFeedback">
                      <?php echo $data['emailError']; ?>
                    </span>
  
                    <label class="form-label" for="labelEmail">Email adresa</label>
                  </div>

                <!-- lozinka-->
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
                    type="submit">Register</button>
                  </div>

                  <p class="mb-5 pb-lg-2" 
                  style="color: #393f81;">Već imate račun? <a href="<?php echo URLROOT;?>/korisnici/login"
                      style="color: #393f81;">Prijavite se ovdje!</a></p>
              </form>
              </div>
            </div>
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img 
                src ="<?php echo URLROOT; ?>/public/img/knjiznica.jpg"
                alt="login form" 
                class="img-fluid" 
                style="border-radius: 0 1rem 1rem 0; height: 100%;" />
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->
</section>

<?php
    require APPROOT . '/views/includes/footer.php';
?>
</div>
    <!-- <script>
// Data Picker Initialization

$(function(){
    $('.datepicker').datepicker({
        inline: true
    });
}); -->
<!-- </script> -->


  