<?php
    include('layout/header.php');
    include('layout/menu.php');
    include('layout/boxContent.php');
?>
<div class="row">
    <div class="col-lg-6 col-lg-offset-2">
        <div class="page-header">
            <h4>Edit data siswa!</h4>
        </div>
        <form class="form-horizontal" action="update_siswa.php" method="POST">
            <div class="form-group">
                <label for="nomorTes" class="col-lg-4 control-label" style="text-align:left">Nomor Tes</label>
                <div class="col-lg-5">
                    <?php 
                        $nis = $_REQUEST['nis'];
                        $options = '<option value="" selected>Please Select</option>';
                        include('../configure/database.php');
                        $strQuery = "SELECT t_siswa.nis as nis_siswa, t_siswa.nama as nama_siswa, t_siswa.password as password_siswa, t_nilai_rata2.ipa as nilai_ipa, 
                                        t_nilai_rata2.ips as nilai_ips,
                                        t_hasil_psikotes_bid_jurusan.ipa as psikotes_ipa,
                                        t_hasil_psikotes_bid_jurusan.ips as psikotes_ips
                                        FROM t_siswa 
                                        LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
                                        LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis 
                                        WHERE t_siswa.nis = '$nis'";
                        $query = mysql_query($strQuery);
                        $row = mysql_fetch_assoc($query);
                        //echo '<pre>'; die(var_dump($row));
                    ?>
                    <input type="text" class="form-control" id="nomorTes" name="nis" value="<?php echo $row['nis_siswa'];?>" readonly />
                </div>
            </div>   
                
            <div class="form-group">
                <label for="namesiswa" class="col-lg-4 control-label" style="text-align:left">Nama Siswa </label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" id="namesiswa" placeholder="Nama" name="nama" value="<?php echo $row['nama_siswa'];?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-4 control-label" style="text-align:left">Password</label>
                <div class="col-lg-5">
                    <input type="password" class="form-control" id="password"  name="password" value="<?php echo $row['password_siswa'];?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="nilaiTest" class="col-lg-4 control-label" style="text-align:left"></label>
                <label for="nilaiTest" class="col-lg-2 control-label" style="text-align:left">IPA</label>
                <label for="nilaiTest" class="col-lg-2 control-label" style="text-align:left">IPS</label>
            </div>
            <div class="form-group">
                <label for="nilaiTest" class="col-lg-4 control-label" style="text-align:left">Nilai</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-test-ipa" placeholder="IPA" name="nilai_ipa" value="<?php echo $row['nilai_ipa'];?>">
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="nilai-test-ips" placeholder="IPS" name="nilai_ips" value="<?php echo $row['nilai_ips'];?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="nilaiUn" class="col-lg-4 control-label" style="text-align:left">Psikotes</label>
                <div class="col-lg-3">
                    <select class="form-control" name="psikotes_ipa" placeholder="IPA">
                        <?php 
                            $optionValue = array('Sangat Tinggi', 'Tinggi', 'Sedang', 'Rendah', 'Sangat Rendah');
                            foreach ($optionValue as $value) {
                                $selected = '';
                                if ($value == $row['psikotes_ipa']) {
                                    $selected = 'selected';
                                }
                        ?>
                        <option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $value;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-control" name="psikotes_ips" placeholder="IPA">
                        <?php 
                            $optionValue = array('Sangat Tinggi', 'Tinggi', 'Sedang', 'Rendah', 'Sangat Rendah');
                            foreach ($optionValue as $value) {
                                $selected = '';
                                if ($value == $row['psikotes_ips']) {
                                    $selected = 'selected';
                                }
                        ?>
                        <option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $value;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-default">Simpan</button>
        </form>
    </div>
</div>
<?php
    include('layout/footer.php');
?>