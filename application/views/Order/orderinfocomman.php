<!-- Main content -->
<section class="content "  style="min-height: auto;">

    <div class="col-md-12">
        <!-- Table row -->
        <div class="col-md-12" style=" margin-top: 10px;">
            <article class="" style="padding: 10px;">
                <div class="row">
                    <div class="col-md-12 well well-sm" style="">
                        <div class="btn-group pull-right">
                            <a class="btn btn-success  " href="<?php echo site_url("order/order_mail_send_direct/" . $ordersdetails['order_data']->order_key) ?>"><i class="fa fa-envelope"></i> Send Current Status Mail</a>
                            <a class="btn btn-success btn-bitbucket" href="<?php echo site_url("order/order_pdf_worker/" . $ordersdetails['order_data']->id) ?>"><i class="fa fa-cogs "></i> Worker Report</a>
                            <a class="btn btn-success btn-google" href="<?php echo site_url("order/order_pdf/" . $ordersdetails['order_data']->id) ?>"><i class="fa fa-download "></i> Order PDF</a>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered"  align="center" border="0" cellpadding="0" cellspacing="0"  style="background: #fff">
                    <tr>
                        <td style="font-size: 15px;width: 50%" >
                            <b style="color:#c0c0c0">Shipping Address</b><br/>
                            <span style="text-transform: capitalize;margin-top: 10px;"> 
                                <?php echo $ordersdetails['order_data']->name; ?>
                            </span> <br/>
                            <div style="    padding: 5px 0px;">
                                <?php echo $ordersdetails['order_data']->address1; ?><br/>
                                <?php echo $ordersdetails['order_data']->address2; ?><br/>
                                <?php echo $ordersdetails['order_data']->state; ?>
                                <?php echo $ordersdetails['order_data']->city; ?>

                                <?php echo $ordersdetails['order_data']->country; ?> <?php echo $ordersdetails['order_data']->zipcode; ?>

                            </div>
                            <table class="gn_table">
                                <tr>
                                    <th>Email</th>
                                    <td>: <?php echo $ordersdetails['order_data']->email; ?> </td>
                                </tr>
                                <tr>
                                    <th>Contact No.</th>
                                    <td>: <?php echo $ordersdetails['order_data']->contact_no; ?> </td>
                                </tr>
                            </table>


                        </td>
                        <td style="font-size: 15px;width: 50%" >
                            <b  style="color:#c0c0c0">Order Information</b><br/>
                            <table class="gn_table">
                                <tr>
                                    <th>Order No.</th>
                                    <td>: <?php echo $ordersdetails['order_data']->order_no; ?> </td>
                                </tr>
                                <tr>
                                    <th>Date Time</th>
                                    <td>: <?php echo $ordersdetails['order_data']->order_date; ?> <?php echo $ordersdetails['order_data']->order_time; ?>  </td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td>: <?php echo $ordersdetails['order_data']->payment_mode; ?> </td>
                                </tr>
                                <tr>
                                    <th>Txn No.</th>
                                    <td>: <?php echo $payment_details['txn_id'] ? $payment_details['txn_id'] : '---'; ?> </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>: <?php
                                        if ($order_status) {
                                            echo end($order_status)->status;
                                        } else {
                                            echo "Pending";
                                        }
                                        ?> </td>
                                </tr>
                            </table>


                        </td>
                    </tr>
                </table>


                <table class="table table-bordered"  border-color= "#9E9E9E" align="center" border="1" cellpadding="0" cellspacing="0" style="background: #fff;">
                    <tr>
                        <td colspan="6">
                            <b  style="color:#c0c0c0">Order Description</b><br/>
                        </td>
                    </tr>
                    <tr style="font-weight: bold">
                        <td style="width: 20px;text-align: right">S.No.</td>
                        <td colspan="2"  style="text-align: center">Product</td>

                        <td style="text-align: right;width: 100px"">Price (In <?php echo globle_currency; ?>)</td>
                        <td style="text-align: right;width: 20px"">Qnty.</td>
                        <td style="text-align: right;width: 100px">Total (In <?php echo globle_currency; ?>)</td>
                    </tr>
                    <!--cart details-->
                    <?php
                    foreach ($ordersdetails['cart_data'] as $key => $product) {
                        ?>
                        <tr>
                            <td style="text-align: right">
                                <?php echo $key + 1; ?>
                            </td>

                            <td style="width: 80px">
                        <center>   
                            <img src=" <?php echo $product->file_name; ?>" style="height: 70px;"/>
                        </center>
                        </td>

                        <td style="width: 200px;">

                            <?php echo $product->title; ?> - <?php echo $product->item_name; ?>
                            <br/>
                            <small style="font-size: 15px;">(<?php echo $product->sku; ?>)</small>

                            <h4 class="panel-title">
                                <a role="button" class="btn btn-xs btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $product->id; ?>" aria-expanded="true" aria-controls="collapseOne">
                                    View Summary
                                </a>
                            </h4>
                            </div>
                            <div id="collapse<?php echo $product->id; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" style="padding:10px 0px;">
                                    <?php
                                    echo "<ul class='list-group'>";
                                    foreach ($product->custom_dict as $key => $value) {
                                        echo "<li class='list-group-item'>$key <span class='badge'>$value</span></li>";
                                    }
                                    echo "</ul>";
                                    ?>                                            </div>
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



                    <td colspan="7">
                        Measurement Type:
                        <?php
                        echo $ordersdetails['order_data']->measurement_style;
                        if (count($ordersdetails['measurements_items'])) {
                            ?>
                            <a role="button" class="btn btn-xs btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapsemeasurements" aria-expanded="true" aria-controls="collapseOne">
                                View Measurement
                            </a>
                            <div id="collapsemeasurements" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
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
                                            <p style="font-size: 10px;margin: 0;"><i class="fa fa-calendar"></i> <?php echo $value->c_date ?> <?php echo $value->c_time ?></p>
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
                        <td colspan="3"  rowspan="4" style="font-size: 12px">
                            <b>Total Amount in Words:</b><br/>
                            <span style="text-transform: capitalize">
                                <span style="text-transform: capitalize"> <?php echo $ordersdetails['order_data']->amount_in_word; ?></span>

                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">Sub Total</td>
                        <td style="text-align: right;width: 60px">{{"<?php echo $ordersdetails['order_data']->sub_total_price; ?>"|currency:"<?php echo globle_currency; ?> "}} </td>
                    </tr>
<!--                                <tr>
                        <td colspan="2" style="text-align: right">Credit Used</td>
                        <td style="text-align: right;width: 60px"><?php echo $ordersdetails['order_data']->credit_price; ?> </td>
                    </tr>-->
                    <tr>
                        <td colspan="2" style="text-align: right">Total Amount</td>
                        <td style="text-align: right;width: 60px">{{"<?php echo $ordersdetails['order_data']->total_price; ?>"|currency:"<?php echo globle_currency; ?> "}} </td>
                    </tr>




                </table>
            </article>
        </div>
        <!-- /.row -->


        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <!--        <div class="row no-print">
                    <div class="col-xs-12">
                        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                        </button>
                                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                        <i class="fa fa-download"></i> Generate PDF
                                    </button>
                    </div>
                </div>-->

    </div>

</section>
<!-- /.content -->