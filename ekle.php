
<?php
require_once 'ayar.php';

if ($_POST) {
  $name = $_POST["baslik"];
  $stok = $_POST["stok"];

  $sorgu = $baglan->prepare("insert into urunler (baslik,stok) values(?,?)");
  $sorgu->execute(array($name,$stok));
  if ($sorgu->rowCount() > 0) {
    $kayitno = $baglan->lastInsertId();
    echo "<script>
    alert('[ID: $kayitno] Kayıt Başarılı...');
    window.location.href='ekle.php';
    </script>";
  }
}
?>
<?php require_once 'layout/navbar.php'; ?>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100 p-5">
                            <div style="text-align:center">
                                <form action="ekle.php" method="post">
                                    <div class="form-outline">
                                        <label class="form-label" for="typeText">Ürün Adı</label>
                                        <input type="text" id="typeText" class="form-control m-1" name="baslik" />
                                    </div>
                                    <div class="form-outline">
                                        <label class="form-label" for="typeNumber">Stok Sayısı</label>
                                        <input type="number" id="typeNumber" class="form-control m-1"  name="stok"/>
                                    </div>
                                    <button class="btn btn-primary m-2" type="submit">Kaydet</button>
                                </form>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </section>

<?php require_once 'layout/footer.php'; ?>