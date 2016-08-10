<?php
    include('layout/header.php');
    include('layout/menu.php');
    include('layout/boxContent.php');
?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="page-header">
            <h4>Silahkan input hasil psikotes siswa!</h4>
        </div>
        <form class="form-horizontal" action="add_psikotes.php">
            <div class="form-group">
                <label for="nomorTes" class="col-lg-4 control-label" style="text-align:left">Nomor Tes</label>
                <div class="col-lg-5">
                    <?php 
                        $options = '<option value="">Please Select</option>';
                            include('../configure/database.php');
                            $strQuery = 'SELECT nis FROM t_siswa;';
                            $query = mysql_query($strQuery);
                            while($row = mysql_fetch_assoc($query)) {
                                $options .= '<option value="'.$row['nis'].'">'.$row['nis'].'</option>';
                            }
                        ?>
                    <select class="form-control" id="nisSelect" name="nis">
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
                    <input type="text" class="form-control" id="namesiswa" placeholder="Nama" readonly />
                </div>
            </div>
                    
            
            <div class="form-group">
                <label for="nilaiTest" class="col-lg-4 control-label" style="text-align:left">Skor Psikotes</label>
                <div class="col-lg-4">
                    <select class="form-control" name="ipa" placeholder="IPA">
                        <option value="" selected>IPA</option>
                        <option value="Sangat Tinggi">Sangat Tinggi</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sangat Rendah">Sangat Rendah</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select class="form-control" name="ips">
                        <option value="" selected>IPS</option>
                        <option value="Sangat Tinggi">Sangat Tinggi</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sangat Rendah">Sangat Rendah</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-4 col-lg-7">
                    <button type="submit" class="btn btn-default">Simpan</button>
                </div>
            </div>
        </form>
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