<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<section class="content-header">
    <h1>
        Transaksi
        <small>Jasa Service</small>
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
                    <h3 class='box-title'>Data Jasa Service </h3>
                    <button class="btn btn-primary my-2 pull-right" data-toggle="modal" data-target="#add-serviskeluar"><i
                            class="fa fa-plus"></i></button>

                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="serviskeluar-table" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th></th>            
                                <th>No</th>    
                                <th>Tgl Service</th>    
                                <th>Pelanggan</th>    
                                <th>Total</th>  
                                <th>Fungsi</th>     

                            </tr>
                                </thead>
                                <tbody>
                                <?php if($servis_keluar): ?>
                                    <?php $no = 1;?>
                                <?php foreach($servis_keluar as $serviskeluar): ?>
                                <tr> 
                                    <td></td>      
                                    <td><?php echo $no++; ?></td>      
                                    <td><?php echo tgl_indo($serviskeluar->tgl_keluar); ?></td>  
                                    <td><?php echo $serviskeluar->pelanggan; ?></td>    
                                    <td><?php echo rupiah($serviskeluar->total); ?></td>   
                                    <td> <?php echo $serviskeluar->id_keluar; ?></td>   
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

    <div class="modal fade add-serviskeluar" id="add-serviskeluar" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Service Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="tambah-serviskeluar">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Keluar</label>
                            <input type="hidden" class="form-control" name="tipe_form" value="add">
                            <input type="date" class="form-control" name="tgl_keluar" placeholder="" required>
                        </div>  
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pelanggan</label> 
                            <input type="text" class="form-control" name="pelanggan" placeholder="" required>
                        </div>    
                        <div class="form-group"> 
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"> Item Service : </label>
                                    <input type="text" name="item_search" class="form-control item_search  mb-1"
                                        autocomplete="off" />
                                    <ul class="list-group  submenu">
                                    </ul>
                                    <div id="localSearchSimple"></div>
                                    <div id="detail" style="margin-top:16px;"></div>
                                    <div class="table-repsonsive">
                                        <table class="table table-bordered" id="item_table"> 
                                            <tr>
                                                <th>Nama Service</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th> </th>
                                            </tr>
                                        </table>
                                    </div> 

                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                    <div class="form-group">  
                                        <div id="detail" style="margin-top:16px;"></div>
                                        <div class="table-repsonsive">
                                            <table class="table table-bordered" id="total_table"> 
                                            </table>
                                        </div>  
                                    </div>
                            </div>
                            <div class="form-group"> 
                                    <div class="form-group">  
                                        <div id="detail" style="margin-top:16px;"></div>
                                        <div class="table-repsonsive">
                                            <table class="table table-bordered" id="pembayaran_table"> 
                                            </table>
                                        </div>  
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan Data Service</button>
                </div>
                </form>
                </div>
            </div>
            </div>
            </div>
     
       
            <div class="modal fade detail_modal" id="detail_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
        
                        <div class="modal-body"> 
                            <div class="table-repsonsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Service</th>
                                        <th>Harga</th> 
                                        <th>Total</th> 
                                    </tr>
                                </thead>
                                <tbody id="list_item">
                                </tbody>
                            </table>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                                    </div> 
                         </div>
                        </div>
                        </div>
                        
   
    
      

        <script type="text/javascript">
        $(document).ready(function() { 
            var table = $('#serviskeluar-table').DataTable({  
                "columnDefs": [  {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "data": [0],
                        "targets": -1,
                        "render": function(data, type, row, meta) {
                            console.log(data);
                            var url = '<?php echo base_url();?>' + '/servis-nota/' +
                               data; 
                            return "<button type='button' class='btn btn-warning btn-md detail_servis' name='detail_servis' id_keluar=" +
                                row[0] + " data-toggle='modal' data-target='#detail_modal' title='Lihat Detail  Service'><i class='fa fa-eye  text-white-50 mr-1'></i>  </button>&nbsp;<a  class='btn btn-danger btn-md' name='print' onclick='window.open(`" +
                                url +
                                "`, `Cetak Nota Service`,`width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no`)'> <i class='fa fa-print  text-white-50 mr-3'></i> </a>";
                        }
                    }
                ]
            });
 
            $('#tambah-serviskeluar').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/keluar-store'); ?>',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
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
                            title: 'Service Berhasil dikeluarkan'
                        });
                        $('#tambah-serviskeluar').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('/keluar');?>';
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


    //fecth list sugestion
    $("input.item_search[type='text']").on("keyup", function(event) { 
        var query = $("input[name='item_search']").val();
        $('#detail').html('');
        $('.list-group').css('display', 'block');
        if (query.length > 1) {
            $.ajax({
                url: "<?php echo base_url('/servis-search'); ?>",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('.list-group').html(data);
                }
            })
        }
        if (query.length == 0) {
            $('.list-group').hide(500);
        }
    });

  


    $(document).on('click', '.gsearch', function() {
        var id_servis = $(this).attr('id_servis');
        var nm_servis = $(this).attr('nm_servis'); 
        var harga = $(this).attr('harga'); 
        var stok = $(this).attr('stok'); 
        console.log(stok);

        $('.list-group').hide(500);
        var html = '';
        html += '<tr class="baris">';
        html += '<td><input type="hidden" name="id_servis[]"   class="form-control item_name" value=' +
            id_servis + '>' + nm_servis + '<input type="hidden" name="stok[]"   class="form-control stok" value=' +
            stok + '></td>';
        html += '<td><input type="text" name="harga[]"   class="form-control item_name harga" value=' + harga + '></td>';
        html +=
            '<td><input type="text" name="total[]" class="form-control total" required/></td>';
        html +=
            '<td><center><button type="button" name="remove" class="btn btn-danger btn-sm remove "><i class="fa fa-remove"></i></button></center></td></tr>'; 
        $('#item_table').append(html);
        var total = '';
        var subtotal = 0;
        total =
            '<tr><td>Total<input type="text" name="grand_total" class="form-control" value="'+ subtotal +'" required/> </td></tr>';
        $('#total_table').html(total);
        var pemb ;
        pemb = '<tr><td>Diterima<input type="text" name="diterima" class="form-control diterima"  required/> </td><td>Kembalian<input type="text" name="kembalian" class="form-control"  required/> </td></tr>';
        $('#pembayaran_table').html(pemb);

      
    });


    $(document).on('change', function() {
        var row = $(this).closest('tr');
        console.log($(this).val())
        console.log(row)
        console.log(quantity)
        var harga_satuan = parseInt(row.find('.harga').val());
        var total_harga =0;
        total_harga = quantity * harga_satuan;
         parseInt(row.find('.total').val(total_harga));
        
    });
    $(document).on('keyup', '.total', function() {
        var grand_total = 0;
       $("input[name='total[]']").each(function(){
            var total = parseInt($(this).val());
            grand_total += total ;  
       });
       $("input[name='grand_total']").val(grand_total);
    });

    $(document).on('keyup', function() { 
        var row = $(this).closest('tr'); 
        var stok = row.find('.stok').val();
        if(stok < $(this).val()){
            alert('Stok Service Tidak Mencukupi');
            $(this).val(stok);
        }
    });

    $(document).on('keyup', '.diterima', function(e) {
        var kembalian = 0; 
       var total = $("input[name='grand_total']").val();
       var diterima = $(this).val();

       $("input[name='kembalian']").val(diterima-total);
       
       
    });

    $(document).on('click', '.detail_servis', function() { 
                $('.detail-po').modal('show');
                var id_keluar = $(this).attr('id_keluar');
                 $.ajax({
               url: "<?php echo base_url('/servis-detail_servis'); ?>",
               method: "POST",
                 data: {
                    id_keluar: id_keluar
                },
               success: function(data) {
                $('#list_item').html(data); 
                }
                }); 
            });   

    });
    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
    });



        function hapus(id) {

            var id_serviskeluar = id; 
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
                        url: '<?php echo base_url('serviskeluar-hapus'); ?>',
                        data: {
                            id_serviskeluar: id_serviskeluar
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
                                    '<?php echo base_url('serviskeluar');?>';
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
  
