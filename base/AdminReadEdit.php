<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time(); ?>"></script>

    <title>讀誦編輯 | 管理後台</title>
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
        <!--sidebar-->
        <!-- Navigation -->
        <?php include 'nav.php'; ?>
        <?php include '../database.php'; ?>
        <!--Body-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                    <?php
                    $sql = "SELECT * FROM repeatafterme where r_id = $_SESSION[edit_r_id]";
                    $result = mysqli_query($db_link, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div id="con2">
                        <div class="main">
                            <div class="newstitle">
                                <div class="contentlist">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form name="forms" method="POST" action="">
                                                <div class="form-group">
                                                    <label for="type">大類別名稱:</label>
                                                    <input id="type" name="type" type="text" disabled="disabled" value="<?php echo $row['typename'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>

                                                <div class="form-group">
                                                    <label for="type">小類別名稱:</label>
                                                    <input id="type" name="type" type="text" disabled="disabled" value="<?php echo $row['s_typename'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>


                                                <div class="form-group">
                                                    <label for="content">內容:</label>
                                                    <input id="content" name="content" type="text" value="<?php echo $row['content'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>

                                                <div class="form-group">
                                                    <label for="link">雲端連結:</label>
                                                    <input id="link" name="link" type="text" value="<?php echo $row['link'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>

                                                <div class="form-group">
                                                    <label for="memo">備註:</label>
                                                    <input id="memo" name="memo" type="text" value="<?php echo $row['memo'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>

                                                <div class="form-group">
                                                    <label for="vols">集數:</label>
                                                    <input id="vols" name="vols" type="text" value="<?php echo $row['vols'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-warning" name="edit" value="修改">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST["edit"])) {
                        if ($_POST["content"] == null) {
                            echo "<script>alert('請輸入讀誦內容!');location.href='AdminReadEdit.php'</script>";
                        } elseif ($_POST["link"] == null) {
                            echo "<script>alert('請輸入雲端連結!');location.href='AdminReadEdit.php'</script>";
                        } else {
                            $testwatchnetpos = strpos($_POST["link"], "watch"); //找網址內有watch?v=的位置(算w的位置在24)
                            $testnet = substr($_POST["link"], "$testwatchnetpos" + 8); //取的watch?v=之後的網址字串(因為watch?v=所以+8)
                            $linkcheck = strpos($testnet, "&");

                            if ($linkcheck !== false) {
                                $testnet = substr($testnet, 0, $linkcheck);
                            }

                            $sqledit = "UPDATE repeatafterme SET `content` = '$_POST[content]', `link` = '$testnet', `memo` = '$_POST[memo]', `vols` = '$_POST[vols]'  WHERE repeatafterme.r_id = $_SESSION[edit_r_id] ";
                            mysqli_query($db_link, $sqledit);
                            echo "<script>alert('讀誦修改完成!');location.href='AdminReadManage.php'</script>";
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