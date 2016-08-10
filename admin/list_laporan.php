<?php
set_time_limit(0);

if ($_REQUEST['button'] == 'cetak') {
    // Include the main TCPDF library (search for installation path).
    require_once('../library/tcpdf.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    //$pdf->SetCreator(PDF_CREATOR);
    //$pdf->SetAuthor('Nicola Asuni');
    //$pdf->SetTitle('TCPDF Example 006');
    //$pdf->SetSubject('TCPDF Tutorial');
    //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'LAPORAN SISWA', '');

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();
    
    $nisGet = (!empty($_REQUEST['nis']) ? '&nis='.$_REQUEST['nis'] : '');
    $namaGet = (!empty($_REQUEST['nama']) ? '&nama='.$_REQUEST['nama'] : '');
    $nisQuery = (!empty($_REQUEST['nis']) ? $_REQUEST['nis'] : '');
    $namaQuery = (!empty($_REQUEST['nama']) ? $_REQUEST['nama'] : '');

    $where = '';
    if (!empty($nisQuery)) {
        $where = "WHERE siswa.nis LIKE '%$nisQuery%'";
    } 
    if (!empty($namaQuery) && empty($where)) {
        $where = "WHERE siswa.nama LIKE '%$namaQuery%'";
    } else if (!empty($namaQuery) && !empty($where)) {
        $where .= " AND siswa.nama LIKE '%$namaQuery%'";
    }

    include('../configure/database.php');
    $leftJoin = "LEFT JOIN 
                    (SELECT
                        IF (psikotes_ipa >= psikotes_ips,'IPA','IPS') AS rekomendasi_psikotes,nis
                    FROM
                        (SELECT
                            (CASE
                                WHEN hasil.ipa = 'Sangat Tinggi' THEN 100
                                WHEN hasil.ipa = 'Tinggi' THEN 80
                                WHEN hasil.ipa = 'Sedang' THEN 60
                                WHEN hasil.ipa = 'Rendah' THEN 40
                                WHEN hasil.ipa = 'Sangat Rendah' THEN 20
                            END) AS psikotes_ipa,
                            (CASE
                                WHEN hasil.ips = 'Sangat Tinggi' THEN 100
                                WHEN hasil.ips = 'Tinggi' THEN 80
                                WHEN hasil.ips = 'Sedang' THEN 60
                                WHEN hasil.ips = 'Rendah' THEN 40
                                WHEN hasil.ips = 'Sangat Rendah' THEN 20
                            END) AS psikotes_ips,
                            hasil.nis
                        FROM  t_hasil_psikotes_bid_jurusan AS hasil
                        ) AS keyas
                    ) AS example ON example.nis = siswa.nis
                LEFT JOIN 
                    (SELECT
                        (CASE
                            WHEN t_nilai_rata2.ipa >= t_nilai_rata2.ips THEN 'IPA'
                            ELSE 'IPS'
                        END) AS rekomendasi_nilai,
                        nis
                        FROM t_nilai_rata2
                ) AS example2 ON example2.nis = siswa.nis
                LEFT JOIN 
                    (SELECT
                        (CASE
                            WHEN t_minat.ipa >= t_minat.ips THEN 'IPA'
                            ELSE(IF (t_minat.ips != '', 'IPS', NULL))
                        END) AS rekomendasi_minat,
                        nis
                        FROM t_minat
                ) AS example3 ON example3.nis = siswa.nis ";

        $strQuery = "SELECT
                    siswa.nis AS nis_siswa,
                    siswa.nama AS nama_siswa,
                    t_nilai_rata2.ipa AS nilai_ipa,
                    t_nilai_rata2.ips AS nilai_ips,
                    t_hasil_psikotes_bid_jurusan.ipa AS psikotes_ipa,
                    t_hasil_psikotes_bid_jurusan.ips AS psikotes_ips,
                    t_minat.ipa AS minat_ipa,
                    t_minat.ips AS minat_ips,
                    rekomendasi_minat, rekomendasi_psikotes, rekomendasi_nilai,
                    IF (rekomendasi_psikotes = rekomendasi_minat, rekomendasi_psikotes, rekomendasi_nilai) AS rekomendasi
                FROM
                    t_siswa AS siswa
                LEFT JOIN t_nilai_rata2 ON siswa.nis = t_nilai_rata2.nis
                LEFT JOIN t_hasil_psikotes_bid_jurusan ON siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                LEFT JOIN t_minat ON siswa.nis = t_minat.nis
                $leftJoin
                $where
                ORDER BY siswa.nis ASC";
    //die(var_dump($strQuery));
    $query = mysql_query($strQuery);
    $i = 1;
    $detail='';
    while($row = mysql_fetch_assoc($query)) {
        
        $skor = array();
        if ($row['rekomendasi_minat'] == 'IPA') {
            $skor['ipa'] = 35;
        } else if ($row['rekomendasi_minat'] == 'IPS') {
            $skor['ips'] = 35;
        }
        if ($row['rekomendasi_nilai'] == 'IPA') {
            $skor['ipa'] += 48;
        } else if ($row['rekomendasi_nilai'] == 'IPS') {
            $skor['ips'] += 48;
        }
        if ($row['rekomendasi_psikotes'] == 'IPA') {
            $skor['ipa'] += 17;
        } else if ($row['rekomendasi_psikotes'] == 'IPS') {
            $skor['ips'] += 17;
        }
        $detail .='<tr>
                    <td style="text-align:center;width:5%;font-size:8px;">'.$i.'</td>
                    <td style="text-align:center;width:10%;font-size:8px;">'.$row['nis_siswa'].'</td>
                    <td style="width:15%;font-size:8px;">'.$row['nama_siswa'].'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.$row['nilai_ipa'].'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.$row['nilai_ips'].'</td>
                    <td style="text-align:center;width:10%;font-size:8px;">'.$row['psikotes_ipa'].'</td>
                    <td style="text-align:center;width:10%;font-size:8px;">'.$row['psikotes_ips'].'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.(!empty($row['minat_ipa']) ? $row['minat_ipa'].'%' : '').'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.(!empty($row['minat_ips']) ? $row['minat_ips'].'%' : '').'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.(!empty($skor['ipa']) ? $skor['ipa'].'%' : '').'</td>
                    <td style="text-align:center;width:6%;font-size:8px;">'.(!empty($skor['ips']) ? $skor['ips'].'%' : '').'</td>
                    <td style="text-align:center;width:10%;font-size:8px;">'.$row['rekomendasi'].'</td>
                </tr>';
        
            $i++;
    }
    $table = '<table border="1" cellpadding="2">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:5%;font-size:8px;">No</th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:10%;font-size:8px;">Nomor Tes</th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:15%;font-size:8px;">Nama</th>
                        <th colspan="2" style="text-align:center;width:12%;font-size:8px;">Nilai</th>
                        <th colspan="2" style="text-align:center;width:20%;font-size:8px;">Psikotes</th>
                        <th colspan="2" style="text-align:center;width:12%;font-size:8px;">Minat</th>
                        <th colspan="2" style="text-align:center;width:12%;font-size:8px;">Skor</th>
                        <th rowspan="2" style="text-align:center;width:10%;font-size:8px;">Rekomendasi</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;font-size:8px;">IPA</th>
                        <th style="text-align:center;font-size:8px;">IPS</th>
                        <th style="text-align:center;font-size:8px;">IPA</th>
                        <th style="text-align:center;font-size:8px;">IPS</th>
                        <th style="text-align:center;font-size:8px;">IPA</th>
                        <th style="text-align:center;font-size:8px;">IPS</th>
                        <th style="text-align:center;font-size:8px;">IPA</th>
                        <th style="text-align:center;font-size:8px;">IPS</th>
                    </tr>
                </thead>
                <tbody>
                    '.$detail.'
                </tbody>
            </table>';
    //echo'<pre>';die(var_dump($table));
    // output the HTML content
    $pdf->writeHTML($table, true, false, true, false, '');
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('data_laporan.pdf', 'I');
} else {
    include('layout/header.php');
    include('layout/menu.php');
    include('layout/boxContent.php');
?>
<style>
    .vcenter {
        vertical-align: middle !important;

    }
    .small-size {
        font-size : 10px;
    }
    .medium-size {
        font-size : 12px;
    }
</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                                <h3 class="panel-title medium-size">Cari Data</h3>
                        </div>
                        <div class="panel-body">
                            <form id="searchSiswa" method="get" action="list_laporan.php" class="form-horizontal">
                                <div class="form-group">
                                    <label for="namesiswa" class="col-lg-4 control-label medium-size" style="text-align:left">Nomor Test </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="namesiswa" name="nis" value="<?php echo $_REQUEST['nis']; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="namesiswa" class="col-lg-4 control-label medium-size" style="text-align:left">Nama Siswa </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="namesiswa" name="nama" value="<?php echo $_REQUEST['nama']; ?>"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger medium-size">Cari</button>
                                <a href="list_laporan.php"><button type="button" class="btn btn-danger medium-size">Batal</button></a>
                                <button type="submit" class="btn btn-danger medium-size" name="button" value="cetak">Print</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $nisGet = (!empty($_REQUEST['nis']) ? '&nis='.$_REQUEST['nis'] : '');
                $namaGet = (!empty($_REQUEST['nama']) ? '&nama='.$_REQUEST['nama'] : '');
                //echo'<pre>';die(var_dump($_REQUEST, $_ENV));
                $nisQuery = (!empty($_REQUEST['nis']) ? $_REQUEST['nis'] : '');
                $namaQuery = (!empty($_REQUEST['nama']) ? $_REQUEST['nama'] : '');
                
                $where = '';
                if (!empty($nisQuery)) {
                    $where = "WHERE siswa.nis LIKE '%$nisQuery%'";
                } 
                if (!empty($namaQuery) && empty($where)) {
                    $where = "WHERE siswa.nama LIKE '%$namaQuery%'";
                } else if (!empty($namaQuery) && !empty($where)) {
                    $where .= " AND siswa.nama LIKE '%$namaQuery%'";
                }
                
                include('../configure/database.php');
                $leftJoin = "LEFT JOIN 
                                        (SELECT
                                            IF (psikotes_ipa >= psikotes_ips,'IPA','IPS') AS rekomendasi_psikotes,nis
                                        FROM
                                            (SELECT
                                                (CASE
                                                    WHEN hasil.ipa = 'Sangat Tinggi' THEN 100
                                                    WHEN hasil.ipa = 'Tinggi' THEN 80
                                                    WHEN hasil.ipa = 'Sedang' THEN 60
                                                    WHEN hasil.ipa = 'Rendah' THEN 40
                                                    WHEN hasil.ipa = 'Sangat Rendah' THEN 20
                                                END) AS psikotes_ipa,
                                                (CASE
                                                    WHEN hasil.ips = 'Sangat Tinggi' THEN 100
                                                    WHEN hasil.ips = 'Tinggi' THEN 80
                                                    WHEN hasil.ips = 'Sedang' THEN 60
                                                    WHEN hasil.ips = 'Rendah' THEN 40
                                                    WHEN hasil.ips = 'Sangat Rendah' THEN 20
                                                END) AS psikotes_ips,
                                                hasil.nis
                                            FROM  t_hasil_psikotes_bid_jurusan AS hasil
                                            ) AS keyas
                                        ) AS example ON example.nis = siswa.nis
                                    LEFT JOIN 
                                        (SELECT
                                            (CASE
                                                WHEN t_nilai_rata2.ipa >= t_nilai_rata2.ips THEN 'IPA'
                                                ELSE 'IPS'
                                            END) AS rekomendasi_nilai,
                                            nis
                                            FROM t_nilai_rata2
                                    ) AS example2 ON example2.nis = siswa.nis
                                    LEFT JOIN 
                                        (SELECT
                                            (CASE
                                                WHEN t_minat.ipa >= t_minat.ips THEN 'IPA'
                                                ELSE(IF (t_minat.ips != '', 'IPS', NULL))
                                            END) AS rekomendasi_minat,
                                            nis
                                            FROM t_minat
                                    ) AS example3 ON example3.nis = siswa.nis ";
                        
                        $strCount = "SELECT
                                        count(*)
                                    FROM
                                        t_siswa AS siswa
                                    LEFT JOIN t_nilai_rata2 ON siswa.nis = t_nilai_rata2.nis
                                    LEFT JOIN t_hasil_psikotes_bid_jurusan ON siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                                    LEFT JOIN t_minat ON siswa.nis = t_minat.nis
                                    $leftJoin
                                    $where
                                    ";
                $queryCount = mysql_query($strCount);
                //die(var_dump($strCount));
                $rowCount = mysql_fetch_row($queryCount);
                
                $totalData = $rowCount[0];
                $limit = 5;
                $totalPage = ceil($totalData/$limit);
                $pageCurrent = (!empty($_REQUEST['page']) ? $_REQUEST['page'] : 1);
                $pageQuery = ($pageCurrent*$limit) - $limit;
            ?>
            <nav aria-label="">
                <ul class="pagination small-size" style="margin: 5px 0px">
                    <?php
                        if ($totalPage == 1 || $pageCurrent == 1) {
                            $classDisabledPrev = 'class="disabled"'; 
                        } else {
                            $pagePrev = $pageCurrent -1;
                            $hrefPrev = "list_laporan.php?page=$pagePrev$nisGet$namaGet";
                        }
                        
                        if ($totalPage == 1 || $pageCurrent == $totalPage) {
                            $classDisabledNext = 'class="disabled"'; 
                        } else {
                            $pageNext = $pageCurrent+1;
                            $hrefNext = "list_laporan.php?page=$pageNext$nisGet$namaGet";
                        }
                    ?>
                    <li <?php echo $classDisabledPrev;?>><a href="<?php echo $hrefPrev;?>" aria-label="Previous"><span aria-hidden="true">&laquo</span></a></li>
                <?php
                    for ($i =1;$i<= $totalPage;$i++) {
                        $classActive = '';
                        if ($i == $pageCurrent) {
                            $classActive = 'class="active"';
                        }
                ?>  
                    <li <?php echo $classActive;?>><a href="list_laporan.php?page=<?php echo $i.$nisGet.$namaGet;?>"><?php echo $i;?><span class="sr-only">(current)</span></a></li>
                <?php
                    }
                ?>
                    <li <?php echo $classDisabledNext?>><a href="<?php echo $hrefNext;?>" aria-label="Next"><span aria-hidden="true">&raquo</span></a></li>
                </ul>
                <p class="small-size text-warning">Halaman <?php echo $pageCurrent;?> dari <?php echo $totalPage;?> halaman. Total <?php echo $totalData; ?> Data</p>
            </nav>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center vcenter small-size">No</th>
                        <th rowspan="2" class="text-center vcenter small-size">Nomor Tes</th>
                        <th rowspan="2" class="text-center vcenter small-size">Nama</th>
                        <th colspan="2" class="text-center small-size">Nilai</th>
                        <th colspan="2" class="text-center small-size">Psikotes</th>
                        <th colspan="2" class="text-center small-size">Minat</th>
                        <th colspan="2" class="text-center small-size">Skor</th>
                        <th rowspan="2" class="text-center vcenter small-size">Rekomendasi</th>
                    </tr>
                    <tr>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $strQuery = "SELECT
                                        siswa.nis AS nis_siswa,
                                        siswa.nama AS nama_siswa,
                                        t_nilai_rata2.ipa AS nilai_ipa,
                                        t_nilai_rata2.ips AS nilai_ips,
                                        t_hasil_psikotes_bid_jurusan.ipa AS psikotes_ipa,
                                        t_hasil_psikotes_bid_jurusan.ips AS psikotes_ips,
                                        t_minat.ipa AS minat_ipa,
                                        t_minat.ips AS minat_ips,
                                        rekomendasi_minat, rekomendasi_psikotes, rekomendasi_nilai,
                                        IF (rekomendasi_psikotes = rekomendasi_minat, rekomendasi_psikotes, rekomendasi_nilai) AS rekomendasi
                                    FROM
                                        t_siswa AS siswa
                                    LEFT JOIN t_nilai_rata2 ON siswa.nis = t_nilai_rata2.nis
                                    LEFT JOIN t_hasil_psikotes_bid_jurusan ON siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                                    LEFT JOIN t_minat ON siswa.nis = t_minat.nis
                                    $leftJoin
                                    $where
                                    ORDER BY siswa.nis ASC
                                    LIMIT $pageQuery, $limit
                                ";
                        $query = mysql_query($strQuery);
                        $i = ($pageCurrent*$limit) - ($limit-1);
                        while($row = mysql_fetch_assoc($query)) {
                                //echo'<pre>';die(var_dump($row));
                            $skor = array();
                            if ($row['rekomendasi_minat'] == 'IPA') {
                                $skor['ipa'] = 35;
                            } else if ($row['rekomendasi_minat'] == 'IPS') {
                                $skor['ips'] = 35;
                            }
                            if ($row['rekomendasi_nilai'] == 'IPA') {
                                $skor['ipa'] += 48;
                            } else if ($row['rekomendasi_nilai'] == 'IPS') {
                                $skor['ips'] += 48;
                            }
                            if ($row['rekomendasi_psikotes'] == 'IPA') {
                                $skor['ipa'] += 17;
                            } else if ($row['rekomendasi_psikotes'] == 'IPS') {
                                $skor['ips'] += 17;
                            }
                    ?>
                    <tr>
                        <td class="text-center small-size"><?php echo $i;?></td>
                        <td class="text-center small-size"><?php echo $row['nis_siswa'];?></td>
                        <td class="small-size"><?php echo $row['nama_siswa'];?></td>
                        <td class="text-center small-size"><?php echo $row['nilai_ipa'];?></td>
                        <td class="text-center small-size"><?php echo $row['nilai_ips'];?></td>
                        <td class="text-center small-size"><?php echo $row['psikotes_ipa'];?></td>
                        <td class="text-center small-size"><?php echo $row['psikotes_ips'];?></td>
                        <td class="text-center small-size"><?php echo (!empty($row['minat_ipa']) ? $row['minat_ipa'].'%' : '');?></td>
                        <td class="text-center small-size"><?php echo (!empty($row['minat_ips']) ? $row['minat_ips'].'%' : '');?></td>
                        <td class="text-center small-size"><?php echo (!empty($skor['ipa']) ? $skor['ipa'].'%' : '');?></td>
                        <td class="text-center small-size"><?php echo (!empty($skor['ips']) ? $skor['ips'].'%' : '');?></td>
                        <td class="text-center small-size"><?php echo $row['rekomendasi'];?></td>
                    </tr>
                    <?php
                        $i++;
                            }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div> 
</div>

<?php
    include('layout/footer.php');
}
?>