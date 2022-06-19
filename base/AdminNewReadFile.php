<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>新增讀誦檔案 | 管理後台</title>
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
        <h2><b>新增讀誦檔案</b><h1>
    </div>
    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
                /*資料庫連結*/
                $sql_type = "SELECT * FROM `repeataftermetypes`";
                $result_type = mysqli_query($db_link, $sql_type);

                ?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">

                                            <div class="form-group">
                                                <label for="type">讀誦類別:</label>
                                                <select id="type" name="type"  style="width:525px; height:30px; color:#000000; background-color:transparent">
                                                    <?php
                                                    while ($row_type = $result_type->fetch_assoc()) {
                                                        echo "<option name='type' value=$row_type[t_id]>$row_type[repeatype]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="content">讀誦內容:</label>
                                                <input id="content" name="content" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                            </div>

                                            <div class="form-group">
                                                <label for="link">雲端連結:</label>
                                                <input id="link" name="link" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >
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
                    if ($_POST["content"] == null) {
                        echo "<script>alert('請輸入讀誦描述!');location.href='AdminNewReadFile.php'</script>";
                    }

                    else if ( $_POST["link"] == null) {
                        echo "<script>alert('請輸入雲端連結!');location.href='AdminNewReadFile.php'</script>";
                    }
                    else {
                        $sql_typename = "SELECT * FROM `repeataftermetypes` WHERE t_id = $_POST[type]";
                        $result_typename = mysqli_query($db_link, $sql_typename);
                        $row_typename = $result_typename->fetch_assoc();
                        $typename = $row_typename["repeatype"];

                        $sql = "INSERT INTO `repeatafterme` (r_id, t_id, typename, content, link, memo, vols) VALUES('NULL', '$_POST[type]', '$typename', '$_POST[content]', '$_POST[link]', '$_POST[memo]', '$_POST[vols]')";
                        mysqli_query($db_link, $sql);
                        echo "<script>alert('影音已經上傳!');location.href='AdminReadManage.php'</script>";
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