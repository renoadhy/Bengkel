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
              <div class='box box-black'>
                  <div class='box-header'>
                      <h3 class='box-title'>Edit Data Supplier </h3>
                  </div><!-- /.box-header -->
                  <div class='box-body pad'>
                      <div class="modal-body">
                          <form id="tambah-supplier">
                          <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Supplier</label>
                            <input type="hidden" class="form-control" id="tipe_form" value="edit">
                            <input type="hidden" class="form-control" id="id_supplier" value="<?php echo $data_supplier['id_supplier'];?>">
                            <input type="text" class="form-control" id="nm_supplier" placeholder="" required value="<?php echo $data_supplier['nm_supplier'];?>">
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label> 
                            <input type="text" class="form-control" id="alamat" placeholder="" required value="<?php echo $data_supplier['alamat'];?>">
                        </div>   
                        <div class="form-group">
                            <label for="exampleFormControlInput1">No Telpon</label> 
                            <input type="text" class="form-control" id="no_telp" placeholder="" required value="<?php echo $data_supplier['no_telp'];?>">
                        </div>   
                         
                      </div>
                      <div class="modal-footer">
                          <a href="<?php echo base_url('supplier');?>"> <button type="button"
                                  class="btn btn-secondary">Batal</button></a>
                          <button type="submit" class="btn btn-primary">Simpan Supplier</button>
                      </div>
                      </form>
                  </div>
              </div><!-- /.box -->
          </div><!-- /.col-->
      </div><!-- ./row -->

      <script>
      $(document).ready(function() {
          $('#tambah-supplier').on('submit', function(event) {
              event.preventDefault();
              $.ajax({
                  type: "POST",
                  url: '<?php echo base_url('/supplier-store'); ?>',
                  data: {
                      tipe_form: $('#tipe_form').val(),
                      id_supplier: $('#id_supplier').val(), 
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
                          title: 'Supplier Berhasil diupdate'
                      });
                      $('#tambah-supplier').trigger("reset");
                      setTimeout(function() {
                          window.location.href =
                              '<?php echo base_url('supplier');?>';
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