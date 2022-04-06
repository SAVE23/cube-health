<?php echo view('cms/head.php'); ?>
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
        <div class="app-content  my-3 my-md-5">
            <div class="side-app">
                <div class="page-header">
                    <h4 class="page-title"><?php echo session()->get('role'); ?></h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div>
                                <div class="user-tabs mb-4">
                                    <?php if (session()->getFlashdata('success')) : ?>
                                        <div class="nav panel-tabs">
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                                                <?php echo session()->getFlashdata('success') ?>
                                            </div>
                                        </div>
                                    <!--<?php elseif (session()->getFlashdata('failed')) : ?>
                                        <div class="nav panel-tabs">
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                                                <?php echo session()->getFlashdata('failed') ?>
                                            </div>
                                        </div>-->
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active " id="tab1">
                                        <div class="mail-option">
                                            <ul class="unstyled inbox-pagination">
                                                <li><span>1-10 of 12 items</span></li>
                                                <li>
                                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                        if (count($users_data) > 0) {
                                        ?>
                                        <div class="table-responsive border-top">

                                            <table class="table card-table table-bordered table-hover table-vcenter text-nowrap">
                                                <tbody>
                                                    <?php if(session()->get('role') == 'admin'){ ?>
                                                    <tr>
                                                        <th class="w-1">Sr No.</th>
                                                        <th class="w-1">User Name</th>
                                                        <th>Mobile</th>
                                                        <th>Created Date</th>

                                                    </tr>
                                                    <?php } else { ?>
                                                    <tr>
                                                        <th class="w-1">Sr No.</th>
                                                        <th class="w-1">File Name</th>
                                                        <th>Created Date</th>

                                                    </tr>
                                                    <?php } ?>
                                                    <?php
                                                    
                                                        $count = 1;
                                                        foreach ($users_data as $data) {
                                                            if(session()->get('role') == 'admin'){
                                                    ?>
                                                            <tr>
                                                                <th><?php echo $count; ?></th>
                                                                <td><a href="#" class="btn-link"><?php echo ucwords($data['name']); ?></a></td>
                                                                <td><?php echo ucwords($data['mobile']); ?></td>
                                                                <td><?php echo date_format(date_create($data['created_at']), "M d,Y"); ?></td>

                                                            </tr>
                                                    <?php
                                                            }else {
                                                    ?>
                                                            <tr>
                                                                <th><?php echo $count; ?></th>
                                                                <td><a href="#" class="btn-link">
                                                                    <embed src="data:<?php echo $data['file_type']; ?>;base64,<?php echo base64_encode($data['file_content']); ?>">
                                                                </a></td>
                                                                <td><?php echo date_format(date_create($data['created_at']), "M d,Y"); ?></td>

                                                            </tr>
                                                    <?php            
                                                            }
                                                            $count++;
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        } else {
                                            echo '<tr><h4 class="mb-4 font-weight-bold">No data list found</h4></tr>';
                                        } 
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--App-Content-->

    </div>
    <!--Footer-->
    <?php echo view('cms/page_footer.php'); ?>
    <!--/Footer-->
</div>
<!--/Page-->
<?php echo view('cms/footer.php'); ?>