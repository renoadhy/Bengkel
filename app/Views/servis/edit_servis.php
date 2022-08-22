<?= $this->extend("layouts/template") ?>

<?= $this->section("content") ?>
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
                    <h3 class='box-title'>Edit Data Service </h3>
                </div><!-- /.box-header -->
                <div class='box-body pad'>
                    <div class="modal-body">
                        <form id="tambah-servis">
                            <?php foreach ($data_servis as $data_servis) : ?>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nama Service </label>
                                    <input type="hidden" class="form-control" name="id_servis" id="id_servis" value="<?php echo $data_servis->id_servis; ?>">
                                    <input type="hidden" class="form-control" name="tipe_form" id="tipe_form" value="edit">
                                    <input type="text" class="form-control" name="nm_servis" id="nm_servis" placeholder="" required value="<?php echo $data_servis->nm_servis; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1"> Harga</label>
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="" required value="<?php echo $data_servis->harga; ?>">
                                </div>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo base_url('servis'); ?>"> <button type="button" class="btn btn-secondary">Batal</button></a>
                        <button type="submit" class="btn btn-primary">Simpan Service</button>
                    </div>
                <?php endforeach; ?>
                </form>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col-->
    </div><!-- ./row -->

    <script>
        $(document).ready(function() {
            $('#tambah-servis').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('/servis-store'); ?>',
                    data: {
                        tipe_form: $('#tipe_form').val(),
                        id_servis: $('#id_servis').val(),
                        nm_servis: $('#nm_servis').val(),
                        harga: $('#harga').val(),
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
                            title: 'Servis Berhasil diupdate'
                        });
                        $('#tambah-servis').trigger("reset");
                        setTimeout(function() {
                            window.location.href =
                                '<?php echo base_url('servis'); ?>';
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

    <?= $this->endSection() ?>