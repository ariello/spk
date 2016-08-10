<?php
    include('layout/header.php');
    include('layout/menu.php');
    include('layout/boxContent.php');
?>
<div class="row">
    <div class="col-lg-6 col-lg-offset-2">
        <div class="page-header">
            <h4>Silahkan input nilai siswa!</h4>
        </div>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="nomorTes" class="col-lg-4 control-label" style="text-align:left">Nomor Tes</label>
                <div class="col-lg-5">
                    <?php 
                        $options = '<option value="" selected>Please Select</option>';
                        include('../configure/database.php');
                        $strQuery = 'SELECT nis FROM t_siswa;';
                        $query = mysql_query($strQuery);
                        while($row = mysql_fetch_assoc($query)) {
                            $options .= '<option value="'.$row['nis'].'">'.$row['nis'].'</option>';
                        }
                    ?>
                    <select class="form-control" id="nisSelect">
                        <?php echo $options;?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-default" id="find-siswa">Cari</button>
                </div>
            </div>   
                
            <div class="form-group">
                <label for="namesiswa" class="col-lg-4 control-label" style="text-align:left">Nama Siswa </label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="namesiswa" placeholder="Nama" name="nama" readonly />
                </div>
            </div>
                    
            
            <div class="form-group">
                <label for="nilaiTest" class="col-lg-4 control-label" style="text-align:left">Nilai Tes</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-test-ipa" placeholder="IPA">
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-test-ips" placeholder="IPS">
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-default" id="calculate">Hitung</button>
                </div>
            </div>
            <div class="form-group">
                <label for="nilaiUn" class="col-lg-4 control-label" style="text-align:left">Nilai UN</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-un-ipa" placeholder="IPA">
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-un-ips" placeholder="IPS">
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-2">
        <div class="page-header">
            <h4>Skor Siswa</h4>
        </div>
        <div class="row">
            <form action="add_nilai.php" method="POST">
                <div class="form-group">
                    <label for="skorIpa"> Skor IPA</label>
                    <input type="text" class="form-control" id="skorIpa" name="ipa" readonly />
                </div>
                <div class="form-group">
                    <label for="skorIps"> Skor IPS</label>
                    <input type="text" class="form-control" id="skorIps" name="ips" readonly />
                    <input type="hidden" name="nis" id="nis-siswa"/>
                </div>
                <button type="submit" class="btn btn-default">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php
    include('layout/footer.php');
?>
<script>
    $(document).ready(function(){
        $('#find-siswa').click(function(){
            var selectVal = $('#nisSelect').val();
            if (selectVal) {
                $.ajax({url:'getSiswa.php',
                        data:{'nis': selectVal},
                        type: 'POST',
                        dataType: 'html',
                        success : function(result) {
                            $('#namesiswa').val(result);
                        }

                });
                 $('#nis-siswa').val(selectVal);
            }
        });
        $('#calculate').click(function(){
            var nilaiIPA = (($('#nilai-test-ipa').val() * 1) + ($('#nilai-un-ipa').val()*1))/2;
            var nilaiIPS = (($('#nilai-test-ips').val() * 1) + ($('#nilai-un-ips').val()*1))/2;
            $('#skorIpa').val(nilaiIPA);
            $('#skorIps').val(nilaiIPS);
        });
    });
</script>