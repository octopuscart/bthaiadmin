<style>
    tr.invoice_footer td {
    background: #2d353c;
    color: white;
    font-size: 12px;
}
     tr.invoice_footer th {
    background: #2d353c;
    color: white;
    font-size: 18px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="">
            <ul class="timeline">
                <?php
                foreach ($user_order_status as $key => $value) {
                    ?>

                    <li>
                        <!--timeline time label-->
                        <div class="timeline-time">
                            <span class="date"><?php echo $value->c_time; ?> </span>
                            <span class="time"><?php echo $value->c_date; ?></span>

                        </div>
                        <!--/.timeline-label-->

                        <!--timeline item-->

                        <div class="timeline-icon">
                            <a href="javascript:;"><i class="fa fa-paper-plane"></i></a>
                        </div>
                        <!-- begin timeline-body -->
                        <div class="timeline-body">

                            <div class="timeline-content">
                                <b><a href="javascript:;"><?php echo $value->status ?></a></b>
                                <p>
                                    <?php echo $value->remark; ?><br />
                                    <?php echo $value->description; ?>
                                </p>
                                <a class="btn btn-danger btn-xs"
                                   href="<?php echo site_url('Order/remove_order_status/' . $value->id . "/" . $order_key); ?>"><i
                                        class="fa fa-trash"></i> Remove</a>
                            </div>

                        </div>
                        <!-- end timeline-body -->

                        <!--END timeline item-->



                        <?php
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>

<div class="invoice" style='margin-top:20px;'>
    <div class="invoice-company">
        <span class="pull-right hidden-print">
            <a class="btn btn-success  btn-sm m-b-10"
               href="<?php echo site_url("order/order_mail_send_direct/" . $ordersdetails['order_data']->order_key) ?>"><i
                    class="fa fa-envelope"></i> Send Current Status Mail</a>
            <a class="btn btn-success btn-sm m-b-10"
               href="<?php echo site_url("order/order_pdf_worker/" . $ordersdetails['order_data']->id) ?>"><i
                    class="fa fa-cogs "></i> Worker Report</a>
            <a class="btn btn-success btn-sm m-b-10"
               href="<?php echo site_url("order/order_pdf/" . $ordersdetails['order_data']->id) ?>"><i
                    class="fa fa-download "></i> Order PDF</a>
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i
                    class="fa fa-print m-r-5"></i> Print</a>
        </span>
        <?php echo $ordersdetails['order_data']->order_no; ?>
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <small>Shipping Address</small>
            <address class="m-t-5 m-b-5">
                <strong style="text-transform: capitalize;margin-top: 10px;">
                    <?php echo $ordersdetails['order_data']->name; ?>
                </strong> <br />
                <div style="    padding: 5px 0px;">
                    <?php echo $ordersdetails['order_data']->address1; ?><br />
                    <?php echo $ordersdetails['order_data']->address2; ?><br />
                    <?php echo $ordersdetails['order_data']->state; ?>
                    <?php echo $ordersdetails['order_data']->city; ?>

                    <?php echo $ordersdetails['order_data']->country; ?>
                    <?php echo $ordersdetails['order_data']->zipcode; ?>

                </div>
                <table class="gn_table">
                    <tr>
                        <td>Email</td>
                        <td>: <?php echo $ordersdetails['order_data']->email; ?> </td>
                    </tr>
                    <tr>
                        <td>Contact No.</td>
                        <td>: <?php echo $ordersdetails['order_data']->contact_no; ?> </td>
                    </tr>
                </table>
            </address>
        </div>

        <div class="invoice-to">
            <small>Order Information</small>
            <address class="m-t-5 m-b-5">
                <table class="gn_table">
                    <tr>
                        <th>Order No.</th>
                        <td>: <?php echo $ordersdetails['order_data']->order_no; ?> </td>
                    </tr>
                    <tr>
                        <th>Date Time</th>
                        <td>: <?php echo $ordersdetails['order_data']->order_date; ?>
                            <?php echo $ordersdetails['order_data']->order_time; ?> </td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td>: <?php echo $ordersdetails['order_data']->payment_mode; ?> </td>
                    </tr>
                    <tr>
                        <th>Txn No.</th>
                        <td>:
                            <?php echo $ordersdetails['payment_details']['txn_id'] ? $ordersdetails['payment_details']['txn_id'] : '---'; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: <?php
                            if ($ordersdetails['order_status']) {
                                echo end($ordersdetails['order_status'])->status;
                            } else {
                                echo "Pending";
                            }
                            ?> </td>
                    </tr>
                </table>
            </address>
        </div>
        <div class="invoice-date">
            <small>Invoice /
                <?php echo date_format(date_create($ordersdetails['order_data']->order_date . ' ' . $ordersdetails['order_data']->order_time), "F"); ?>

                period</small>
            <div class="date m-t-5">
                <?php echo date_format(date_create($ordersdetails['order_data']->order_date . ' ' . $ordersdetails['order_data']->order_time), "l, d F Y"); ?>
            </div>
            <div class="invoice-detail">
                #<?php echo $ordersdetails['order_data']->order_no; ?><br>

            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <td style="width: 20px;text-align: right">S.No.</td>
                        <td colspan="2" style="text-align: center">Product</td>
                        <td style="text-align: right;width: 130px"">Price (In <?php echo GLOBAL_CURRENCY; ?>)</td>
                        <td style=" text-align: right;width: 20px"">Qnty.</td>
                        <td style="text-align: right;width: 130px">Total (In <?php echo GLOBAL_CURRENCY; ?>)</td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($ordersdetails['cart_data'] as $key => $product) {
                        ?>
                        <tr>
                            <td style="text-align: right">
                                <?php echo $key + 1; ?>
                            </td>

                            <td style="width: 80px">
                    <center>
                        <img src=" <?php echo $product->file_name; ?>" style="height: 70px;" />
                    </center>
                    </td>

                    <td style="width: 300px;">

                        <?php echo $product->title; ?> - <?php echo $product->item_name; ?>
                        <br />
                        <small style="font-size: 15px;">(<?php echo $product->sku; ?>)</small>


                        <div class="panel-group" id="accordion" style="width:350px;">
                            <div class="panel panel-default overflow-hidden">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed"
                                           data-toggle="collapse" data-parent="#accordion" href="#collapseStyle">
                                            <i class="fa fa-plus-circle pull-right"></i>
                                            View Style Summary
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseStyle" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php
                                        echo "<ul class='list-group'>";
                                        foreach ($product->custom_dict as $key => $value) {
                                            echo "<li class='list-group-item'>$key <span class='badge'>$value</span></li>";
                                        }
                                        echo "</ul>";
                                        ?> </div>
                                </div>
                            </div>
                        </div>
                        </div>





                    </td>

                    <td style="text-align: right">
                        <?php echo $product->price; ?>
                    </td>

                    <td style="text-align: right">
                        <?php echo $product->quantity; ?>
                    </td>

                    <td style="text-align: right;">
                        <?php echo $product->total_price; ?>
                    </td>
                    </tr>

                    <?php
                }
                ?>


                </tbody>
                <tfoot class="invoice-header">
                    <tr>
                        <td colspan="7">
                            Measurement Type:
                            <?php
                            echo $ordersdetails['order_data']->measurement_style;
                            if (count($ordersdetails['measurements_items'])) {
                                ?>
                                <a role="button" class="btn btn-xs btn-default" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapsemeasurements" aria-expanded="true" aria-controls="collapseOne">
                                    View Measurement
                                </a>
                                <div id="collapsemeasurements" class="panel-collapse collapse " role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel-body" style="padding:10px 0px;">
                                                <?php
                                                echo "<ul class='list-group'>";
                                                foreach ($ordersdetails['measurements_items'] as $keym => $valuem) {
                                                    $mvalues = explode(" ", $valuem['measurement_value']);
                                                    echo "<li class='list-group-item'>" . $valuem['measurement_key'] . " <span class='measurement_right_text'><span class='measurement_text'>" . $mvalues[0] . "</span><span class='fr_value'>" . $mvalues[1] . '"' . "</span></span></li>";
                                                }
                                                echo "</ul>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>

                    <!--end of cart details-->
                    <tr>
                        <td colspan="7">
                            <?php
                            $order_status = $ordersdetails['order_status'];
                            $laststatus = "";
                            $laststatus_cdate = "";
                            $laststatus_ctime = "";
                            $laststatusremark = "";
                            foreach ($order_status as $key => $value) {
                                $laststatus = $value->status;
                                $laststatus_cdate = $value->c_date;
                                $laststatus_ctime = $value->c_time;
                                $laststatusremark = $value->remark;
                            }
                            ?>



            <!--                                        <button class="btn btn-button pull-right" type="button" data-toggle="collapse" data-target="#collapseProduct<?php echo $product->id; ?>" aria-expanded="false" aria-controls="collapseProduct<?php echo $product->id; ?>">
                                            Show More  <i class="fa fa-arrow-down"></i>
                                        </button>-->

                            <div class="statusdiv">
                                Current Status: <?php echo $laststatus; ?>
                                <p style="font-size: 10px;    margin: 0;">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo $laststatus_cdate; ?>
                                    <?php echo $laststatus_ctime; ?>
                                </p>

                                <p style="font-size: 15px;    margin: 0;">
                                    <?php echo $laststatusremark; ?>
                                </p>
                            </div>






                            <div class="collapse" id="collapseProduct<?php echo $product->id; ?>">
                                <div class="">
                                    <?php
                                    foreach ($product->product_status as $key => $value) {
                                        ?>
                                        <div class="productStatusBlock">
                                            <p style="font-size: 10px;margin: 0;"><i class="fa fa-calendar"></i>
                                                <?php echo $value->c_date ?> <?php echo $value->c_time ?></p>
                                            <h3><?php echo $value->status; ?></h3>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>



                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" rowspan="4" style="font-size: 12px">
                            <b>Total Amount in Words:</b><br />
                            <span style="text-transform: capitalize">
                                <span style="text-transform: capitalize">
                                    <?php echo $ordersdetails['order_data']->amount_in_word; ?></span>

                            </span>
                        </td>

                    </tr>
                    <tr class="invoice_footer">
                        <td class="" colspan="2" style="text-align: right">Sub Total</td>
                        <td style="text-align: right;width: 60px">
                            {{"<?php echo $ordersdetails['order_data']->sub_total_price; ?>"|currency:"<?php echo GLOBAL_CURRENCY; ?> "}}
                        </td>
                    </tr>
                    <!--                                <tr>
                                        <td colspan="2" style="text-align: right">Credit Used</td>
                                        <td style="text-align: right;width: 60px"><?php echo $ordersdetails['order_data']->credit_price; ?> </td>
                                    </tr>-->
                    <tr class="invoice_footer">
                        <th colspan="2" style="text-align: right">Total Amount</th>
                        <th style="text-align: right;width: 60px">
                            {{"<?php echo $ordersdetails['order_data']->total_price; ?>"|currency:"<?php echo GLOBAL_CURRENCY; ?> "}}
                        </th>
                    </tr>

                </tfoot>

            </table>
        </div>
        <!--        <div class="invoice-price">
                    <div class="invoice-price-left">
                        <div class="invoice-price-row">
                            <div class="sub-price">
                                <small>SUBTOTAL</small>
                                $4,500.00
                            </div>
                            <div class="sub-price">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="sub-price">
                                <small>PAYPAL FEE (5.4%)</small>
                                $108.00
                            </div>
                        </div>
                    </div>
                    <div class="invoice-price-right">
                        <small>TOTAL</small> $4508.00
                    </div>
                </div>-->
    </div>
    <!--    <div class="invoice-note">
            * Make all cheques payable to [Your Company Name]<br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact [Name, Phone Number, Email]
        </div>
        <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
                THANK YOU FOR YOUR BUSINESS
            </p>
            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-globe"></i> matiasgallipoli.com</span>
                <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
                <span class="m-r-10"><i class="fa fa-envelope"></i> rtiemps@gmail.com</span>
            </p>
        </div>-->
</div>




