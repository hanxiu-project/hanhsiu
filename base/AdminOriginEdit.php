<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>緣起管理 | 管理後台</title>

    <?php
include 'head.php';
?>

</head>

<body>
<?php
session_start();
include 'verification.php';
?>

<div id="wrapper">
    <?php include '../base/nav.php';?>
    <?php include '../database.php';?>

        <div class="col-lg-12">
            <h2><b>緣起管理</b><h1>
        </div>

    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
/*資料庫連結*/

$sql = "SELECT * FROM  origin ";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_assoc($result);

?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">



                                            <div class="form-group">
                                                <label for="content">緣起內容:</label>
                                                <textarea id="content" name="content" rows="10" cols="80" ><?php echo $row['content'] ?></textarea>
                                                <script>
                                                    CKEDITOR.replace('content',{
                                                        width:1650,height:700,
                                                    });
                                                </script>
                                            </div>





                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-warning" name="post" value="發佈" >
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                        <?php

$title = $_POST["title"];
$content = $_POST["content"];
$date = $_POST["date"];

if (isset($_POST["post"])) {

    if ($row['origin_id'] == null) {
        $sql = "INSERT INTO  origin (content,date) values ('$content','$date') ";
        mysqli_query($db_link, $sql);
        echo "<script>alert('緣起已經上傳!');location.href='AdminOriginEdit.php'</script>";
    } else {
        $sql = "UPDATE origin SET content = '$content' ";
        mysqli_query($db_link, $sql);
        echo "<script>alert('緣起已經上傳!');location.href='AdminOriginEdit.php'</script>";
    }

}
mysqli_close($db_link);
?>
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
