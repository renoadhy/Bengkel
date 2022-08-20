<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          Masterdata
      </h1>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class='row'>
          <div class='col-md-12'>
              <div class='box box-info'>
                  <div class='box-header'>
                      <h3 class='box-title'>Edit Data user </h3>
                  </div><!-- /.box-header -->
                  <div class='box-body pad'>
                      <div class="modal-body">
                          <form id="tambah-user">
                          <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="edit">
                            <input type="hidden" class="form-control" id="id_user" value="<?php echo $data_user['id_user'];?>">
                            <input type="text" class="form-control" id="username" placeholder="" required value="<?php echo $data_user['username'];?>">
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label> 
                            <input type="password" class="form-control" id="password" placeholder="Kosongkan jika tidak ingin dirubah"  >
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama user</label> 
                            <input type="text" class="form-control" id="nm_user" placeholder="" required value="<?php echo $data_user['nm_user'];?>">
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Level</label>
                            <select class="form-control" id="level" required>
                                <option value='admin' <?php echo $data_user['level'] == 'admin' ? 'selected' : ''; ?>>Admin</option> 
                            </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <a href="<?php echo base_url('user');?>"> <button type="button"
                                  class="btn btn-secondary">Batal</button></a>
                          <button type="submit" class="btn btn-primary">Simpan user</button>
                      </div>
                      </form>
                  </div>
              </div><!-- /.box -->
          </div><!-- /.col-->
      </div><!-- ./row -->

      <script>
      $(document).ready(function() {
          $('#tambah-user').on('submit', function(event) {
              event.preventDefault();
              $.ajax({
                  type: "POST",
                  url: '<?php echo base_url('/user-store'); ?>',
                  data: {
                      tipe_form: $('#tipe_form').val(),
                      id_user: $('#id_user').val(),
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
                          title: 'User Berhasil diupdate'
                      });
                      $('#tambah-jabatan').trigger("reset");
                      setTimeout(function() {
                          window.location.href =
                              '<?php echo base_url('user');?>';
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

          })


      })
      </script>

<?=$this->endSection()?>