<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<section class="content-header">
    <h1>
        Masterdata
        <small>Sparepart</small>
    </h1>
</section>  
<!-- Main content -->
<section class="content">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-black'>
                <div class='box-header'>
                    <h3 class='box-title'>Data Sparepart </h3>
                    <button class="btn btn-primary my-2 pull-right" data-toggle="modal" data-target="#add-sparepart"><i
                            class="fa fa-plus"></i></button> 
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sparepart-table" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th></th>   
                                <th> No</th>   
                                <th>Nama Sparepart</th>   
                                <th>Harga</th> 
                                <th>Gambar</th>  
                                <th>Stok</th> 
                                <th>Fungsi</th> 
                            </tr>
                                </thead>
                                <tbody> 
                                <?php if($sparepart): ?>
                                    <?php $no=1;?>
                                <?php foreach($sparepart as $data): ?>
                                    <tr>   
                                        <td><?php echo $data->id_sparepart; ?></td>
                                        <td><?php echo $no++; ?></td>
                                    <td><?php echo $data->nm_sparepart; ?></td>
                                    <td><?php echo $data->harga; ?></td> 
                                    <td><center><img src="<?php echo base_url('uploads/').'/'.$data->gambar; ?>"
                                  width=40 height=40></center> </td>  
                                    <td><?php echo $data->stok; ?></td> 
                                    <td></td>
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
    <div class="modal fade add-sparepart" id="add-sparepart" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sparepart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <div class="modal-body">
                    <form id="tambah-sparepart" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama  Sparepart</label>
                            <input type="hidden" class="form-control" name="tipe_form" value="add">
                            <input type="text" class="form-control" name="nm_sparepart" placeholder="" required>
                        </div>  
                        <div class="form-group">
                            <label for="exampleFormControlInput1"> Harga</label> 
                            <input type="text" class="form-control" name="harga" placeholder="" required>
                        </div> 
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Gambar</label>
                            <input type="file" accept="image/*" class="form-control" name="gambar" placeholder=""
                                required>
                        </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Sparepart</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() {  
            var table = $('#sparepart-table').DataTable({  
                "columnDefs": [{
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },  
                    {
                        "data": [2],
                        "targets": -1,
                        "render": function(data, type, row, meta) {
                            console.log(row)
                            return "<a href=<?php echo base_url('sparepart-edit/');?>/" +
                                row[0] +
                                "><button class='btn btn-primary btn-md' name='edit'><i class='fa fa-edit  text-white-50 mr-1'></i>  </button></a> <button type='button' class='btn btn-danger btn-md' name='hapus' id_sparepart=" +
                                row[0] + " onclick='hapus(`" + row[0] +
                                "`)'><i class='fa fa-trash-o text-white-50 mr-1'></i>  </button>";
                        }
                    },
                     
                ]
            });
 
            $('#tambah-sparepart').on('submit', function(e) {
                e.preventDefault(); 
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/sparepart-store'); ?>',
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
                            title: 'Sparepart Berhasil ditambahkan'
                        });
                        $('#tambah-sparepart').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('/sparepart');?>';
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
            
 



        });



        function hapus(id) {

            var id_sparepart = id; 
            Swal.fire({
                title: 'Anda Yakin hapus sparepart ini..?',
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
                        url: '<?php echo base_url('sparepart-hapus'); ?>',
                        data: {
                            id_sparepart: id_sparepart
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
                                    '<?php echo base_url('sparepart');?>';
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
  
