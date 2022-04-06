<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar doc-sidebar">
    <div class="app-sidebar__user clearfix">
        <div class="dropdown user-pro-body">
            <div>
                <img src="../assets/images/users/male/25.jpg" alt="user-img" class="avatar avatar-lg brround">
                <!-- <a href="editprofile.html" class="profile-img">
                    <span class="fa fa-pencil" aria-hidden="true"></span>
                </a> -->
            </div>
            <div class="user-info">
                <h2><?php echo ucwords(session()->get('name')); ?></h2>
                <span><?php echo ucwords(session()->get('role')); ?></span>
            </div>
        </div>
    </div>
    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item" href="<?php echo base_url('home'); ?>">
                <i class="side-menu__icon ti-package"></i><span class="side-menu__label">Dashboard</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="<?php echo base_url('adduser') ; ?>">
                <i class="side-menu__icon ti-package"></i><span class="side-menu__label"><?php echo (session()->getFlashdata('success') == 'admin') ? "Add User" : "Add Document"; ?></span>
            </a>
        </li>

    </ul>
</aside>
<!-- /Sidebar menu-->