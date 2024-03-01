
<div class="modal fade" id="jumlahamount" tabindex="-1" aria-labelledby="jumlahamountLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Info Jumlah Amount</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php  foreach($amount as $dt){?>
                <div class="mb-5">
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" class="form-control w-100" id="currency" name="currency[]" value="<?= $dt->currency?>" required autocomplete="off" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="text" class="form-control w-100" id="amount"  value="<?= $dt->jumlah?>" required autocomplete="off" readonly>
                    </div>
                    <hr>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
