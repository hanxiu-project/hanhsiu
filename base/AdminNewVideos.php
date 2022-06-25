<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增法音類別 | 管理後台</title>
    <?php
        include 'head.php';
    ?>
</head>

<body>
<?php
session_start();
include 'verification.php';
?>
<form name="forms" method="post" action="">
    <div id="wrapper">
        <?php include 'nav.php';?>
        <?php include '../database.php';?>

        <!--建立新影音類別-->
        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <label for="b_type" style="color:#ffffff" ><b >影音大類別:</b></label>
                <input id="b_type" name="b_type" type="text" style="width:300px; height:30px; color:#000000; ">
                <input type="submit" class="btn btn-sm btn-warning" name="go" value="新增">
            </div>
        </div>

        <?php
            $sql_btype = "SELECT * FROM `video_bigtypes` ";
            $result_btype = mysqli_query($db_link, $sql_btype);
        ?>

        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <label for="s_type" style="color:#ffffff" ><b >影音小類別:</b></label>
                <input id="s_type" name="s_type" type="text" style="width:300px; height:30px; color:#000000; ">
                <select id="select_s_type" name="select_s_type" style="width:525px; height:30px; color:#000000; background-color:white">
                    <option value=0>請選擇類別</option>
                    <?php
                        while ($row_btype = $result_btype->fetch_assoc()) {
                            echo "<option name=typeid value=$row_btype[vbt_id]>$row_btype[b_typename]</option>";
                        }
                    ?>
                </select>
                <input type="submit" class="btn btn-sm btn-warning" name="s_go" value="新增">
            </div>
        </div>

        <div class="col-lg-12">
            <h2><b>新增影音類別</b><h2>
            <h4><b>大類別</b><h4>
        </div>
        <!--Body-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                    <?php
                        mysqli_query($db_link, 'SET CHARACTER SET UTF-8');

                        $sql = "SELECT * FROM video_bigtypes ";
                        $result = mysqli_query($db_link, $sql);
                        $sql_big_listorder = "SELECT MAX(listorder) as max FROM  `video_bigtypes` ";
                        $list_big_result = mysqli_query($db_link, $sql_big_listorder);
                        $list_big_check = mysqli_fetch_assoc($list_big_result);
                        $max_big_listorder = $list_big_check['max'];

                        $sql_small_listorder = "SELECT MAX(listorder) as max FROM  `video_smalltypes` ";
                        $list_small_result = mysqli_query($db_link, $sql_small_listorder);
                        $list_small_check = mysqli_fetch_assoc($list_small_result);
                        $max_small_listorder = $list_small_check['max'];

                        echo "<form name='form1' method='POST' action=''>";
                        echo "<table  border rules=rows cellspacing=0 width=100% style=font-size:20px;line-height:50px;>";
                        echo "<tr align=center>";
                        echo "<td><b>大類別名稱</b></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr align=center>";
                            echo "<td>$row[b_typename]</td>";
                            echo "<td>";
                    ?>
                        <input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                               name="<?php echo "$row[vbt_id]+2"; ?>" value='刪除'
                               onclick="return confirm('是否確認刪除此類別?')"></td>
                    <?php
                        echo "</tr>";
                        }
                        echo "</table>";


                        $sql2 = "SELECT * FROM video_bigtypes ";
                        $result2 = mysqli_query($db_link, $sql2);
                        while ($row2 = $result2->fetch_assoc()) {
                            if (isset($_POST["$row2[vbt_id]+2"])) {
                                $sql_vbt_id = "SELECT * FROM `videos` WHERE `videos`.`vbt_id` = '$row2[vbt_id]'";    //確認該大類別底下是否有影音資料
                                $result_vbt_id = mysqli_query($db_link, $sql_vbt_id);

                                $sql_check_if_smalltypes_have_data = "SELECT * FROM `video_smalltypes` WHERE `video_smalltypes`.`vbt_id` = '$row2[vbt_id]'";  //確認該大類別底下是否有小類別
                                $result_check_if_smalltypes_have_data = mysqli_query($db_link, $sql_check_if_smalltypes_have_data); 

                                if (mysqli_num_rows($result_check_if_smalltypes_have_data) == 0) {
                                    if (mysqli_num_rows($result_vbt_id) == 0) {
                                        $_SESSION["delete_vbt_id"] = $row2["vbt_id"];
                                        $sql_vbt_delete = "DELETE FROM video_bigtypes WHERE video_bigtypes.vbt_id = $_SESSION[delete_vbt_id]";
                                        mysqli_query($db_link, $sql_vbt_delete);
                                        echo "<script>alert('成功刪除影音大類別2!');location.href='AdminNewVideos.php'</script>";
                                    } else {
                                        echo "<script>alert('影音大類別內含有影音連結，無法刪除!');location.href='AdminNewVideos.php'</script>";
                                    }
                                } else {
                                    echo "<script>alert('影音大類別內含有小類別，無法刪除!');location.href='AdminNewVideos.php'</script>";
                                }
                            }
                        }

                        if (isset($_POST["go"])) {
                            if ($_POST["b_type"] == null) {
                                echo "<script>alert('請輸入欲新增的影音大類別!');location.href='AdminNewVideos.php'</script>";
                            }
                            else {
                                $sqltype = "INSERT INTO video_bigtypes (b_typename, listorder) VALUES ('$_POST[b_type]', '$max_big_listorder'+1)";
                                mysqli_query($db_link, $sqltype);
                                echo "<script>alert('影音大類別建立成功!');location.href='AdminNewVideos.php'</script>";
                            }
                        }
                    ?>



                    <h4><b>小類別</b></h4>
                    <?php
                        $sql_s = "SELECT s.*, b.b_typename FROM video_smalltypes s left join video_bigtypes b on s.vbt_id = b.vbt_id";
                        $result_s = mysqli_query($db_link, $sql_s);

                        echo "<form name='form1' method='POST' action=''>";
                        echo "<table  border rules=rows cellspacing=0 width=100% style=font-size:20px;line-height:50px;>";
                        echo "<tr align=center>";
                        echo "<td><b>小類別名稱</b></td>";
                        echo "<td><b>大類別名稱</b></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        while ($row_s = $result_s->fetch_assoc()) {
                            echo "<tr align=center>";
                            echo "<td>$row_s[s_typename]</td>";
                            echo "<td>$row_s[b_typename]</td>";
                            echo "<td>";
                    ?>
                        <input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                               name="<?php echo "$row_s[vst_id]+3"; ?>" value='刪除'
                               onclick="return confirm('是否確認刪除此類別?')"></td>
                    <?php
                        echo "</tr>";
                        }
                        echo "</table>";



                        $sql3 = "SELECT * FROM video_smalltypes ";
                        $result3 = mysqli_query($db_link, $sql3);
                        while ($row3 = $result3->fetch_assoc()) {
                            if (isset($_POST["$row3[vst_id]+3"])) {
                                $sql_vst_id = "SELECT * FROM `videos` WHERE `videos`.`vst_id` = '$row3[vst_id]'";
                                $result_vst_id = mysqli_query($db_link, $sql_vst_id);
                                if (mysqli_num_rows($result_vst_id) == 0) {
                                    $_SESSION["delete_vst_id"] = $row3["vst_id"];
                                    $sql_vst_delete = "DELETE FROM video_smalltypes WHERE video_smalltypes.vst_id = $_SESSION[delete_vst_id]";
                                    mysqli_query($db_link, $sql_vst_delete);
                                    echo "<script>alert('成功刪除影音小類別!');location.href='AdminNewVideos.php'</script>";
                                }
                                else {
                                    echo "<script>alert('影音小類別內含有影音連結無法刪除!');location.href='AdminNewVideos.php'</script>";
                                }
                            }
                        }
                        $sql4 = "SELECT * FROM video_smalltypes where s_typename ='$_POST[s_type]'";
                        $result4 = mysqli_query($db_link, $sql4);
                        $row4 = mysqli_num_rows($result4);
                        
                        if (isset($_POST["s_go"])) {
                            if ($_POST["s_type"] == null) {
                                echo "<script>alert('請輸入欲新增的影音小類別!');location.href='AdminNewVideos.php'</script>";
                            }else if ($_POST["select_s_type"] == 0)
                            {
                                echo "<script>alert('請選擇欲新增的影音小類別之所屬大類別!');location.href='AdminNewVideos.php'</script>";
                            }
                            else if ($row4 != 0)
                            {
                                echo "<script>alert('該小類別已存在!');location.href='AdminNewVideos.php'</script>";
                            }
                            else {
                                $sql_stype = "INSERT INTO video_smalltypes (vbt_id, s_typename, listorder) VALUES ('$_POST[select_s_type]', '$_POST[s_type]', '$max_small_listorder'+1)";
                                mysqli_query($db_link, $sql_stype);
                                echo "<script>alert('影音小類別建立成功!');location.href='AdminNewVideos.php'</script>";
                            }
                        }
                    ?>

                    <?php
                        mysqli_close($db_link);
                    ?>
                </div>
                <!-- /#page-wrapper -->
            </div>
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
</form>
</body>

</html>
