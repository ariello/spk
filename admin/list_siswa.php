<?php
//echo'<pre>';die(var_dump($_SERVER['HTTP_HOST'],explode('/',$_SERVER['PHP_SELF'])));
if (isset($_REQUEST['button']) && $_REQUEST['button'] == 'cetak') {
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
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'DATA SISWA', '');

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
        $where = "WHERE t_siswa.nis LIKE '%$nisQuery%'";
    } 
    if (!empty($namaQuery) && empty($where)) {
        $where = "WHERE t_siswa.nama LIKE '%$namaQuery%'";
    } else if (!empty($namaQuery) && !empty($where)) {
        $where .= " AND t_siswa.nama LIKE '%$namaQuery%'";
    }

    include('../configure/database.php');
    $strQuery = "SELECT 
                    t_siswa.nis as nis_siswa, t_siswa.nama as nama_siswa, t_nilai_rata2.ipa as nilai_ipa, 
                    t_nilai_rata2.ips as nilai_ips,
                    t_hasil_psikotes_bid_jurusan.ipa as psikotes_ipa,
                    t_hasil_psikotes_bid_jurusan.ips as psikotes_ips
                    FROM t_siswa 
                    LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
                    LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                    $where
                    ORDER BY t_siswa.nis ASC";
    $query = mysql_query($strQuery);
    $i = 1;
    $detail='';
    while($row = mysql_fetch_assoc($query)) {
        $detail .='<tr>
                    <td style="text-align:center;width:5%">'.$i.'</td>
                    <td style="text-align:center;width:15%">'.$row['nis_siswa'].'</td>
                    <td style="width:20%">'.$row['nama_siswa'].'</td>
                    <td style="text-align:center;width:15%">'.$row['nilai_ipa'].'</td>
                    <td style="text-align:center;width:15%">'.$row['nilai_ips'].'</td>
                    <td style="text-align:center;width:15%">'.$row['psikotes_ipa'].'</td>
                    <td style="text-align:center;width:15%">'.$row['psikotes_ips'].'</td>
                </tr>';
            $i++;
    }
    $table = '<table cellpadding="2" border="1">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:5%">No</th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:15%">Nomor Tes</th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;width:20%">Nama</th>
                        <th colspan="2" style="text-align:center;width:30%">Nilai</th>
                        <th colspan="2" style="text-align:center;width:30%">Psikotes</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;">IPA</th>
                        <th style="text-align:center;">IPS</th>
                        <th style="text-align:center;">IPA</th>
                        <th style="text-align:center;">IPS</th>
                    </tr>
                </thead>
                <tbody>
                    '.$detail.'
                </tbody>
            </table>';
    // output the HTML content
    $pdf->writeHTML($table, true, false, true, false, '');

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('data_siswa.pdf', 'I');
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
        font-size : 12px;
    }
    .medium-size {
        font-size : 14px;
    }
    .delete-siswa {
        margin-left:3px;
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
                            <form id="searchSiswa" method="get" action="list_siswa.php" class="form-horizontal">
                                <div class="form-group">
                                    <label for="namesiswa" class="col-lg-4 control-label medium-size" style="text-align:left">Nomor Test </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="nissiswa" name="nis" value="<?php echo (isset($_REQUEST['nis']) ? $_REQUEST['nis'] : ''); ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="namesiswa" class="col-lg-4 control-label medium-size" style="text-align:left">Nama Siswa </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="namesiswa" name="nama" value="<?php echo (isset($_REQUEST['nama']) ? $_REQUEST['nama'] : ''); ?>"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger medium-size">Cari</button>
                                <a href="list_siswa.php"><button type="button" class="btn btn-danger medium-size">Batal</button></a>
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
                    $where = "WHERE t_siswa.nis LIKE '%$nisQuery%'";
                } 
                if (!empty($namaQuery) && empty($where)) {
                    $where = "WHERE t_siswa.nama LIKE '%$namaQuery%'";
                } else if (!empty($namaQuery) && !empty($where)) {
                    $where .= " AND t_siswa.nama LIKE '%$namaQuery%'";
                }
                
                include('../configure/database.php');
                $strCount = "SELECT COUNT(*)
                                FROM t_siswa 
                                LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
                                LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                                $where";
                $queryCount = mysql_query($strCount);
                $rowCount = mysql_fetch_row($queryCount);
                $totalData = $rowCount[0];
                $limit = 3;
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
                            $hrefPrev = "list_siswa.php?page=$pagePrev$nisGet$namaGet";
                            $classDisabledPrev = '';
                        }
                        
                        if ($totalPage == 1 || $pageCurrent == $totalPage) {
                            $classDisabledNext = 'class="disabled"'; 
                        } else {
                            $pageNext = $pageCurrent+1;
                            $hrefNext = "list_siswa.php?page=$pageNext$nisGet$namaGet";
                            $classDisabledNext = '';
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
                    <li <?php echo $classActive;?>><a href="list_siswa.php?page=<?php echo $i.$nisGet.$namaGet;?>"><?php echo $i;?><span class="sr-only">(current)</span></a></li>
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
                        <th rowspan="2" class="text-center vcenter small-size">Action</th>
                    </tr>
                    <tr>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                        <th class="text-center small-size">IPA</th>
                        <th class="text-center small-size">IPS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $strQuery = "SELECT 
                                        t_siswa.nis as nis_siswa, t_siswa.nama as nama_siswa, t_nilai_rata2.ipa as nilai_ipa, 
                                        t_nilai_rata2.ips as nilai_ips,
                                        t_hasil_psikotes_bid_jurusan.ipa as psikotes_ipa,
                                        t_hasil_psikotes_bid_jurusan.ips as psikotes_ips
                                        FROM t_siswa 
                                        LEFT JOIN t_nilai_rata2 ON t_siswa.nis = t_nilai_rata2.nis
                                        LEFT JOIN t_hasil_psikotes_bid_jurusan ON t_siswa.nis = t_hasil_psikotes_bid_jurusan.nis
                                        $where
                                        ORDER BY t_siswa.nis ASC
                                        LIMIT $pageQuery, $limit";
                        $query = mysql_query($strQuery);
                        $i = ($pageCurrent*$limit) - ($limit-1);
                        while($row = mysql_fetch_assoc($query)) {
                                //echo'<pre>';die(var_dump($row));
                    ?>
                    <tr>
                        <td class="text-center small-size"><?php echo $i;?></td>
                        <td class="text-center small-size"><?php echo $row['nis_siswa'];?></td>
                        <td class="small-size"><?php echo $row['nama_siswa'];?></td>
                        <td class="text-center small-size"><?php echo $row['nilai_ipa'];?></td>
                        <td class="text-center small-size"><?php echo $row['nilai_ips'];?></td>
                        <td class="text-center small-size"><?php echo $row['psikotes_ipa'];?></td>
                        <td class="text-center small-size"><?php echo $row['psikotes_ips'];?></td>
                        <td class="text-center small-size">
                            <a href="edit_siswa.php?nis=<?php echo $row['nis_siswa'];?>">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="delete_siswa.php?nis=<?php echo $row['nis_siswa'];?>" class="delete-siswa">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                        
                    </tr>
                    <?php
                        $i++;
                            }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 
    <div id="confirm" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    Yakin mau dihapus?
                </div> 
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Ya</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php
    include('layout/footer.php');
    $uri = explode('/',  $_SERVER['PHP_SELF']);
}
?>

<script>
    $(document).ready(function(){
        var httpHost = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/';
        var uri = '<?php echo $uri[1].'/'.$uri[2].'/';?>';
        $('.delete-siswa').click(function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            $('#confirm').modal({backdrop: 'static', keyboard: false}).one('click', '#delete', function(e){
                location.href = httpHost+uri+href;
            });
        });
    });
</script>

