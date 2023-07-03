<?php
session_start();
require_once 'ayar.php';
?>
<?php require_once 'layout/navbar.php'; ?>
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Ürün</th>
      <th scope="col">Stok</th>
      <th scope="col">Adet Sayacı</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
<?php
$sirano = 0;
$sorgu = $baglan->prepare("select * from urunler order by no asc");
$sorgu->execute();
foreach ($sorgu as $satir) {
    $sirano++;
    echo "<form action='sepet.php' method='get'>
    <tr>
      <th>$sirano</th>
      <td>$satir->baslik</td>
      <td>$satir->stok</td>
      <td>
        <input type='hidden' name='islem' value='ekle'>
        <input type='hidden' name='urun' value='$satir->no'>
        <input type='number' name='adet'>
      </td>
      <td><button class='btn btn-primary' type='submit'>Ekle</button></td>
    </tr>
    </form>";
}
$sorgu->closeCursor(); unset($sorgu);
?>
  </tbody>
</table>


<?php require_once 'layout/footer.php'; ?>