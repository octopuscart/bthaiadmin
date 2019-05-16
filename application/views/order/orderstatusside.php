<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Select Order Status</h3>
    </div>
    <div class="box-body">

        <a class="btn btn-block  btn-social btn-bitbucket" href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Pending");?>">
            <i class="fa fa-clock-o"></i> Pending
        </a>

        <a class="btn btn-block btn-social btn-primary" href="<?php echo site_url("Order/orderdetails_payments/".$order_key."?status=Payment Confirmed");?>">
            <i class="fa fa-money"></i> Payment Confirmed
        </a>

        <a class="btn btn-block btn-social btn-warning" href="<?php echo site_url("Order/orderdetails_shipping/".$order_key."?status=Shipped");?>">
            <i class="fa fa-truck"></i> Shipped
        </a>

        <a class="btn btn-block btn-social btn-flickr"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Delivered");?>">
            <i class="fa fa-thumbs-o-up"></i> Delivered
        </a>

        <a class="btn btn-block btn-social btn-danger"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Canceled");?>">
            <i class="fa fa-times"></i> Canceled
        </a>

        <a class="btn btn-block btn-social btn-instagram"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Returned");?>">
            <i class="fa fa-reply"></i> Returned
        </a>
        <a class="btn btn-block btn-social btn-info"  href="<?php echo site_url("Order/orderdetails/".$order_key."?status=Other");?>">
            <i class="fa fa-question"></i> Other
        </a>
    </div>
</div>
