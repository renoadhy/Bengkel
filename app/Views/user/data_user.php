<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
<section class="content-header">
    <h1>
        Masterdata
        <small>user</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class='row'>
        <div class='col-md-12'>
            <div class='box box-black'>
                <div class='box-header'>
                    <h3 class='box-title'>Data user </h3>
                    <button class="btn btn-primary my-2 pull-right" data-toggle="modal" data-target="#add-user"><i
                            class="fa fa-plus"></i></button>

                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="user-table" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th></th>    
                                <th>Username</th>    
                                <th>Nama user</th>    
                                <th>Level</th>    
                                <th>Fungsi</th> 
                            </tr>
                                </thead>
                                <tbody>
                                <?php if($user): ?>
                                <?php foreach($user as $user): ?>
                                <tr>
                                    
                                    <td><?php echo $user['id_user']; ?></td>    
                                    <td><?php echo $user['username']; ?></td>    
                                    <td><?php echo $user['nm_user']; ?></td>  
                                    <td><?php echo $user['level']; ?></td>  
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
    <div class="modal fade add-user" id="add-user" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="tambah-user">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="add">
                            <input type="text" class="form-control" id="username" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label> 
                            <input type="password" class="form-control" id="password" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama user</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="add">
                            <input type="text" class="form-control" id="nm_user" placeholder="" required>
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Level</label>
                            <select class="form-control" id="level" required>
                                <option value='admin'>Admin</option> 
                            </select>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
        $(document).ready(function() { 
            var table = $('#user-table').DataTable({  
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
                            return "<a href=<?php echo base_url('user-edit/');?>/" +
                                row[0] +
                                "><button class='btn btn-primary btn-md' name='edit'><i class='fa fa-edit  text-white-50 mr-1'></i>  </button></a> <button type='button' class='btn btn-danger btn-md' name='hapus' id_user=" +
                                row[0] + " onclick='hapus(`" + row[0] +
                                "`)'><i class='fa fa-trash-o text-white-50 mr-1'></i>  </button>";
                        }
                    }
                ]
            });
 
            $('#tambah-user').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/user-store'); ?>',
                    data: {
                        tipe_form: $('#tipe_form').val(),
                        username: $('#username').val(), 
                        password: $('#password').val(), 
                        nm_user: $('#nm_user').val(), 
                        level: $('#level').val(), 
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
                            title: 'User Berhasil ditambahkan'
                        });
                        $('#tambah-user').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('/user');?>';
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

            var id_user = id; 
            Swal.fire({
                title: 'Anda Yakin hapus User ini..?',
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
                        url: '<?php echo base_url('user-hapus'); ?>',
                        data: {
                            id_user: id_user
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
                                    '<?php echo base_url('user');?>';
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
  
