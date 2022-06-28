<?php include_once 'database.php'; ?>
<?php $title = '瑜論講記'; ?>
<?php include_once 'include/head.php'; ?>
<?php include_once 'include/nav-bar.php'; ?>

<body>
<main>
    <div class="hero stop-banner">
        <svg class="cloud cleft">
            <use xlink:href="img/cloud_left.svg#cloud-left"></use>
        </svg>
        <svg class="cloud cright">
            <use xlink:href="img/cloud_right.svg#cloud-right"></use>
        </svg>
    </div>

    <section>
        <div class="container main-wrap">
            <div class="main-wrap__left">
                <div data-boxname="head" class="heading-style__1 mx-auto mb-5">
                    法音流佈
                    <div class="tit-en">videos</div>
                </div>

                    <div class="close-wrap site1">
                        <button type="button" class="btn-style__arrow">
                            <i class="arrow"></i>
                        </button>
                        <div>
                            <label class="col-form-label">瑜論筆錄讀誦</label>
                            <div class="read-mode__ctrl">
                                <select class="form-select" id="type_select" onchange="changeType(this.value)">
                                    <?php
                                    $sql_select = "SELECT * FROM `repeatafterme_bigtypes` order by t_id";
                                    $result_select = mysqli_query($db_link, $sql_select);

                                    while ($row_select = mysqli_fetch_assoc($result_select)) {
                                        echo "<option value='$row_select[t_id]'>$row_select[repeatype]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="main-wrap__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="videotypes.php">法音流佈</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">瑜論筆錄讀誦</li>
                    </ol>
                </nav>

                <?php
                    if (isset($_GET["tid"])) {
                        $sql_type = "Select * From `repeatafterme` where `t_id`= $_GET[tid]";
                        $result_type = mysqli_query($db_link, $sql_type);
                        $r_type = mysqli_fetch_assoc($result_type);
                        $data = mysqli_num_rows($result_type);
                ?>

                <h4 class="heading-style__2 mb-4" name="type_id" id=<?php echo "$_GET[tid]" ?>><?php echo "$r_type[typename]" ?></h4>
                <table class="table table-style__1 mb-4">
                    <thead>
                    <tr>
                        <th scope="col">內容</th>
                        <th scope="col">備註</th>
                        <th scope="col">集數</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($data == 0) {
                            echo "<script>alert('目前尚無資料!');location.href='videotypes.php'</script>";
                        }
                        else {
                            $per = 10;
                            $pages = ceil($data / $per);     //pages
                            $k = $pages;
                            if (!isset($_GET["page"])) {
                                $page = 1;
                            } else {
                                $page = intval($_GET["page"]);
                            }
                            $start = ($page - 1) * $per;
                            $sqlatcnum10 = "SELECT * FROM `repeatafterme` where `t_id` = $_GET[tid]  Limit $start  , $per";
                            $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);
                            $resultnum10[$page] = mysqli_query($db_link, $sqlatcnum10);
                            while ($read = mysqli_fetch_assoc($resultnum10[$start])) {
                                echo "<tr>
                                <td scope='row'>
                                    <a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video='$read[link]'>$read[content]</a>
                                </td>
                                <td>$read[memo]</td>
                                <td>共 $read[vols] 集</td>
                              </tr>
                            ";
                            }
                        }
                    ?>
                    </tbody>
                </table>
                <div id="videoTable"></div>
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <?php
                                    $prepage = intval($page) - 1;
                                    if ($page == 1) {
                                        echo "<a class='page-link ' href=?tid=$_GET[tid]&page=1 aria-label='Previous'>";
                                        echo "<i class='arrow aleft'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?tid=$_GET[tid]&page=$prepage aria-label='Previous'>";
                                        echo "<i class='arrow aleft'></i>";
                                        echo "</a>";
                                    }
                                    ?>
                                </li>
                                <?php
                                for ($i = 1; $i <= $pages; $i++) {
                                    if ($page - $k < $i && $i < $page + $k) {
                                        if ($i == $page) {
                                            echo "<li class='page-item active' id=page$i>";
                                            echo "<a class='page-link' href=?tid=$_GET[tid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        } else {
                                            echo "<li class='page-item' id=page$i>";
                                            echo "<a class='page-link' href=?tid=$_GET[tid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        }
                                    }
                                }
                                ?>
                                <li class="page-item">
                                    <?php
                                    $nextpage = intval($page) + 1;

                                    if ($page == $pages) {
                                        echo "<a class='page-link' href=?tid=$_GET[tid]&page=$pages aria-label='Previous'>";
                                        echo "<i class='arrow aright'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?tid=$_GET[tid]&page=$nextpage aria-label='Previous'>";
                                        echo "<i class='arrow aright'></i>";
                                        echo "</a>";
                                    }
                                    ?>
                                </li>
                            </ul>
                        </nav>
                <?php
                    }
                ?>

<!--                =============================================================================================================================================================-->

                <?php
                if (isset($_GET["stid"])) {
                    $sql_type = "Select * From `repeatafterme` where `st_id`= $_GET[stid]";
                    $result_type = mysqli_query($db_link, $sql_type);
                    $r_type = mysqli_fetch_assoc($result_type);
                    $data = mysqli_num_rows($result_type);
                    ?>

                    <h4 class="heading-style__2 mb-4" name="type_id" id=<?php echo "$_GET[stid]" ?>><?php echo "$r_type[s_typename]" ?></h4>
                    <table class="table table-style__1 mb-4">
                        <thead>
                        <tr>
                            <th scope="col">內容</th>
                            <th scope="col">備註</th>
                            <th scope="col">集數</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($data == 0) {
                            echo "<script>alert('目前尚無資料!');location.href='videotypes.php'</script>";
                        }
                        else {
                            $per = 10;
                            $pages = ceil($data / $per);     //pages
                            $k = $pages;
                            if (!isset($_GET["page"])) {
                                $page = 1;
                            } else {
                                $page = intval($_GET["page"]);
                            }
                            $start = ($page - 1) * $per;
                            $sqlatcnum10 = "SELECT * FROM `repeatafterme` where `st_id` = $_GET[stid]  Limit $start  , $per";
                            $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);
                            $resultnum10[$page] = mysqli_query($db_link, $sqlatcnum10);
                            while ($read = mysqli_fetch_assoc($resultnum10[$start])) {
                                echo "<tr>
                                <td scope='row'>
                                    <a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video='$read[link]'>$read[content]</a>
                                </td>
                                <td>$read[memo]</td>
                                <td>共 $read[vols] 集</td>
                              </tr>
                            ";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <div id="videoTable"></div>
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php
                                $prepage = intval($page) - 1;
                                if ($page == 1) {
                                    echo "<a class='page-link ' href=?stid=$_GET[stid]&page=1 aria-label='Previous'>";
                                    echo "<i class='arrow aleft'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?stid=$_GET[stid]&page=$prepage aria-label='Previous'>";
                                    echo "<i class='arrow aleft'></i>";
                                    echo "</a>";
                                }
                                ?>
                            </li>
                            <?php
                            for ($i = 1; $i <= $pages; $i++) {
                                if ($page - $k < $i && $i < $page + $k) {
                                    if ($i == $page) {
                                        echo "<li class='page-item active' id=page$i>";
                                        echo "<a class='page-link' href=?stid=$_GET[stid]&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    } else {
                                        echo "<li class='page-item' id=page$i>";
                                        echo "<a class='page-link' href=?stid=$_GET[stid]&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    }
                                }
                            }
                            ?>
                            <li class="page-item">
                                <?php
                                $nextpage = intval($page) + 1;

                                if ($page == $pages) {
                                    echo "<a class='page-link' href=?stid=$_GET[stid]&page=$pages aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?stid=$_GET[stid]&page=$nextpage aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                }
                                ?>
                            </li>
                        </ul>
                    </nav>
                    <?php
                }
                ?>
                <div class="text-center my-5">
                    <a class="btn-style__1" href="videotypes.php">回上一頁</a>
                </div>
            </div>
        </div>
    </section>

    <div class="wave-block in-buttom"></div>
</main>

<footer w3-include-html="include/_footer.php"></footer>

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-style__1">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="videoModalLabel"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="videobox">
                    <iframe src="" frameborder="0" allowfullscreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT W3 -->
<script>
    w3.includeHTML();
</script>

<!-- JAVASCRIPT -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/main.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script type="text/javascript">
    function opData() {
        var currentlyTId = document.getElementsByName('type_id')[0].id;
        var optionLength = document.getElementById("type_select").options.length;

        for (var i = 0; i < optionLength; i++) {
             if (document.getElementById("type_select").options[i].value == currentlyTId) {
                 document.getElementById("type_select").options[i].selected = true;
            }
         }
    }
    opData();

    function changeType(index) {
        window.open('read.php?tid=' + index, '_self');
    }
</script>
</html>