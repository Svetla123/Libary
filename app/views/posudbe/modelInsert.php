<?php
require APPROOT . '/views/includes/headPosudbe.php';
?>
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="opacity:1 !important;">
    <form action="<?php echo URLROOT ?>/posudbe/idnex" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova posudba br. <?php echo $data['brojPosudbe'] + 1 ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- datum posudbe -->
                <div class="form-group">
                    <div class="text-center">
                        <label for="recipient-name" class="col-form-label text-center">Datum posudbe</label>
                    </div>
                    <input type='date' class="form-control" name="datum_posudbe" style="width: 90%; margin-left:25px;" />
                </div>

                <!-- clan knjiznice -->
                <div class=" form-group">
                    <div class="text-center">
                        <label for="recipient-name" class="col-form-label text-center">Član knjižnice</label>
                    </div>
                    <select class="form-control" name="clan_knjiznice_ID" style="width: 90%; margin-left:25px;">
                        <option selected value>ID Član</option>
                        <?php foreach ($data['clanoviKnjiznice'] as $clan) : ?>
                            <option>
                                <?php echo $clan->clan_knjiznice_ID . " " . $clan->ime_clana . " " . $clan->prezime_clana; ?>
                            <?php endforeach;  ?>
                            </option>
                    </select>
                </div>

                <!-- knjige -->
                <div class="form-group">
                    <div class="text-center">
                        <label for="recipient-name" class="col-form-label">Knjiga</label>
                    </div>
                    <select class="form-control" name="inventarni_broj_ID" style="width: 90%; margin-left:25px;">
                        <option selected value> BROJ Knjiga</option>
                        <?php foreach ($data['slobodneKnjige'] as $knjiga) : ?>
                            <option>
                                <?php echo $knjiga->inventarni_broj_ID . " " . $knjiga->naslov_knjige; ?>
                            <?php endforeach;  ?>
                            </option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Prekid</button>
                    <button type="submit" name="submit" class="btn btn-secondary">Napravi posudbu</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script>
    $('#insertModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<!-- table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/public/js/tableClanarine.js"></script>
<script src="<?php echo URLROOT ?>/public/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT ?>/public/js/popper.js"></script>
<!-- date picker -->
<script src="<?php echo URLROOT ?>/public/js/rome.js"></script>
<script src="<?php echo URLROOT ?>/public/js/datepicker.js"></script>
</body>