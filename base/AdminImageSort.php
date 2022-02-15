<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>照片排序 | 管理後台</title>

    <?php
include 'head.php';
?>
    <!-- 後台幻燈片排序 CSS -->
    <link href="style.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
        $(document).ready(function(){
            $('.reorder_link').on('click',function(){
                $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
                $('.reorder_link').html('儲存更動');
                $('.reorder_link').attr("id","saveReorder");
                $('#reorderHelper').slideDown('slow');
                $('.image_link').attr("href","javascript:void(0);");
                $('.image_link').css("cursor","move");

                $("#saveReorder").click(function( e ){
                    if( !$("#saveReorder i").length ){
                        $(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
                        $("ul.reorder-photos-list").sortable('destroy');
                        $("#reorderHelper").html("排序照片中 - 可能需要一段時間. 請不要關閉此網頁.").removeClass('light_box').addClass('notice notice_error');

                        var h = [];
                        $("ul.reorder-photos-list li").each(function() {
                            h.push($(this).attr('id').substr(9));
                        });

                        $.ajax({
                            type: "POST",
                            url: "orderUpdate.php",
                            data: {ids: " " + h + ""},
                            success: function(){
                                window.location.reload();
                            }
                        });
                        return false;
                    }
                    e.preventDefault();
                });
            });
        });
    </script>
</head>

<body>
<?php
session_start();
include 'verification.php';
?>

<?php include 'nav.php';?>
<?php include '../database.php';?>
<div id="wrapper">


    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                <div class="container">
                    <a href="javascript:void(0);" class="reorder_link" id="saveReorder">排序照片</a>
                    <div id="reorderHelper" class="light_box" style="display:none;">1. 拉動照片來排序.<br>2. 當完成時點擊 '儲存更動' .</div>
                    <div class="gallery">
                        <ul class="reorder_ul reorder-photos-list">
                            <?php
// Include and create instance of DB class
require_once 'DB.class.php';
$db = new DB();

// Fetch all images from database
$images = $db->getRows();
if (!empty($images)) {
    foreach ($images as $row) {
        ?>
                                    <li id="image_li_<?php echo $row['id']; ?>" class="ui-sortable-handle">
                                        <a href="javascript:void(0);" style="float:none;" class="image_link">
                                            <?php echo $row['listorder']; ?>
                                            <img src="images/<?php echo $row['imgname']; ?>"  width="400px" height="300px" alt="">
                                        </a>
                                    </li>
                                <?php }}?>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->


        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>


        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
</body>

</html>