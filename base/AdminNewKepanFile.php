<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>新增科判檔案 | 管理後台</title>
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
        <?php include 'nav.php';?>
        <?php include '../database.php';?>

        <div class="col-lg-12">
            <h2><b>新增科判檔案</b><h1>
        </div>
        <!--Body-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                    <?php
/*資料庫連結*/

$sqltype = "SELECT * FROM `kp_types` ";
$resulttype = mysqli_query($db_link, $sqltype);

?>


                    <div id="con2">
                        <div class="main">
                            <div class="newstitle" >

                                <div class="contentlist">

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <form method="post" enctype="multipart/form-data" action="">

                                                <div class="form-group">
                                                    <label for="type">科判:</label>
                                                    <select id="type" name="type"  style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                        <?php while ($row = $resulttype->fetch_assoc()) {
    echo "<option name='type' value=$row[kpt_id]>$row[kptypename]</option>";

}
$sqltypeinput = "SELECT * FROM `kp_types` where `kpt_id`='$_POST[type]'";
$resulttypeinput = mysqli_query($db_link, $sqltypeinput);
$rowinput = mysqli_fetch_assoc($resulttypeinput);
$_SESSION['inputtype'] = $rowinput['kptypename'];
?>

                                                    </select>
                                                </div>


                                                <div class="form-group">
                                                    <label for="file">檔案上傳:</label>
                                                    <input type="file" name="my_file">
                                                </div>


                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-warning"  value="發佈" >
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

$getDate = date("Y-m-d");
$kptype = $_SESSION['inputtype'];
$filename = $_FILES['my_file']['name'];

# 檢查檔案是否上傳成功
if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK) {
    /*echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
    echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
    echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
    echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';*/

    # 檢查檔案是否已經存在
    if (file_exists("../kepan/" . $kptype . "/" . $filename)) {
        echo "<script>alert('檔案已存在！');</script>";
    } else {
        $file = $_FILES['my_file']['tmp_name'];
        $dest = "../kepan/" . $kptype . "/" . $filename;

        # 將檔案移至指定位置
        move_uploaded_file($file, $dest);
        //存入資料庫

        $sql = "INSERT INTO kepans (kpt_id,kptypename,filename,date) VALUES ('$_POST[type]','$rowinput[kptypename]','$filename','$getDate')";
        mysqli_query($db_link, $sql);
        echo "<script>alert('檔案已經上傳!');location.href='AdminKepanManage.php'</script>";
    }
}
?>

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
