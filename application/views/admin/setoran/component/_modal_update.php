<div class="modal fade" id="updatepenukaran<?= $id?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penukaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-start">
                    <form class="w-100" action="<?= base_url()?>kas/update_penukaran_process" method="POST">
                            <?php  foreach($detail as $dt){?>
                                <input type="hidden"  name="id[]" value="<?= $dt->id?>">
                                
                                <div class="mb-5">
                                    <div class="mb-3">
                                        <label for="currency" class="form-label">Currency</label>
                                        <input type="text" class="form-control w-100" id="currency" name="currency[]" value="<?= $dt->currency?>" required autocomplete="off" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="text" class="form-control w-100" id="amount"  value="<?= $dt->jumlah?>" required autocomplete="off" readonly>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="rate" class="form-label">Rate</label>
                                        <input type="text" class="form-control w-100 money-input" id="rate" name="rate[]" value="<?php echo ($dt->rate != '0.00') ? $dt->rate : '' ?>" placeholder="Masukkan rate ..." required autocomplete="off" >
                                    </div>
                                </div>
                                <hr>
                                
                            <?php }?>
                        <button type="submit" class="btn btn-expat mt-3">Update Penukaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.8.2/autoNumeric.js"></script>
<script>
        $(".money-input").autoNumeric('init', {
		    aSep: ',',
			aDec: '.',
			aForm: true,
			vMax: '999999999999999999.99',
			vMin: '0.00'
		});
</script>