<?php
require APPROOT . '/views/includes/headPosudbe.php';
?>
<div class="modal fade" id="modelUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php var_dump($posudba->posudena_knjiga_ID) ?>
    <form action="<?php echo URLROOT ?>/posudbe/update/<?php echo $posudba->posudena_knjiga_ID ?>" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Posudba br. <?php echo $data['brojPosudbe'] + 1 ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- datum vracanja posudbe -->
                <div class="form-group">
                    <div class="text-center">
                        <label for="recipient-name" class="col-form-label text-center">Datum vracanja</label>
                    </div>
                    <input type='date' class="form-control" name="datum_vracanja" style="width: 90%; margin-left:25px;" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Prekid</button>
                    <button type="submit" name="submit" class="btn btn-secondary">Vrati knjigu</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<script>
    $('#modelUpdate').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
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