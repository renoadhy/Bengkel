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
                      <h3 class='box-title'>Edit Data Sparepart </h3>
                  </div><!-- /.box-header -->
                  <div class='box-body pad'>
                      <div class="modal-body">
                          <form id="tambah-sk">
                          <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Sparepart </label>
                            <input type="hidden" class="form-control" name="id_sparepart" value="<?php echo $data_sparepart['id_sparepart'];?>">
                            <input type="hidden" class="form-control" name="tipe_form" value="edit">
                            <input type="text" class="form-control" name="nm_sparepart" placeholder="" required value="<?php echo $data_sparepart['nm_sparepart'];?>">
                        </div>  
                        <div class="form-group">
                            <label for="exampleFormControlInput1"> Harga</label> 
                            <input type="text" class="form-control" name="harga" placeholder="" required value="<?php echo $data_sparepart['harga'];?>">
                        </div>  
                        <div class="form-group">
                                      <label> Gambar lama:</label>
                                       <?php echo $data_sparepart['gambar'];?> <br>
                                      <img src="<?php echo base_url('uploads/'.$data_sparepart['gambar']);?>"
                                          width="100" height="100">
                                      <input type="hidden" name="old_foto"
                                          value="<?php echo $data_sparepart['gambar'];?>">
                                      <input type="file" class="form-control mt-2" accept="image/*" name="gambar"
                                          placeholder="Gambar">
                                  </div>
                      </div>
                      <div class="modal-footer">
                          <a href="<?php echo base_url('sparepart');?>"> <button type="button"
                                  class="btn btn-secondary">Batal</button></a>
                          <button type="submit" class="btn btn-primary">Simpan Sparepart</button>
                      </div>
                      </form>
                  </div>
              </div><!-- /.box -->
          </div><!-- /.col-->
      </div><!-- ./row -->

      <script>
      $(document).ready(function() {
          $('#tambah-sk').on('submit', function(event) {
              event.preventDefault();
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
                          title: 'Sparepart Berhasil diupdate'
                      });
                      $('#tambah-sk').trigger("reset");
                      setTimeout(function() {
                          window.location.href =
                              '<?php echo base_url('sparepart');?>';
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