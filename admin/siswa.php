<?php
    include('layout/header.php');
    include('layout/menu.php');
    include('layout/boxContent.php');
?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="page-header">
            <h4>Silahkan masukkan profil siswa!</h4>
        </div>
        <form class="form-horizontal" action="add_siswa.php" method="POST">
            <div class="form-group">
                <label for="namesiswa" class="col-lg-5 control-label" style="text-align:left">Nama Siswa </label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="namesiswa" placeholder="Nama" name="nama">
                </div>
            </div>
            <div class="form-group">
                <label for="nomorTes" class="col-lg-5 control-label" style="text-align:left">Nomor Tes</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="nomorTes" placeholder="Nomor Tes" name="nomor_tes">
                </div>
            </div>
            <div class="form-group">
                <label for="passwordSiswa" class="col-lg-5 control-label" style="text-align:left">Buat Password</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="passwordSiswa" placeholder="Password" name="password_siswa">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-5 col-lg-7">
                    <button type="submit" class="btn btn-default">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
    include('layout/footer.php');
?>