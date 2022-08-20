<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Bengkel | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.css')?>">
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/plugins/iCheck/square/blue.css');?>" rel="stylesheet" type="text/css" />
</head>

<body class="login-page dark" style="background-color:">
    <br>
    <br>
    <br>
    <br>
    <div class="login-box">
    <center>
        <h1>Sistem Informasi</h1>
        <h4>Bengkel Motor</h4>
    </center>
 
        <div class="login-logo"> 
        <center><h4>Salman Firmansyah Pratama</h4></center>

        </div>
        <div class="col-md-11">
            <form id="form_login" method="post">
                <label for="inputEmail" class="sr-only">Username</label>
                <input type="text" id="username" class="form-control "
                    style="margin-bottom: 7px; line-height: 5em;height:45px" id="username" placeholder="Username"
                    required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="password" class="form-control" id="password" placeholder="Password"
                    style=" margin-bottom: 7px; line-height: 5em;height:45px" required>
                <button class="btn btn-lg   btn-block mt-1 mb-2" style="background-color:gray;color:white"
                    type="submit">Masuk</button><br>
               
                <center class="text-muted">Copyright&copy; <?php echo date ('Y'); ?> | Universitas Dr. Soetomo <br> 
                Fakultas Teknik Informatika Profesional 2019</center>

            </form>
        </div>



        <!-- </div>/.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert2.js')?>"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#form_login').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>/login',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                dataType: "json",
                success: function(data) {
                    console.log(data.result)
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        type: 'success',
                        title: 'Akses diterima'
                    })

                    setTimeout(function() {
                        window.location.href =
                            '<?php echo base_url('/dashboard'); ?>';
                        window.clearTimeout(); // clear time out.
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
                        title: 'Akses ditolak, Username atau Password Salah'
                    })
                }

            });

        });


    })
    </script>
    <style>
    html {
        font-size: 13px;
    }

    </body></html>