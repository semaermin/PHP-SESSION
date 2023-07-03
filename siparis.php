


<?php
session_start();
require_once 'ayar.php';
?>
<?php require_once 'layout/navbar.php'; ?>
<h3>
    Sepet (
        <?php 
        if (isset($_SESSION["sepet"]) && count($_SESSION["sepet"]) > 0)
        {
            echo intval(count($_SESSION["sepet"])) .' ' ;
        }
        else{
            echo '0 ';
        }; 
    ?>)
</h3>
<br><br>
<?php
if (isset($_SESSION["sepet"]) && count($_SESSION["sepet"]) > 0) {
    echo "<table class='table'>
    <thead>
      <tr>
        <th scope='col'>S.No</th>
        <th scope='col'>Ürün</th>
        <th scope='col'>Stok</th>
        <th scope='col'>İşlem</th>
      </tr>
    </thead>
    <tbody>";
    foreach ($_SESSION["sepet"] as $urun=>$adet) {
        $sirano = 0;
        $sorgu = $baglan->prepare("select * from urunler where no=?");
        $sorgu->execute(array($urun));
        foreach ($sorgu as $satir) {
            $sirano++;
            echo "<tr>
                    <td>$sirano</td>
                    <td>$satir->baslik</td>
                    <td>$adet</td>
                    <td><a class='btn btn-primary' href='sepet.php?islem=sil&urun=$urun' role='button'>Sil</a></td>
                </tr>";
        }
        $sorgu->closeCursor(); unset($sorgu);
    }
    echo "  </tbody>
    </table>";
    echo "<br><br><button class='btn btn-primary' type='button' onclick='window.location.href=\"sepet.php?islem=tamam\";'>Siparişi Tamamla</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button class='btn btn-primary' type='button' onclick='window.location.href=\"sepet.php?islem=bosalt\";'>Sepeti Boşalt</button>";
}
?>
<br><br>
<?php
$sorgu = $baglan->prepare("select * from siparis order by no desc");
$sorgu->execute();

echo "Db'de olan örnek siparişler:<br><br>";
foreach ($sorgu as $satir) {
    $adsoyad = $satir->adsoyad;
    $icerik = json_decode($satir->icerik, true);
    echo "$adsoyad => ";
    foreach ($icerik as $urun => $adet) {
        echo "$urun : $adet - ";
    }
    echo "<br>";
}
$sorgu->closeCursor(); unset($sorgu);
?>

<?php require_once 'layout/footer.php'; ?>