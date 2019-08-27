<?php
$this->load->view('layout/header');
$this->load->view('layout/topmenu');
?>
<!-- ================== BEGIN PAGE CSS STYLE ================== -->
<link href="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>

<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<!-- begin #content -->
<!-- begin #content -->
<div id="content" class="content content-full-width">
    <!-- begin vertical-box -->
    <div class="vertical-box">
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column width-200" style="background: #fff">

            <!-- begin wrapper -->
            <div class="wrapper" >


                <p><b>Categories</b></p>
                <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                    <?php
                    foreach ($categories as $key => $value) {
                        ?>
                        <li><a href="javascript:;" onclick="changeCategory('<?php echo $value['category_name']; ?>', '<?php echo $value['id']; ?>')"><i class="fa fa-fw m-r-5 fa-circle text-inverse" ></i> <?php echo $value['category_name']; ?></a></li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
            <!-- end wrapper -->
        </div>
        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">

            <!-- begin wrapper -->
            <div class="wrapper">
                <div class="p-30 bg-white">
                    <!-- begin email form -->
                    <div class="panel panel-inverse" data-sortable-id="index-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">  Add New Image</h4>
                        </div>
                        <div class="panel-body">
                            <?php if ($categories) { ?>
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <!-- begin email to -->
                                    <label class="control-label" style='font-size: 15px;'>Category: <span id="category_name"><?php echo $categories[0]['category_name']; ?></span></label>
                                    <div class="m-b-15">
                                        <input type="hidden" class="form-control" name="category_id" id='category_id' required="" value="<?php echo $categories[0]['id']; ?>" />
                                    </div>


                                    <label class="control-label">Add Image:</label>
                                    <div class="m-b-15">
                                        <div class="btn-group" role="group" aria-label="..." style="    width: 100%;">
                                            <span class="btn btn-success col fileinput-button" ">
                                                <i class="fa fa-plus"></i>
                                                <span>Add files...</span>
                                                <input type="file" name="picture" required="">
                                            </span>

                                        </div>
                                    </div>
                                    <!-- end email to -->
                                    <!-- begin email subject -->

                                    <input type="hidden" class="form-control" name="title" required="" />

                                    <!-- end email subject -->
                                    <!-- begin email content -->
                                    <label class="control-label">Content:</label>
                                    <div class="m-b-15">
                                        <input type="text"  class=" form-control" id="wysihtml5" placeholder="Enter text ..." rows="8" name="description" required="">
                                    </div>

                                    <!--tags-->
                                    <!--                        <div class="m-b-15">
                                                                <label class="control-label">Tags</label>
                                                                <input id="tags" name="tags[]" class="inverse">
                                                            </div>-->

                                    <!-- end email content -->
                                    <button type="submit" name="submit_data" class="btn btn-primary p-l-40 p-r-40">Send</button>
                                </form>
                                <?php
                            } else {
                                echo "<h2>No Category Found<br/><small>Add Category Atleat One Category.</a></h2>";
                                echo "<a href=" . site_url("CMS/gallaryCategories") . " class='btn btn-default btn-sm'>Add Category</a>";
                            }
                            ?>
                        </div>
                    </div>
                    <!-- end email form -->
                </div>
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
    function changeCategory(cat_name, cat_id) {
        $("#category_name").text(cat_name);
        $("#category_id").val(cat_id);
    }

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