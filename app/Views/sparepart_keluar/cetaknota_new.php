<html>

<head>
    <title>Faktur Penjualan</title>
    <style>
    #tabel {
        font-size: 15px;
        border-collapse: collapse;
    }

    #tabel td {
        padding-left: 5px;
        border: 1px solid black;
    }

    @media print {

        html,
        body {
            width: 57mm;
            height: 30mm;
        }


    }
    </style>
</head> 

<body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
<?php
 function tgl_indo($tanggal, $cetak_hari = false, $cetak_jam = false)
{
    $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );
            
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split    = explode('-', $tanggal);
    $jam = explode(' ',$split[2]);

    if($cetak_jam)
    {
        $waktu = explode('.', $jam[1]);
        $tgl_indo = $jam[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]. ' ' .$waktu[0];
    }else
    {
        $tgl_indo = $jam[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }
    if ($cetak_hari) 
    {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}  
function rupiah($angka){ 
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah; 
} 
?>

    <!-- <body style='font-family:tahoma; font-size:8pt;' onload=""> -->
    <center>
        <table style=' font-size:10pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr >
                <td colspan="2">
                    <center><h1>SFR BENGKEL</h1>
                </td>
            </tr>
            <tr style="margin-bottom:7px">
                <td colspan="2">
                    <center><b><u>BUKTI PEMBAYARAN</b>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr> 
            <tr>
                <td width="40%">
                    Tanggal
                </td>
                <td>
                    : &nbsp;<?php echo  tgl_indo($data_sparepart_keluar['tgl_keluar']);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
            </tr>
            <tr>
                <td>
                    Pelanggan
                </td>
                <td>
                    : &nbsp;<?php   echo $data_sparepart_keluar['pelanggan'];?>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    Rincian :
                </td> 
            </tr> 
            
            <tr>
                <table style="font-size:8pt; font-family:calibri; border-collapse: collapse;' border='1'" border='1'>
                    <tr>
                        <td>No</td>
                        <td>Nama Sparepart</td>
                        <td>Qty</td>
                        <td>Harga</td>
                        <td>Total</td>  
                    </tr>
                    <?php 
                    $no=1;
                    foreach($data_detail_penjualan as $r){ ?>
                    <tr>
                        <td><?= $no++;;?></td>
                        <td><?= $r->nm_sparepart;?></td>
                        <td><?= $r->jml;?></td>
                        <td><?= rupiah($r->harga);?></td>
                        <td><?= rupiah($r->jml*$r->harga);?></td>  
                    </tr> 
                    <?php } ;?>
                </table>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    Total
                </td>
                <td>
                    : &nbsp;<?php echo rupiah($data_sparepart_keluar['total']);?>
                </td>
            </tr>
             <br>
            <tr>
                <td>

                </td>
                <td>
                    ------------------------------
                </td>
            </tr> 
            <br>
            
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center>
                        Simpan tanda terima ini sebagai bukti
                        <br>Pembayaran yang Sah
                        <br>
                        -----------
                    </center>
                </td>
            </tr> 
           
        </table>
      
    </center>
</body>

</html>