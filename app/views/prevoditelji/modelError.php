<?php
require APPROOT . '/views/includes/headPosudbe.php';
?>
<div class="modal fade" id="modelError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="opacity:1 !important;">
    <form action="<?php echo URLROOT ?>/posudbe/idnex" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upozoronje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php if ($data['datum_posudbeError']) : ?>
                    <div class="form-group">
                        <span class="invalidFeedback">
                            <?php echo '-➤' . $data['datum_posudbeError']; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($data['clan_knjiznice_IDError']) : ?>
                    <div class="form-group">
                        <span class="invalidFeedback">
                            <?php echo '-➤' . $data['clan_knjiznice_IDError']; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($data['inventarni_broj_IDError']) : ?>
                    <div class="form-group">
                        <span class="invalidFeedback">
                            <?php echo '-➤' . $data['inventarni_broj_IDError']; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($data['clanarinaError']) : ?>
                    <div class="form-group">
                        <span class="invalidFeedback">
                            <?php echo '-➤' . $data['clanarinaError']; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($data['datum_vracanjaError']) : ?>
                    <div class="form-group">
                        <span class="invalidFeedback">
                            <?php echo '-➤' . $data['datum_vracanjaError']; ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Uredu</button>
                </div>
            </div>
        </div>
</div>
</form>
</div>
</div>
<script>
    $('#modelError').on('show.bs.modal', function(event) {
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