<?php

use Symfony\Contracts\Service\Attribute\Required;

 echo view('cms/head.php'); ?>
<!--Page-->
<div class="page">
    <div class="page-main">

        <!--Header-->
        <?php echo view('cms/header.php'); ?>
        <!--/Header-->

        <!-- Sidebar menu-->
        <?php echo view('cms/sidebar_menu.php'); ?>
        <!-- /Sidebar menu-->
        
        <!--App-Content-->
        <div class="app-content">
            <div class="side-app">
                <div class="page-header">
                    <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
                    <h4 class="page-title">Add User</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(session()->get('user_type_name') . '/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Add</li>
                    </ol>
                </div>
                <div class="row">
                    <?php $validation =  \Config\Services::validation(); ?>
                    <form action="<?php echo (session()->get('role') == 'admin') ? base_url('/adduserstore') : base_url('/documentstore'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <?php echo csrf_field() ?>
                        <div class="col-12">
                            <?php if(session()->get('role') == 'admin'){ ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add User</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control <?php echo ($validation->getError('name')) ? "is-invalid" : ""; ?>" id="name" name="name" placeholder="User Name"  value="<?php echo set_value('name'); ?>" />
                                                <?php if ($validation->getError('name')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('name') ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control <?php echo ($validation->getError('mobile')) ? "is-invalid" : ""; ?>" id="mobile" name="mobile" maxlength="10" minlength="10" placeholder="mobile"  value="<?php echo set_value('mobile'); ?>" />
                                                <?php if ($validation->getError('mobile')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('mobile') ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="d-flex">
                                        <a href="<?php echo base_url("/home") ?>" class="btn btn-link">Cancel</a>
                                        <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Document</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">Document</label>
                                                <input type="file" class="dropify <?php echo ($validation->getError('file_document')) ? "is-invalid" : ""; ?>" data-height="120" id="file_document" name="file_document" value="<?php echo set_value('file_document'); ?>"/>
                                                <?php if ($validation->getError('file_document')) : ?>
                                                    <div class="invalid-feedback1" style="color: crimson;">
                                                        <?= $validation->getError('file_document') ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="d-flex">
                                        <a href="<?php echo base_url("/home") ?>" class="btn btn-link">Cancel</a>
                                        <button type="submit" class="btn btn-primary ml-auto">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>    
                        </div>
                    </form>
                </div>
                <!--App-Content-->

            </div>
            <!--Footer-->
            <?php echo view('cms/page_footer.php'); ?>
            <!--/Footer-->
        </div>
        <!--/Page-->
        <?php echo view('cms/footer.php'); ?>