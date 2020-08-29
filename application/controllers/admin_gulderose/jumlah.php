<html>
<form action="jumlah.php" method="POST" enctype="multipart/form-data">
      A : <input type="text" name="a" id="a">
      B : <input type="text" name="b" id="b">
      <button type="submit" name="submit">Tambah</button>
      <!-- <button type="submit" name="submit"> -->
</form>

<?php
error_reporting("E_ALL^E_DEPRECATED");
$a = $_POST['a'];
$b = $_POST['b'];
$hasil = $a + $b;
$submit = $_POST['submit'];
if ($submit) {
      // $hasil = $a+$b;
      echo $hasil;
}
?>

</html>