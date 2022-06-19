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
                            <label class="col-form-label">聞思正法</label>
                            <select class="form-select mb-2" id="bigtype_select" onchange="changeBigType(this.value)">
                                <?php
                                $sql_bigtype = "SELECT * FROM `video_bigtypes` order by vbt_id";
                                $result = mysqli_query($db_link, $sql_bigtype);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='$row[vbt_id]'>$row[b_typename]</option>";
                                }
                                ?>
                            </select>
                            <select class="form-select mb-2" id="chapter_select"></select>
                            <button type="submit" name="confirm" class="btn-style__1 smaller full-w" onclick="confirm()">確認</button>
                        </div>
                    </div>
                </div>

                <div class="main-wrap__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="videotypes.html">法音流佈</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">聞思正法</li>
                        </ol>
                    </nav>

                    <?php
                    if (isset($_GET["v_bid"])) {
                        $sql_big = "SELECT v.*, b.b_typename FROM videos v , video_bigtypes b where v.vbt_id = $_GET[v_bid] and v.vbt_id = b.vbt_id ORDER BY v.v_id";
                        $sql = "SELECT * FROM `videos` where `vbt_id` = $_GET[v_bid]";
                        $sql_page = "SELECT v.*, b.b_typename FROM videos v , video_bigtypes b where v.vbt_id = $_GET[v_bid] and v.vbt_id = b.vbt_id ORDER BY v.v_id limit $start, $per";
                        $result_row = mysqli_query($db_link, $sql);
                        $data = mysqli_num_rows($result_row);       //抓總共幾筆
                        $result_big = mysqli_query($db_link, $sql_big);
                        $row_big = mysqli_fetch_assoc($result_big);
                    ?>
                        <h4 class="heading-style__2 mb-4" name="videotype_id" id="<?php echo "$row_big[vbt_id]" ?>"><?php echo "$row_big[b_typename]"; ?></h4>
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
                                } else {
                                    $per = 10;
                                    $pages = ceil($data / $per);     //pages
                                    $k = $pages;
                                    if (!isset($_GET["page"])) {
                                        $page = 1;
                                    } else {
                                        $page = intval($_GET["page"]);
                                    }
                                    $start = ($page - 1) * $per;
                                    $resultnum = mysqli_query($db_link, $sqlatcnum);
                                    $sqlatcnum10 = "SELECT * FROM `videos` where `vbt_id` = $_GET[v_bid]  Limit $start  , $per";
                                    $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);
                                    $resultnum10[$page] = mysqli_query($db_link, $sqlatcnum10);
                                    while ($video = mysqli_fetch_assoc($resultnum10[$start])) {
                                        echo "<tr>";
                                        echo "<td scope=row>";
                                        echo "<a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video='$video[video_link]'>$video[content]</a>";
                                        echo "</td>";
                                        echo "<td>$video[memo]</td>";
                                        echo "<td>$video[vols]</td>";
                                        echo "</tr>";
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
                                        echo "<a class='page-link ' href=?v_bid=$_GET[v_bid]&page=1 aria-label='Previous'>";
                                        echo "<i class='arrow aleft'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?v_bid=$_GET[v_bid]&page=$prepage aria-label='Previous'>";
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
                                            echo "<a class='page-link' href=?v_bid=$_GET[v_bid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        } else {
                                            echo "<li class='page-item' id=page$i>";
                                            echo "<a class='page-link' href=?v_bid=$_GET[v_bid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        }
                                    }
                                }
                                ?>
                                <li class="page-item">
                                    <?php
                                    $nextpage = intval($page) + 1;

                                    if ($page == $pages) {
                                        echo "<a class='page-link' href=?v_bid=$_GET[v_bid]&page=$pages aria-label='Previous'>";
                                        echo "<i class='arrow aright'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?v_bid=$_GET[v_bid]&page=$nextpage aria-label='Previous'>";
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

                    <!--==================================================================================================================================================================-->

                    <?php
                    if (isset($_GET["v_sid"])) {
                        $sql_small = "SELECT v.*, b.b_typename, s.s_typename FROM videos v , video_bigtypes b , video_smalltypes s where v.vst_id = $_GET[v_sid] and v.vbt_id = b.vbt_id and v.vst_id = s.vst_id";
                        $sql = "SELECT * FROM `videos` where `vst_id` = $_GET[v_sid]";
                        $sql_page = "SELECT v.*, b.b_typename, s.s_typename FROM videos v , video_bigtypes b , video_smalltypes s where v.vst_id = $_GET[v_sid] and v.vbt_id = b.vbt_id and v.vst_id = s.vst_id limit $start, $per";
                        $result_row = mysqli_query($db_link, $sql);
                        $data = mysqli_num_rows($result_row);       //抓總共幾筆
                        $result_small = mysqli_query($db_link, $sql_small);
                        $row_small = mysqli_fetch_assoc($result_small);
                    ?>
                        <h4 class="heading-style__2 mb-4" name="videotype_id" id="<?php echo "$row_small[vbt_id]" ?>"><?php echo "$row_small[b_typename]"; ?>
                            <span class="tline" name="video_smalltype_id" id="<?php echo "$row_small[vst_id]" ?>"><?php echo "$row_small[s_typename]"; ?></span>
                        </h4>
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
                                } else {
                                    $per = 10;
                                    $pages = ceil($data / $per);     //pages
                                    $k = $pages;
                                    if (!isset($_GET["page"])) {
                                        $page = 1;
                                    } else {
                                        $page = intval($_GET["page"]);
                                    }
                                    $start = ($page - 1) * $per;
                                    $resultnum = mysqli_query($db_link, $sqlatcnum);
                                    $sqlatcnum10 = "SELECT * FROM `videos` where `vst_id` = $_GET[v_sid]  Limit $start  , $per";
                                    $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);
                                    $resultnum10[$page] = mysqli_query($db_link, $sqlatcnum10);
                                    while ($video = mysqli_fetch_assoc($resultnum10[$start])) {
                                        echo "<tr>";
                                        echo "<td scope=row>";
                                        echo "<a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video='$video[video_link]'>$video[content]</a>";
                                        echo "</td>";
                                        echo "<td>$video[memo]</td>";
                                        echo "<td>$video[vols]</td>";
                                        echo "</tr>";
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
                                        echo "<a class='page-link ' href=?v_sid=$_GET[v_sid]&page=1 aria-label='Previous'>";
                                        echo "<i class='arrow aleft'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?v_sid=$_GET[v_sid]&page=$prepage aria-label='Previous'>";
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
                                            echo "<a class='page-link' href=?v_sid=$_GET[v_sid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        } else {
                                            echo "<li class='page-item' id=page$i>";
                                            echo "<a class='page-link' href=?v_sid=$_GET[v_sid]&page=$i>" . $i . "</a>";
                                            echo "</li>";
                                        }
                                    }
                                }
                                ?>
                                <li class="page-item">
                                    <?php
                                    $nextpage = intval($page) + 1;

                                    if ($page == $pages) {
                                        echo "<a class='page-link' href=?v_sid=$_GET[v_sid]&page=$pages aria-label='Previous'>";
                                        echo "<i class='arrow aright'></i>";
                                        echo "</a>";
                                    } else {
                                        echo "<a class='page-link' href=?v_sid=$_GET[v_sid]&page=$nextpage aria-label='Previous'>";
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
        var currentlyTId = document.getElementsByName('videotype_id')[0].id;
        var optionLength = document.getElementById("bigtype_select").options.length;

        for (var i = 0; i < optionLength; i++) {
            if (document.getElementById("bigtype_select").options[i].value == currentlyTId) {
                document.getElementById("bigtype_select").options[i].selected = true;
            }
        }
        changeBigType(currentlyTId);
    }
    opData();

    function changeBigType(index) {
        var chapterSelect = document.getElementById("chapter_select");

        $.ajax({
            url: "deal.php",
            method: "POST",
            data: {
                SelectedVideoType: index
            },
            success: function(res) {
                chapterSelect.innerHTML = res;
                keepAID();
            }
        });
    }

    function keepAID() {
        var optionLength = document.getElementById("chapter_select").options.length;
        if (optionLength != 0) {
            for (var i = 0; i < optionLength; i++) {
                if (document.getElementById("chapter_select").options[i].selected == true) {
                    var currentlyAId = document.getElementById("chapter_select").options[i].value;
                }
            }

            for (var i = 0; i < optionLength; i++) {
                if (document.getElementById("chapter_select").options[i].value == currentlyAId) {
                    document.getElementById("chapter_select").options[i].selected = true;
                }
            }
        }
    }

    function confirm() {
        var optionLength = document.getElementById("chapter_select").options.length;
        var optionBigLength = document.getElementById("bigtype_select").options.length;
        for (var i = 0; i < optionBigLength; i++) {
            if (document.getElementById("bigtype_select").options[i].selected == true) {
                var currentlyTId = document.getElementById("bigtype_select").options[i].value
            }
        }
        if (optionLength != 0) {
            for (var i = 0; i < optionLength; i++) {
                if (document.getElementById("chapter_select").options[i].selected == true) {
                    var currentlySId = document.getElementById("chapter_select").options[i].value;
                }
            }
        }


        if (optionLength == 0) {
            window.open('video.php?v_bid=' + currentlyTId, '_self');
        } else {
            for (var i = 0; i < optionLength; i++) {
                if (document.getElementById("chapter_select").options[i].value == currentlySId) {
                    window.open('video.php?v_sid=' + currentlySId, '_self');
                }
            }
        }
    }
</script>

</html>