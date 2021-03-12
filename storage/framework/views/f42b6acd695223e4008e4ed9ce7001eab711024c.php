<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title', 'SECURTAC'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('admin-dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SECURTAC</b></a>
        </div>
        <!-- /.login-logo -->
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- jQuery -->
    <script src="<?php echo e(URL::asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(URL::asset('admin-dist/js/adminlte.min.js')); ?>"></script>

</body>
</html><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/auth/app-auth.blade.php ENDPATH**/ ?>