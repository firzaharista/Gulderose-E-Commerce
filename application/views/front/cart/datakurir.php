<?php
$o = '';
if (!empty($data)) {
      $i = 0;
      foreach ($data as $row) {
            $i += 1;
            $tarif          = $row['cost'][0]['value'];
            $service        = $row['service'];
            $deskripsi      = $row['description'];
            $waktu          = $row['cost'][0]['etd'] ? $row['cost'][0]['etd'] : "-";
?>
            <div class="col-lg-12">
                  <div class="payment-order box float-left">
                        <label><input type="radio" name="service" class="service" data-id="<?= $i; ?>" value="<?= $service; ?>" required /> <?= $service; ?><?= " (" . $deskripsi . " )"; ?></label>
                        <input type="hidden" name="tarif" id="tarif<?= $i; ?>" value="<?= $tarif; ?>" required />
                        <p>
                              <span class='text-muted'>Cost <b><?= 'Rp. ' . number_format($tarif, 2, ',', '.'); ?></b></span><br>
                              <span class='text-muted'>Estimated <b><?= $waktu; ?> (days)</b></span>
                        </p>
                  </div>
            </div>
      <?php } ?>
      <script>
            $(document).ready(function() {
                  $(".service").each(function() {
                        $(this).on("change", function() {
                              var did = $(this).attr('data-id');
                              var tarif = $("#tarif" + did).val();
                              $("#ongkir").val(tarif);
                              hitung();
                        });
                  });
            });
      </script>
<?php
}
echo $o;
?>