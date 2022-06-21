<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>新增影音檔案 | 管理後台</title>
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
            <h2><b>新增影音網址</b><h1>
        </div>
    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
                    /*資料庫連結*/
                    $sql_b_type = "SELECT * FROM `video_bigtypes`";
                    $result_b_type = mysqli_query($db_link, $sql_b_type);

                    $sql_s_type = "SELECT * FROM `video_smalltypes`";
                    $result_s_type = mysqli_query($db_link, $sql_s_type);
                ?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">

                                            <div class="form-group">
                                                <label for="b_type">影音大類別:</label>
                                                <select id="b_type" name="b_type"  style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                    <?php
                                                        while ($row_b_type = $result_b_type->fetch_assoc()) {
                                                            echo "<option name='type' value=$row_b_type[vbt_id]>$row_b_type[b_typename]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="s_type">影音小類別:</label>
                                                <select id="s_type" name="s_type"  style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                    <option name="type" value="none">請選擇類別</option>
                                                    <?php
                                                        while ($row_s_type = $result_s_type->fetch_assoc()) {
                                                            echo "<option name='type' value=$row_s_type[vst_id]>$row_s_type[s_typename]</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="content">影片內容:</label>
                                                <input id="content" name="content" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                            </div>

                                            <div class="form-group">
                                                <label for="video_link">影片網址:</label>
                                                <input id="video_link" name="video_link" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                            </div>

                                            <div class="form-group">
                                                <label for="memo">備註:</label>
                                                <input id="memo" name="memo" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                            </div>

                                            <div class="form-group">
                                                <label for="vols">集數:</label>
                                                <input id="vols" name="vols" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-warning" name="vpost" value="發佈" >
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    if (isset($_POST["vpost"])) {
                        $testwatchnetpos = strpos($_POST["video_link"], "watch"); //找網址內有watch?v=的位置(算w的位置在24)
                        $testnet = substr($_POST["video_link"], "$testwatchnetpos"+8); //取的watch?v=之後的網址字串(因為watch?v=所以+8)
                        //$renewnet = substr_replace($_POST["video_link"], "embed/$testnet", $testwatchnetpos); //新網址

                        if ($_POST["content"] == null && $_POST["video_link"] == null) {
                            echo "<script>alert('請輸入影片網址或影片描述!');location.href='AdminNewVideoFile.php'</script>";
                        }
                        else {
                            if ($_POST['s_type'] == 'none') {
                                $sql = "INSERT INTO `videos` (v_id, vbt_id, content, video_link, memo, vols) VALUES('NULL', '$_POST[b_type]', '$_POST[content]', '$testnet', '$_POST[memo]', '$_POST[vols]')";
                                mysqli_query($db_link, $sql);
                                echo "<script>alert('影音已經上傳!');location.href='AdminVideosManage.php'</script>";
                            }
                            else {
                                $sql = "INSERT INTO `videos` (v_id, vbt_id, vst_id, content, video_link, memo, vols) VALUES('NULL', '$_POST[b_type]', '$_POST[s_type]', '$_POST[content]', '$testnet', '$_POST[memo]', '$_POST[vols]')";
                                mysqli_query($db_link, $sql);
                                echo "<script>alert('影音已經上傳!');location.href='AdminVideosManage.php'</script>";
                            }
                        }
                    }
                    mysqli_close($db_link);
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