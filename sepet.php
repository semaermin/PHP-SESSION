<?php
session_start();
require_once 'ayar.php';

$islem = $_GET["islem"];
$urun = intval($_GET["urun"]);
$adet = intval($_GET["adet"]);

//Ürün ekleme
if ($islem == "ekle") {
    if ($urun > 0) {
        if (isset($_SESSION["sepet"])) {
            if ($_SESSION["sepet"][$urun]) {
                unset($_SESSION["sepet"][$urun]);
            }
        }
        if ($adet > 0) {
            $_SESSION["sepet"][$urun] = $adet;
        } 
    }
}

//Ürün silme
else if ($islem == "sil") {
    if ($urun > 0) {
        if (isset($_SESSION["sepet"])) {
            if ($_SESSION["sepet"][$urun]) {
                unset($_SESSION["sepet"][$urun]);
            }
        }
    }
}

//Sipariş tamamla
else if ($islem == "tamam") {
    if (isset($_SESSION["sepet"]) && count($_SESSION["sepet"]) > 0) {
        $adsoyad = "Yeni Siparişin: ".rand(1111,9999);
        $icerik = json_encode($_SESSION["sepet"]);
        $sorgu = $baglan->prepare("insert into siparis values (?,?,?)");
        $sonuc = $sorgu->execute(array(NULL, $adsoyad, $icerik));
        $sorgu->closeCursor(); unset($sorgu);
        if ($sonuc) {
            unset($_SESSION["sepet"]);
        }
    }
}

//Sepeti boşaltma
else if ($islem == "bosalt") {
    if (isset($_SESSION["sepet"])) {
        unset($_SESSION["sepet"]);
    }
}

header("Location:index.php");

?>