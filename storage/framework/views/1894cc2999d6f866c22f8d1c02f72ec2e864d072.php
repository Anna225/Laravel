<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo e(URL::asset('storage/avatars/'.auth('admin')->user()->avatar)); ?>" class="user-image img-circle elevation-2" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?php echo e(URL::asset('storage/avatars/'.auth('admin')->user()->avatar)); ?>" class="img-circle elevation-2" alt="User Image">
                    <p> <?php echo e(ucfirst( Auth::guard('admin')->user()->name )); ?> </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-default btn-flat">Profile</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/partials/navbar.blade.php ENDPATH**/ ?>