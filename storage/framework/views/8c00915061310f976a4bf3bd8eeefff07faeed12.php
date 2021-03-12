<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title', 'SECURTAC'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('plugins/toastr/toastr.min.css')); ?>">
    <!-- adminlte stylesheet -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('admin-dist/css/adminlte.min.css')); ?>">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('admin-dist/css/style.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo e(asset(getMetaValue('site_favicon'))); ?>">

    <?php echo $__env->yieldContent('header_scripts'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php echo $__env->make('admin.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php echo $__env->make('admin.partials.main-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <?php echo $__env->make('admin.partials.control-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Main Footer -->
        <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo e(URL::asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Toastr -->
    <script src="<?php echo e(URL::asset('plugins/toastr/toastr.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(URL::asset('admin-dist/js/adminlte.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('footer_scripts'); ?>

</body>
</html><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>