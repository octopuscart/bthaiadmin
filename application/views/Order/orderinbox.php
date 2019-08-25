<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>



<!-- begin #content -->
<div id="content" class="content content-full-width" ng-controller="inboxController">
    <!-- begin vertical-box -->
    <div class="vertical-box">
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column width-250">
            <!-- begin wrapper -->
            <div class="wrapper bg-silver text-center">
                <a href="email_compose.html" class="btn btn-success p-l-40 p-r-40 btn-sm">
                    Compose
                </a>
            </div>
            <!-- end wrapper -->
            <!-- begin wrapper -->
            <div class="wrapper">
                <p><b>FOLDERS</b></p>
                <ul class="nav nav-pills nav-stacked nav-sm">
                    <li class="active"><a href="email_inbox_v2.html"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <span class="badge pull-right">52</span></a></li>
                    <li><a href="email_inbox_v2.html"><i class="fa fa-flag fa-fw m-r-5"></i> Important</a></li>
                    <li><a href="email_inbox_v2.html"><i class="fa fa-send fa-fw m-r-5"></i> Sent</a></li>
                    <li><a href="email_inbox_v2.html"><i class="fa fa-pencil fa-fw m-r-5"></i> Drafts</a></li>
                    <li><a href="email_inbox_v2.html"><i class="fa fa-trash fa-fw m-r-5"></i> Trash</a></li>
                </ul>
                <p><b>LABEL</b></p>
                <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i> Admin</a></li>
                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-primary"></i> Designer & Employer</a></li>
                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Staff</a></li>
                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Sponsorer</a></li>
                    <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-danger"></i> Client</a></li>
                </ul>
            </div>
            <!-- end wrapper -->
        </div>
        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">
            <!-- begin wrapper -->
            <div class="wrapper bg-silver-lighter">
                <!-- begin btn-toolbar -->
                <div class="btn-toolbar">
                    <!-- begin btn-group -->
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm">
                            <i class="fa fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-white btn-sm">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                    <!-- end btn-group -->
                    <!-- begin btn-group -->
                    <div class="btn-group dropdown">
                        <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                            View All <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu text-left text-sm">
                            <li class="active"><a href="#"><i class="fa fa-circle f-s-10 fa-fw m-r-5"></i> All</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Unread</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Contacts</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Groups</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Newsletters</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Social updates</a></li>
                            <li><a href="javascript:;"><i class="fa f-s-10 fa-fw m-r-5"></i> Everything else</a></li>
                        </ul>
                    </div>
                    <!-- end btn-group -->
                    <!-- begin btn-group -->
                    <div class="btn-group">
                        <button class="btn btn-sm btn-white" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
                    </div>
                    <!-- end btn-group -->
                    <!-- begin btn-group -->
                    <div class="btn-group">
                        <button class="btn btn-sm btn-white hide" data-email-action="delete"><i class="fa fa-times m-r-3"></i> <span class="hidden-xs">Delete</span></button>
                        <button class="btn btn-sm btn-white hide" data-email-action="archive"><i class="fa fa-folder m-r-3"></i> <span class="hidden-xs">Archive</span></button>
                        <button class="btn btn-sm btn-white hide" data-email-action="archive"><i class="fa fa-trash m-r-3"></i> <span class="hidden-xs">Junk</span></button>
                    </div>
                    <!-- end btn-group -->
                </div>
                <!-- end btn-toolbar -->
            </div>
            <!-- end wrapper -->
            <!-- begin list-email -->
            <ul class="list-group list-group-lg no-radius list-email">


                <li class="list-group-item inverse  " ng-repeat="mail in inboxdata.emaillist">
                    <a href="<?php echo site_url("Order/orderInboxDetails/"); ?>{{mail.id}}">
                        <div class="email-checkbox">
                            <label>
                                <i class="fa fa-square-o"></i>
                                <input type="checkbox" data-checked="email-checkbox" />
                            </label>
                        </div>
                        <!--                    <a href="email_detail.html" class="email-user">
                                                <img src="assets/img/user-14.jpg" alt="" />
                                            </a>-->
                        <div class="email-info">
                            <span class="email-time"><i class="fa fa-calendar-o"></i> {{mail.datetime}}</span>
                            <h5 class="email-title">
                                {{mail.subject}}

                                <span class="label label-danger f-s-10" ng-if="mail.seen == '0'">New</span>
                            </h5>
                            <p class="email-desc">
                                <span class="fromemail">{{mail.from_email}}</span>
                                <span class="datetime"></span>
                            </p>
                        </div>
                    </a>
                </li>

            </ul>
            <!-- end list-email -->
            <!-- begin wrapper -->
            <div class="wrapper bg-silver-lighter clearfix">
                <div class="btn-group pull-right">
                    <button class="btn btn-white btn-sm">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-white btn-sm">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                <div class="m-t-5">1,232 messages</div>
            </div>
            <!-- end wrapper -->
        </div>
        <!-- end vertical-box-column -->
    </div>
    <!-- end vertical-box -->
</div>
<!-- end #content -->

<?php
$this->load->view('layout/footer');
?> 

<script>
    $(function () {


    })


</script>
<script src="<?php echo base_url(); ?>assets/angular/booking.js"></script>