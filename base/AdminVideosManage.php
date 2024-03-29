<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>影音總覽 | 管理後台</title>

    <?php
    include 'head.php';
    ?>

</head>

<body>
    <?php
    session_start();
    include 'verification.php';
    ?>
    <form name="forms" method="get" action="">
        <div id="wrapper">
            <?php include 'nav.php'; ?>
            <?php include '../database.php'; ?>
            <?php
            $sqltype = "SELECT * FROM `video_bigtypes` ORDER BY listorder";
            $resulttype = mysqli_query($db_link, $sqltype);
            //        $sql_s_type = "SELECT * FROM `video_smalltypes` ";
            //        $result_s_type = mysqli_query($db_link, $sql_s_type);
            ?>

            <!--建立新公告-->
            <div class="row" style="margin-bottom: 20px; text-align: left">
                <div class="col-lg-12">
                    <a href="AdminNewVideos.php" class="btn btn-success  ">建立新影音類別</a>
                    <a href="AdminNewVideoFile.php" class="btn btn-success  ">建立新影音檔案</a>

                    <select id="type" name="type" style="width:525px; height:30px; color:#000000; background-color:white">
                        <option>請選擇類別</option>
                        <option value="all">全選</option>
                        <?php
                        while ($rowtype = $resulttype->fetch_assoc()) {
                            echo "<option name=typeid value=$rowtype[vbt_id]>$rowtype[b_typename]</option>";
                        }
                        ?>
                    </select>
                    <!--                <select id="s_type" name="s_type" style="width:525px; height:30px; color:#000000; background-color:white">-->
                    <!--                    <option>請選擇類別</option>-->
                    <!--                    <option value="all">全選</option>-->
                    <!--                    --><?php
                                                //                    while ($row_s_type = $result_s_type->fetch_assoc()) {
                                                //                        echo "<option name=s_typeid value=$row_s_type[s_typename]>$row_s_type[s_typename]</option>";
                                                //                    }
                                                //                    
                                                ?>
                    <!--                </select>-->
                    <input type="submit" class="btn btn-sm btn-warning" name="gotype" value="查看影音類別">
                </div>
            </div>
    </form>

    <div class="col-lg-12">
        <h2><b>影音總覽</b>
            <h1>
    </div>
    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
                /*資料庫連結*/

                $sql = "SELECT v.*, s.s_typename, b.b_typename FROM videos v left join video_smalltypes s on v.vst_id  = s.vst_id left join video_bigtypes b on v.vbt_id = b.vbt_id order by v.vbt_id";
                $result = mysqli_query($db_link, $sql);
                $resultfortd = mysqli_query($db_link, $sql);
                $rowfortd = $resultfortd->fetch_assoc();
                echo "<form name='form1' method='POST' action=''>";
                echo "<table border=1 width=100% style=font-size:24px;line-height:50px; >";
                echo "<tr align=center>";
                echo "<td>大類別</td>";
                echo "<td>小類別</td>";
                echo "<td>內容</td>";
                echo "<td>影片網址</td>";
                echo "<td>備註</td>";
                echo "<td>集數</td>";
                if ($rowfortd["v_id"] != null) {
                    echo "<td></td>";
                    echo "<td></td>";
                }
                echo "</tr>";

                if (!($_GET["type"]) || $_GET["type"] == "all") {
                    $sqlvideo = "SELECT v.*, s.s_typename, b.b_typename FROM videos v left join video_smalltypes s on v.vst_id  = s.vst_id left join video_bigtypes b on v.vbt_id = b.vbt_id order by v.vbt_id";
                    $resultv = mysqli_query($db_link, $sqlvideo);

                    $date_nums = mysqli_num_rows($resultv); //講記數量
                    $per = 10; //10筆換頁
                    $pages = ceil($date_nums / $per); //共幾頁
                    if (!isset($_GET["page"])) {
                        $page = 1;
                    } else {
                        $page = intval($_GET["page"]); //確認頁數只能是數值資料
                    }

                    $start = ($page - 1) * $per;
                    $sqlresult = "SELECT v.*, s.s_typename, b.b_typename FROM videos v left join video_smalltypes s on v.vst_id  = s.vst_id left join video_bigtypes b on v.vbt_id = b.vbt_id order by v.vbt_id Limit $start , $per";
                    $videoresult[$start] = mysqli_query($db_link, $sqlresult);
                    $videoresult[$page] = mysqli_query($db_link, $sqlresult);
                    while ($row = mysqli_fetch_assoc($videoresult[$start])) {
                        echo "<tr align=center>";
                        echo "<td>$row[b_typename]</td>";
                        echo "<td>$row[s_typename]</td>";
                        echo "<td>$row[content]</td>";
                        echo "<td>$row[video_link]</td>";
                        echo "<td>$row[memo]</td>";
                        echo "<td>$row[vols]</td>";
                        echo "<td><input type='submit' class='btn btn-sm btn-primary' style='width:100px;height:30px;' name='$row[v_id]+1' value='編輯'></td>";
                ?>
                        <td><input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;' name="<?php echo "$row[v_id]+2"; ?>" value='刪除' onclick="return confirm('是否確認刪除這部影片?')"></td>
                    <?php
                        echo "</tr>";
                    }
                    echo "</form>";
                    echo "</table>";
                    echo "<center>";
                    echo '共 ' . $date_nums . ' 筆-在 ' . $page . ' 頁-共 ' . $pages . ' 頁';
                    echo "<br/><a href=?page=1>首頁</a> ";
                    echo "第 ";
                    for ($i = 1; $i <= $pages; $i++) {
                        if ($page - 10 < $i && $i < $page + 10) {
                            echo "<a href=?page=$i>" . $i . "</a> ";
                        }
                    }
                    echo " 頁 <a href=?page=$pages>末頁</a>";
                    echo "</center>";
                } elseif (isset($_GET["type"])) {
                    $sqltype = "SELECT v.*, s.s_typename, b.b_typename FROM videos v left join video_smalltypes s on v.vst_id = s.vst_id left join video_bigtypes b on v.vbt_id = b.vbt_id where v.vbt_id = '$_GET[type]'";
                    $resulttype = mysqli_query($db_link, $sqltype);
                    $date_nums = mysqli_num_rows($resulttype); //講記數量
                    $per = 10; //10筆換頁
                    $pages = ceil($date_nums / $per); //共幾頁
                    if (!isset($_GET["page"])) {
                        $page = 1;
                    } else {
                        $page = intval($_GET["page"]); //確認頁數只能是數值資料
                    }

                    $start = ($page - 1) * $per;
                    $sqlresultvdo = "SELECT v.*, s.s_typename, b.b_typename FROM videos v left join video_smalltypes s on v.vst_id = s.vst_id left join video_bigtypes b on v.vbt_id = b.vbt_id where v.vbt_id = '$_GET[type]' Limit $start , $per";
                    $vdoresult['src'] = mysqli_query($db_link, $sqlresultvdo);
                    while ($row = mysqli_fetch_assoc($vdoresult['src'])) {
                        echo "<tr align=center>";
                        echo "<td>$row[b_typename]</td>";
                        echo "<td>$row[s_typename]</td>";
                        echo "<td>$row[content]</td>";
                        echo "<td>$row[video_link]</td>";
                        echo "<td>$row[memo]</td>";
                        echo "<td>$row[vols]</td>";
                        echo "<td><input type='submit' class='btn btn-sm btn-primary' style='width:100px;height:30px;' name='$row[v_id]+1' value='編輯'></td>";
                    ?>
                        <td><input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;' name="<?php echo "$row[v_id]+2"; ?>" value='刪除' onclick="return confirm('是否確認刪除這部影片?')"></td>
                <?php
                        echo "</tr>";
                    }
                    echo "</form>";
                    echo "</table>";
                    echo "<center>";
                    echo '共 ' . $date_nums . ' 筆-在 ' . $page . ' 頁-共 ' . $pages . ' 頁';
                    echo "<br/><a href=?type=$_GET[type]&page=1>首頁</a> ";
                    echo "第 ";
                    for ($i = 1; $i <= $pages; $i++) {
                        if ($page - 10 < $i && $i < $page + 10) {
                            echo "<a href=?type=$_GET[type]&page=$i>" . $i . "</a> ";
                        }
                    }
                    echo " 頁 <a href=?type=$_GET[type]&page=$pages>末頁</a>";
                    echo "</center>";
                }
                $sql2 = "SELECT * FROM videos";
                $result2 = mysqli_query($db_link, $sql2);
                while ($row2 = $result2->fetch_assoc()) {
                    if (isset($_POST["$row2[v_id]+1"])) {
                        $_SESSION["edit_v_id"] = $row2["v_id"];
                        echo "<script langauge = 'javascript' type='text/javascript'>";
                        echo "window.location.href = 'AdminVideoEdit.php'";
                        echo "</script>";
                    }
                    if (isset($_POST["$row2[v_id]+2"])) {
                        $_SESSION["delete_v_id"] = $row2["v_id"];
                        $sql_delete = "DELETE FROM videos WHERE videos.v_id = $_SESSION[delete_v_id]";
                        mysqli_query($db_link, $sql_delete);
                        echo "<script>alert('成功刪除!');location.href='AdminVideosManage.php'</script>";
                    }
                }
                mysqli_close($db_link);
                ?>

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