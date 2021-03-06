<?php
$userdata = $this->session->userdata('logged_in');
if ($userdata) {
    
} else {
    redirect("Authentication/index", "refresh");
}
$menu_control = array();

$product_menu = array(
    "title" => "Product Manegement",
    "icon" => "ion-cube",
    "active" => "",
    "sub_menu" => array(
//        "Add Product" => site_url("ProductManager/add_product"),
        "Product Reports" => site_url("ProductManager/productReport"),
        "Categories" => site_url("ProductManager/categories"),
        "Items Prices" => site_url("ProductManager/categoryItems"),
        "Product Sorting" => site_url("ProductManager/productSorting"),
        "Product Colors" => site_url("ProductManager/productColors"),
    ),
);



if (DEFAULT_PAYMENT == 'No') {
    unset($product_menu['sub_menu']['Items Prices']);
} else {
    
}

#array_push($menu_control, $product_menu);


$order_menu = array(
    "title" => "Booking Manegement",
    "icon" => "fa fa-list",
    "active" => "",
    "sub_menu" => array(
        "Book Now" => site_url("Order/booknow/guest"),
        "Booking Reports" => site_url("Order/orderslist"),
        "Booking Analytics" => site_url("Order/index"),
        "Block Dates" => site_url("Order/bookingDateBlock"),
    ),
);
array_push($menu_control, $order_menu);

$client_menu = array(
    "title" => "Client Manegement",
    "icon" => "fa fa-users",
    "active" => "",
    "sub_menu" => array(
        "Clients Reports" => site_url("UserManager/usersReport"),
    ),
);
array_push($menu_control, $client_menu);

$coupons_menu = array(
    "title" => "Coupon Manegement",
    "icon" => "fa fa-file",
    "active" => "",
    "sub_menu" => array(
        "Create Coupons" => site_url("CMS/couponCode"),
    ),
);
//array_push($menu_control, $coupons_menu);



$blog_menu = array(
    "title" => "Blog Management",
    "icon" => "fa fa-edit",
    "active" => "",
    "sub_menu" => array(
        "Categories" => site_url("CMS/blogCategories"),
        "Add New" => site_url("CMS/newBlog"),
        "Blog List" => site_url("CMS/blogList"),
        "Tags" => site_url("CMS/blogTag"),
    ),
);
#array_push($menu_control, $blog_menu);



$lookbook_menu = array(
    "title" => "Gallary Management",
    "icon" => "fa fa-image",
    "active" => "",
    "sub_menu" => array(
        "Categories" => site_url("CMS/gallaryCategories"),
        "Add New" => site_url("CMS/newGallarybook"),
        "Images List" => site_url("CMS/gallaryList"),
//        "Tags" => site_url("CMS/blogTag"),
    ),
);
//array_push($menu_control, $lookbook_menu);

//
//$cms_menu = array(
//    "title" => "Content Management",
//    "icon" => "fa fa-file-text",
//    "active" => "",
//    "sub_menu" => array(
//        "Look Book" => site_url("CMS/lookbook"),
//        "Blog" => site_url("CMS/blog"),
//    ),
//);
//array_push($menu_control, $cms_menu);


$msg_menu2 = array(
    "title" => "Message Management",
    "icon" => "fa fa-envelope",
    "active" => "",
    "sub_menu" => array(
        "Send Mail/Newsletter (Prm.)" => site_url("#"),
        "Send Mail/Newsletter (Txn.)" => site_url("#"),
    ),
);

$msg_menu = array(
    "title" => "Message Management",
    "icon" => "fa fa-envelope",
    "active" => "",
    "sub_menu" => array(
        "Inbox" => site_url("Order/orderInbox"),
    ),
);


array_push($menu_control, $msg_menu);

$schedule_menu = array(
    "title" => "Schedule Management",
    "icon" => "fa fa-calendar",
    "active" => "",
    "sub_menu" => array(
        "Set Schedule" => site_url("Appointment/addAppointment"),
        "Schedule Entry" => site_url("Appointment/listAppointments"),
        "Schedule Report" => site_url("#"),
    ),
);
#array_push($menu_control, $schedule_menu);

$user_menu = array(
    "title" => "User Management",
    "icon" => "fa fa-user",
    "active" => "",
    "sub_menu" => array(
        "Add Manager" => site_url("UserManager/addManager"),
        "Users Reports" => site_url("UserManager/usersReportManager"),
    ),
);


array_push($menu_control, $user_menu);

$setting_menu = array(
    "title" => "Settings",
    "icon" => "fa fa-cogs",
    "active" => "",
    "sub_menu" => array(
        "System Log" => site_url("Services/systemLogReport"),
        "Report Configuration" => site_url("Configuration/reportConfiguration"),
    ),
);


array_push($menu_control, $setting_menu);



$social_menu = array(
    "title" => "Social Management",
    "icon" => "fa fa-calendar",
    "active" => "",
    "sub_menu" => array(
        "Social Link" => site_url("CMS/socialLink"),
    ),
);
array_push($menu_control, $social_menu);


$seo_menu = array(
    "title" => "SEO",
    "icon" => "fa fa-calendar",
    "active" => "",
    "sub_menu" => array(
        "General" => site_url("CMS/siteSEOConfigUpdate"),
        "Page Wise Setting" => site_url("CMS/seoPageSetting"),
    ),
);
array_push($menu_control, $seo_menu);



foreach ($menu_control as $key => $value) {
    $submenu = $value['sub_menu'];
    foreach ($submenu as $ukey => $uvalue) {
        if ($uvalue == current_url()) {
            $menu_control[$key]['active'] = 'active';
            break;
        }
    }
}
?>

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar whitebackground">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src='<?php echo base_url(); ?>assets/profile_image/<?php echo $userdata['image'] ?>' alt="" class="media-object rounded-corner" style="    width: 35px;background: url(<?php echo base_url(); ?>assets/emoji/user.png);    height: 35px;background-size: cover;" /></a>
                </div>
                <div class="info textoverflow" >

                    <?php echo $userdata['first_name']; ?>
                    <small class="textoverflow" title="<?php echo $userdata['username']; ?>"><?php echo $userdata['username']; ?></small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub ">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu">

                    <li class="active"><a href="<?php echo site_url("Order/index"); ?>">Dashboard</a></li>

                </ul>
            </li>
            <?php foreach ($menu_control as $mkey => $mvalue) { ?>

                <li class="has-sub <?php echo $mvalue['active']; ?>">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>  
                        <i class="<?php echo $mvalue['icon']; ?>"></i> 
                        <span><?php echo $mvalue['title']; ?></span>
                    </a>
                    <ul class="sub-menu">
                        <?php
                        $submenu = $mvalue['sub_menu'];
                        foreach ($submenu as $key => $value) {
                            ?>
                            <li><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <li class="nav-header">Tailor Admin V <?php echo PANELVERSION; ?></li>
            <li class="nav-header">-</li>
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->