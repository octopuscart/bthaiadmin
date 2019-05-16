<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
function truncate($str, $len) {
    $tail = max(0, $len - 10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len - $tail))));
    return $trunk;
}
?>
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- begin #page-container -->

<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Dashboard <small></small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->

        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-pencil-square"></i></div>
                <div class="stats-info">
                    <h4>Total Orders</h4>
                    <p>1200</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-usd"></i></div>
                <div class="stats-info">
                    <h4>Total Amount</h4>
                    <p>1,291,922</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>Registered User</h4>
                    <p>800</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
        <!-- end col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL VISITORS</h4>
                    <p>13,203</p>	
                </div>
                <!--                <div class="stats-link">
                                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>-->
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-md-8">
            <div class="panel panel-inverse" data-sortable-id="index-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Website Analytics (Last 7 Days)</h4>
                </div>
                <div class="panel-body">
                    <div id="interactive-chart" class="height-sm"></div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
                <li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-picture-o m-r-5"></i> <span class="hidden-xs">Latest Post</span></a></li>
                <li class=""><a href="#purchase" data-toggle="tab"><i class="fa fa-shopping-cart m-r-5"></i> <span class="hidden-xs">Purchase</span></a></li>
            </ul>
            <div class="tab-content" data-sortable-id="index-3">
                <div class="tab-pane fade active in" id="latest-post">
                    <div class="height-sm" data-scrollbar="true">
                        <ul class="media-list media-list-with-divider">
                            <?php
                            foreach ($blog_data as $key => $value) {
                                
                                ?>   
                                <li class="media media-lg">
                                    <a href="javascript:;" class="pull-left">
                                        <img class="media-object" src="<?php echo base_url(); ?>assets/blog_images/<?php echo $value['image']; ?>" alt=""  style="height:100px;width:100px"/>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href='<?php echo site_url('CMS/blogDetails/' . $value['id']); ?>'><?php echo truncate($value['title'], 100); ?></a></h4>
                                        <?php echo truncate($value['description'], 200); ?>    
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade" id="purchase">
                    <div class="height-sm" data-scrollbar="true">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th class="hidden-sm">Product</th>
                                    <th>Amount</th>
                                    <th>User</th>
                                </tr>
                            </thead>
<!--                            <tbody>
                                <tr>
                                    <td>13/02/2013</td>
                                    <td class="hidden-sm">
                                        <a href="javascript:;">
                                            <img src="<?php echo base_url(); ?>assets/img/product/product-1.png" alt=""  />
                                        </a>
                                    </td>
                                    <td>
                                        <h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
                                    </td>
                                    <td>$349.00</td>
                                    <td><a href="javascript:;">Derick Wong</a></td>
                                </tr>
                                <tr>
                                    <td>13/02/2013</td>
                                    <td class="hidden-sm">
                                        <a href="javascript:;">
                                            <img src="<?php echo base_url(); ?>assets/img/product/product-2.png" alt="" />
                                        </a>
                                    </td>
                                    <td>
                                        <h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
                                    </td>
                                    <td>$399.00</td>
                                    <td><a href="javascript:;">Derick Wong</a></td>
                                </tr>
                                <tr>
                                    <td>13/02/2013</td>
                                    <td class="hidden-sm">
                                        <a href="javascript:;">
                                            <img src="<?php echo base_url(); ?>assets/img/product/product-3.png" alt="" />
                                        </a>
                                    </td>
                                    <td>
                                        <h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
                                    </td>
                                    <td>$499.00</td>
                                    <td><a href="javascript:;">Derick Wong</a></td>
                                </tr>
                                <tr>
                                    <td>13/02/2013</td>
                                    <td class="hidden-sm">
                                        <a href="javascript:;">
                                            <img src="<?php echo base_url(); ?>assets/img/product/product-4.png" alt="" />
                                        </a>
                                    </td>
                                    <td>
                                        <h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
                                    </td>
                                    <td>$230.00</td>
                                    <td><a href="javascript:;">Derick Wong</a></td>
                                </tr>
                                <tr>
                                    <td>13/02/2013</td>
                                    <td class="hidden-tablet hidden-phone">
                                        <a href="javascript:;">
                                            <img src="<?php echo base_url(); ?>assets/img/product/product-5.png" alt="" />
                                        </a>
                                    </td>
                                    <td>
                                        <h6><a href="javascript:;">Nunc eleifend lorem eu velit eleifend, eget faucibus nibh placerat.</a></h6>
                                    </td>
                                    <td>$500.00</td>
                                    <td><a href="javascript:;">Derick Wong</a></td>
                                </tr>
                            </tbody>-->
                        </table>
                    </div>
                </div>

            </div>

            <!-- begin col-4 -->
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="index-10">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Calendar</h4>
                    </div>
                    <div class="panel-body">
                        <div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div class="col-md-6">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="index-4">
                    <div class="panel-heading">
                        <h4 class="panel-title">New Registered Users <span class="pull-right label label-success">24 new users</span></h4>
                    </div>
                    <ul class="registered-users-list clearfix">
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-5.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Savory Posh
                                <small>Algerian</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-3.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Ancient Caviar
                                <small>Korean</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-1.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Marble Lungs
                                <small>Hong Kong</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-8.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Blank Bloke
                                <small>Japanese</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-2.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Hip Sculling
                                <small>Cuban</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-6.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Flat Moon
                                <small>Nepalese</small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-4.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Packed Puffs
                                <small>Malaysian></small>
                            </h4>
                        </li>
                        <li>
                            <a href="javascript:;"><img src="<?php echo base_url(); ?>assets/img/user-9.jpg" alt="" /></a>
                            <h4 class="username text-ellipsis">
                                Clay Hike
                                <small>Swedish</small>
                            </h4>
                        </li>
                    </ul>
                    <div class="panel-footer text-center">
                        <a href="javascript:;" class="text-inverse">View All</a>
                    </div>
                </div>
                <!-- end panel -->
            </div>

        </div>
        <!-- end col-8 -->
        <!-- begin col-4 -->
        <div class="col-md-4">
            <div class="panel panel-inverse" data-sortable-id="index-6">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Analytics Details</h4>
                </div>
                <div class="panel-body p-t-0">
                    <table class="table table-valign-middle m-b-0">
                        <thead>
                            <tr>	
                                <th>Source</th>
                                <th>Total</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label class="label label-danger">Total Visitor</label></td>
                                <td>13,203 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
                                <td><div id="sparkline-unique-visitor"></div></td>
                            </tr>
                            <tr>
                                <td><label class="label label-warning">Total Order</label></td>
                                <td>1200</td>
                                <td><div id="sparkline-bounce-rate"></div></td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">Total Page Views</label></td>
                                <td>1,230,030</td>
                                <td><div id="sparkline-total-page-views"></div></td>
                            </tr>
                            <tr>
                                <td><label class="label label-primary">Avg Time On Site</label></td>
                                <td>00:03:45</td>
                                <td><div id="sparkline-avg-time-on-site"></div></td>
                            </tr>
                            <tr>
                                <td><label class="label label-default">% New Visits</label></td>
                                <td>40.5%</td>
                                <td><div id="sparkline-new-visits"></div></td>
                            </tr>
                            <tr>
                                <td><label class="label label-inverse">Return Visitors</label></td>
                                <td>73.4%</td>
                                <td><div id="sparkline-return-visitors"></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-inverse" data-sortable-id="index-9">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">World Visitors</h4>
                </div>
                <div class="panel-body p-0">
                    <div id="world-map" class="height-sm width-full"></div>
                </div>
            </div>

            <div class="panel panel-inverse" data-sortable-id="index-8">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Todo List</h4>
                </div>
                <div class="panel-body p-0">
                    <ul class="todolist">
                        <li class="active">
                            <a href="javascript:;" class="todolist-container active" data-click="todolist">
                                <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                                <div class="todolist-title">Visit to Australia.</div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="todolist-container" data-click="todolist">
                                <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                                <div class="todolist-title">Appointment made by Mr. Adam Smith.</div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="todolist-container" data-click="todolist">
                                <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                                <div class="todolist-title">Review on Zegna Stock.</div>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>


        </div>
        <!-- end col-4 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->





<?php
$this->load->view('layout/footer');
?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboard-v2.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        Dashboard.init();
        DashboardV2.init();
    });
</script>
<script>
    $(function () {
<?php
$checklogin = $this->session->flashdata('checklogin');
if ($checklogin['show']) {
    ?>
            $.gritter.add({
                title: "<?php echo $checklogin['title']; ?>",
                text: "<?php echo $checklogin['text']; ?>",
                image: '<?php echo base_url(); ?>assets/emoji/<?php echo $checklogin['icon']; ?>',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class '
                        });
    <?php
}
?>
                })
</script>