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
    "active"=>"",
    "sub_menu" => array(
        "Product Reports" => site_url("ProductManagement/product_list"),
    ),
);
array_push($menu_control, $product_menu);


$order_menu = array(
    "title" => "Order Manegement",
    "icon" => "fa fa-list",
    "active"=>"",
    "sub_menu" => array(
        "Orders Reports" => site_url("Order/orderslist"),
        "Order Analytics" => site_url("Order/orderAnalysis"),
    ),
);
array_push($menu_control, $order_menu);

$client_menu = array(
    "title" => "Client Manegement",
    "icon" => "fa fa-users",
    "active"=>"",
    "sub_menu" => array(
        "Clients Reports" => site_url("#"),
        
    ),
);
array_push($menu_control, $client_menu);



$blog_menu = array(
    "title" => "Blog Management",
    "icon" => "fa fa-edit",
    "active"=>"",
    "sub_menu" => array(
        "Categories" => site_url("CMS/blogCategories"),
        "Add New" => site_url("CMS/newBlog"),
        "Blog List" => site_url("CMS/blogList"),
        "Tags" => site_url("CMS/blogTag"),
    ),
);
array_push($menu_control, $blog_menu);


$cms_menu = array(
    "title" => "Content Management",
    "icon" => "fa fa-file-text",
    "active"=>"",
    "sub_menu" => array(
        "Look Book" => site_url("CMS/lookbook"),
        "Blog" => site_url("CMS/blog"),
    ),
);
array_push($menu_control, $cms_menu);


$msg_menu = array(
    "title" => "Message Management",
    "icon" => "fa fa-envelope",
    "active"=>"",
    "sub_menu" => array(
        "Send Mail/Newsletter (Prm.)" => site_url("#"),
        "Send Mail/Newsletter (Txn.)" => site_url("#"),
    ),
);
array_push($menu_control, $msg_menu);

$schedule_menu = array(
    "title" => "Schedule Management",
    "icon" => "fa fa-calendar",
    "active"=>"",
    "sub_menu" => array(
        "Set Schedule" => site_url("#"),
        "Schedule Report" => site_url("#"),
    ),
);
array_push($menu_control, $schedule_menu);

$user_menu = array(
    "title" => "User Management",
    "icon" => "fa fa-user",
    "active"=>"",
    "sub_menu" => array(
        "Add User" => site_url("#"),
        "Users Reports" => site_url("#"),
    ),
);


array_push($menu_control, $user_menu);

$setting_menu = array(
    "title" => "Settings",
    "icon" => "fa fa-cogs",
    "active"=>"",
    "sub_menu" => array(
        "Add Sliders" => site_url("#"),
      
    ),
);


array_push($menu_control, $setting_menu);


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
<div id="sidebar" class="sidebar">
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

                    <li class="active"><a href="<?php echo site_url("Order/index");?>">Dashboard</a></li>

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
           
         
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->