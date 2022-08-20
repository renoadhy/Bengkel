<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<section class="content-header">
    <h1>
        Transaksi
        <small>Pembelian Sparepart</small>
    </h1>
</section>

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

<!-- Main content -->
<section class="content">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-info'>
                <div class='box-header'>
                    <h3 class='box-title'>Data Sparepart Masuk </h3>
                    <button class="btn btn-primary my-2 pull-right" data-toggle="modal" data-target="#add-sparepartmasuk"><i
                            class="fa fa-plus"></i></button>

                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sparepartmasuk-table" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th></th>            
                                <th>No</th>    
                                <th>Tgl Masuk</th>    
                                <th>Supplier</th>    
                                <th>Sparepart</th>     
                                <th>Harga</th>    
                                <th>Jml</th>    
                                <th>Total</th>     
                            </tr>
                                </thead>
                                <tbody>
                                <?php if($sparepart_masuk): ?>
                                    <?php $no = 1;?>
                                <?php foreach($sparepart_masuk as $sparepartmasuk): ?>
                                <tr> 
                                    <td><?php echo $sparepartmasuk->id_masuk; ?></td>      
                                    <td><?php echo $no++; ?></td>      
                                    <td><?php echo tgl_indo($sparepartmasuk->tgl_masuk,false,false); ?></td>  
                                    <td><?php echo $sparepartmasuk->nm_supplier; ?></td>  
                                    <td><?php echo $sparepartmasuk->nm_sparepart; ?></td>  
                                    <td><?php echo rupiah($sparepartmasuk->harga); ?></td>  
                                    <td><?php echo $sparepartmasuk->jml; ?></td>  
                                    <td><?php echo rupiah($sparepartmasuk->total); ?></td>   
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col-->
    </div><!-- ./row -->


    <!-- Modal tambah data -->
    <div class="modal fade add-sparepartmasuk" id="add-sparepartmasuk" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sparepart Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="tambah-sparepartmasuk">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Masuk</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="add">
                            <input type="date" class="form-control" id="tgl_masuk" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sparepart</label>
                            <select class="form-control" id="id_sparepart" required>
                            <option value=''>---- Pilih Sparepart ----</option> 
                                <?php foreach($data_sparepart as $r){?>
                                    <option value='<?= $r['id_sparepart'];?>'><?= $r['nm_sparepart'];?></option> 
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Supplier</label>
                            <select class="form-control" id="id_supplier" required>
                            <option value=''>---- Pilih Supplier ----</option>  
                                <?php foreach($data_supplier as $s){?>
                                    <option value='<?= $s['id_supplier'];?>'><?= $s['nm_supplier'];?></option> 
                                <?php } ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga</label> 
                            <input type="number" class="form-control" id="harga" placeholder="" required>
                        </div>    
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jumlah</label> 
                            <input type="number" class="form-control" id="jml" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Total</label> 
                            <input type="number" class="form-control" id="total" placeholder="" required>
                        </div>   
                         
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Masukan Sprepart</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() { 
            var table = $('#sparepartmasuk-table').DataTable({  
                "columnDefs": [  {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    // {
                    //     "data": [2],
                    //     "targets": -1,
                    //     "render": function(data, type, row, meta) {
                    //         // console.log(row)
                    //         // return "<a href=<?php echo base_url('sparepartmasuk-edit/');?>/" +
                    //         //     row[0] +
                    //         //     "><button class='btn btn-primary btn-md' name='edit'><i class='fa fa-edit  text-white-50 mr-1'></i>  </button></a> <button type='button' class='btn btn-danger btn-md' name='hapus' id_sparepartmasuk=" +
                    //         //     row[0] + " onclick='hapus(`" + row[0] +
                    //         //     "`)'><i class='fa fa-trash-o text-white-50 mr-1'></i>  </button>";
                    //     }
                    // }
                ]
            });
 
            $('#tambah-sparepartmasuk').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/masuk-store'); ?>',
                    data: {
                        tipe_form: $('#tipe_form').val(),
                        tgl_masuk: $('#tgl_masuk').val(), 
                        id_sparepart: $('#id_sparepart').val(), 
                        id_supplier: $('#id_supplier').val(),  
                        harga: $('#harga').val(),  
                        jml: $('#jml').val(),  
                        total: $('#total').val(),  
                    },
                    dataType: "json",
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'Sparepart Berhasil dimasukan'
                        });
                        $('#tambah-sparepartmasuk').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('/masuk');?>';
                            window.clearTimeout();
                        }, 1000);

                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            type: 'error',
                            title: 'Gagal menghubungkan Ke Server'
                        })
                    }

                });
                
            }); 
 
            $('#id_sparepart').on('change', function(e) {
                var id_sparepart = e.target.value;
                $.ajax({
                        type: "POST",
                        url: '<?php echo base_url('sparepart-show'); ?>',
                        data: {
                            id_sparepart: id_sparepart
                        },
                        dataType: "json",
                        success: function(data) {
                          $("#harga").val(data.harga);
                          $("#id_supplier").focus()

                        },
                        error: function(request, status, error) {
                            console.log('Gagal ke Server')


                        }

                    });

            });

            $('#jml').on('change', function(e) {

                         var harga =  $("#harga").val();
                         var jml =  $("#jml").val();
                          $("#total").val(harga* jml);
                   

                   

            });


        });



        function hapus(id) {

            var id_sparepartmasuk = id; 
            Swal.fire({
                title: 'Anda Yakin hapus Supplier ini..?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url('sparepartmasuk-hapus'); ?>',
                        data: {
                            id_sparepartmasuk: id_sparepartmasuk
                        },
                        dataType: "json",
                        success: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            Toast.fire({
                                type: 'success',
                                title: 'OK, Berhasil Dihapus'
                            });

                            setTimeout(function() {
                                window.location.href =
                                    '<?php echo base_url('sparepartmasuk');?>';
                                window.clearTimeout();
                            }, 1000);

                        },
                        error: function(request, status, error) {
                            console.log('Gagal ke Server')


                        }

                    });
                }
                if (result.dismiss == "cancel") {
                    console.log('batal');
                }

            });

        }
        </script>
 

<?=$this->endSection()?>
  
