<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<section class="content-header">
    <h1>
        Masterdata
        <small>Supplier</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-black'>
                <div class='box-header'>
                    <h3 class='box-title'>Data Supplier </h3>
                    <button class="btn btn-primary my-2 pull-right" data-toggle="modal" data-target="#add-supplier"><i
                            class="fa fa-plus"></i></button>

                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="supplier-table" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th></th>        
                                <th>Nama supplier</th>    
                                <th>Alamat</th>    
                                <th>No Telpon</th>    
                                <th>Fungsi</th> 
                            </tr>
                                </thead>
                                <tbody>
                                <?php if($supplier): ?>
                                <?php foreach($supplier as $supplier): ?>
                                <tr> 
                                    <td><?php echo $supplier['id_supplier']; ?></td>      
                                    <td><?php echo $supplier['nm_supplier']; ?></td>  
                                    <td><?php echo $supplier['alamat']; ?></td>  
                                    <td><?php echo $supplier['no_telp']; ?></td>  
                                    <td> </td>  
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
    <div class="modal fade add-supplier" id="add-supplier" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="tambah-supplier">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Supplier</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="add">
                            <input type="text" class="form-control" id="nm_supplier" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label> 
                            <input type="text" class="form-control" id="alamat" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Telepon</label> 
                            <input type="text" class="form-control" id="no_telp" placeholder="" required>
                        </div>   
                         
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Supplier</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() { 
            var table = $('#supplier-table').DataTable({  
                "columnDefs": [  {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "data": [2],
                        "targets": -1,
                        "render": function(data, type, row, meta) {
                            console.log(row)
                            return "<a href=<?php echo base_url('supplier-edit/');?>/" +
                                row[0] +
                                "><button class='btn btn-primary btn-md' name='edit'><i class='fa fa-edit  text-white-50 mr-1'></i>  </button></a> <button type='button' class='btn btn-danger btn-md' name='hapus' id_supplier=" +
                                row[0] + " onclick='hapus(`" + row[0] +
                                "`)'><i class='fa fa-trash-o text-white-50 mr-1'></i>  </button>";
                        }
                    }
                ]
            });
 
            $('#tambah-supplier').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/supplier-store'); ?>',
                    data: {
                        tipe_form: $('#tipe_form').val(),
                        nm_supplier: $('#nm_supplier').val(), 
                        alamat: $('#alamat').val(), 
                        no_telp: $('#no_telp').val(),  
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
                            title: 'Supplier Berhasil ditambahkan'
                        });
                        $('#tambah-supplier').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('/supplier');?>';
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

            var id_supplier = id; 
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
                        url: '<?php echo base_url('supplier-hapus'); ?>',
                        data: {
                            id_supplier: id_supplier
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
                                    '<?php echo base_url('supplier');?>';
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
  
