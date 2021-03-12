<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset(getMetaValue('site_logo'))); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">SECURTAC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(URL::asset('storage/avatars/'.auth('admin')->user()->avatar)); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo e(route('admin.profile')); ?>" class="d-block"><?php echo e(ucfirst( Auth::guard('admin')->user()->name )); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e((request()->is('admin')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/users*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/users*')) ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e((request()->is('admin/users')) ? 'active' : ''); ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.users.create')); ?>" class="nav-link <?php echo e((request()->is('admin/users/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/services*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/services*')) ? 'active' : ''); ?>">
                        <i class="fas fa-users-cog"></i>
                        <p> Services
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.services.index')); ?>" class="nav-link <?php echo e((request()->is('admin/services')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Services</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/chapters*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/chapters*')) ? 'active' : ''); ?>">
                        <i class="far fa-bookmark"></i>
                        <p> Training Chapters
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.chapters.index')); ?>" class="nav-link <?php echo e((request()->is('admin/chapters')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Chapters</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.chapters.create')); ?>" class="nav-link <?php echo e((request()->is('admin/chapters/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Chapter</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/home-slides*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/home-slides*')) ? 'active' : ''); ?>">
                        <i class="far fa-images"></i>
                        <p> Homepage Slider
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.home-slides.index')); ?>" class="nav-link <?php echo e((request()->is('admin/home-slides')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Slides</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.home-slides.create')); ?>" class="nav-link <?php echo e((request()->is('admin/home-slides/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Slide</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/slots*') || request()->is('admin/slot-services/*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/slots*') || request()->is('admin/slot-services/*'))  ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <p> Schedule Slots
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.services.slots')); ?>" class="nav-link <?php echo e((request()->is('admin/slots*') || request()->is('admin/slot-services/*'))  ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Slots</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/pages*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/pages*')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <p> Pages
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.pages.index')); ?>" class="nav-link <?php echo e((request()->is('admin/pages')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.pages.create')); ?>" class="nav-link <?php echo e((request()->is('admin/pages/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.referrals')); ?>" class="nav-link <?php echo e((request()->is('admin/referrals*')) ? 'active' : ''); ?>">
                        <i class="fas fa-users-cog"></i>
                        <p> Referral Reports </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.settings')); ?>" class="nav-link <?php echo e((request()->is('admin/settings*')) ? 'active' : ''); ?>">
                        <i class="fas fa-sliders-h"></i>
                        <p> Settings </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.consent-documents.index')); ?>" class="nav-link <?php echo e((request()->is('admin/consent-documents*')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <p> Consent Documents </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.cpr-certificates.index')); ?>" class="nav-link <?php echo e((request()->is('admin/cpr-certificates*')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <p> CPR Certificates </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/resources*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/resources*')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <p> Resources
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.resources.index')); ?>" class="nav-link <?php echo e((request()->is('admin/resources')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Resources</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.resources.create')); ?>" class="nav-link <?php echo e((request()->is('admin/resources/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Resource</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/transactions*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/transactions*')) ? 'active' : ''); ?>">
                        <i class="fas fa-file-alt"></i>
                        <p> Transactions
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.successful.transactions')); ?>" class="nav-link <?php echo e((request()->is('admin/transactions/successful/*') || request()->is('admin/transactions/successful')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Successful</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.failed.transactions')); ?>" class="nav-link <?php echo e((request()->is('admin/transactions/failed/*') || request()->is('admin/transactions/failed') ) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Failed</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/testimonials*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/testimonials*')) ? 'active' : ''); ?>">
                        <i class="fas fa-quote-left"></i>
                        <p> Testimonials
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="nav-link <?php echo e((request()->is('admin/testimonials')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Testimonials</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.testimonials.create')); ?>" class="nav-link <?php echo e((request()->is('admin/testimonials/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Testimonial</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php echo e((request()->is('admin/clients*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('admin/clients*')) ? 'active' : ''); ?>">
                        <i class="fas fa-address-card"></i>
                        <p> Clients
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.clients.index')); ?>" class="nav-link <?php echo e((request()->is('admin/clients')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Clients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.clients.create')); ?>" class="nav-link <?php echo e((request()->is('admin/clients/create')) ? 'active' : ''); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Client</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/partials/main-sidebar.blade.php ENDPATH**/ ?>