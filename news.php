<?php include 'database.php'; ?>
<?php $title = '公告訊息'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>
    <?php
    //$sqlold = "SELECT * FROM posts where old = '1' order by date DESC";
    //$resultold= mysqli_query($db_link,$sqlold);
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $getDate = date("Y-m-d");
    ?>
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
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        公告訊息
                        <div class="tit-en">news</div>
                    </div>
                </div>

                <div class="main-wrap__right">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest" type="button" role="tab" aria-controls="latest" aria-selected="true">
                                最新公告
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="old-tab" data-bs-toggle="tab" data-bs-target="#old" type="button" role="tab" aria-controls="old" aria-selected="false">歷史公告</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                            <div class="link-list mb-4">

                                <?php

                                $sqlnew = "SELECT * FROM posts where save='0' && old='0' && keep='0' order by date DESC";
                                $resultnew = mysqli_query($db_link, $sqlnew);

                                $date_nums1 = mysqli_num_rows($resultnew);                          //講記數量
                                $per1 = 10;                                                      //10筆換頁
                                $pages1 = ceil($date_nums1 / $per1);                             //共幾頁
                                if (!isset($_GET["news_page"])) {
                                    $page1 = 1;
                                } else {
                                    $page1 = intval($_GET["news_page"]);                              //確認頁數只能是數值資料
                                }

                                $start1 = ($page1 - 1) * $per1;

                                $sqlresultnew = "SELECT * FROM posts where save='0' && old='0' && keep='0' order by top desc, date desc, p_id desc Limit $start1 , $per1";
                                $newresult[$start1] = mysqli_query($db_link, $sqlresultnew);
                                $newresult[$page1] = mysqli_query($db_link, $sqlresultnew);

                                while ($row = mysqli_fetch_assoc($newresult[$start1])) {
                                    $date1 = strtotime($getDate);
                                    $date2 = strtotime($row['date']);
                                    $days = ceil(abs($date1 - $date2) / 86400);

                                    if ($days > $row['newday']) {
                                        $sqlii = "update `posts` set old='1'  where `p_id`='$row[p_id]'";
                                        mysqli_query($db_link, $sqlii);
                                    }

                                    echo "<span class='text-style__sm'>$row[date]</span>";
                                    echo "<td ><a href = 'post.php?id=$row[p_id]'>$row[title]</a></td>";
                                }

                                echo "<center>";
                                /* echo '共 ' . $date_nums1 . ' 筆-在 ' . $page1 . ' 頁-共 ' . $pages1 . ' 頁';*/
                                echo "<nav>";
                                echo " <ul class='pagination justify-content-center'>";
                                /* echo "<br/><a href=?news_page=1>首頁</a> ";*/
                                echo " <li class='page-item'>";
                                if ($page1 == 1) {
                                    $fp = 1;
                                } else {
                                    $fp = intval($page1) - 1;
                                }

                                echo "<a class='page-link' href='?news_page=$fp' aria-label='Previous'>";
                                echo "<i class='arrow aleft'></i>";
                                echo "</a>";
                                echo "</li>";
                                for ($i = 1; $i <= $pages1; $i++) {
                                    if ($page1 - 5 < $i && $i < $page1 + 5) {
                                        if ($i == $page1) {
                                            echo " <li class='page-item active'  aria-current='page'><a class='page-link' href=?news_page=$i>" . $i . "</a></li>";
                                        } else {
                                            echo " <li class='page-item'><a class='page-link' href=?news_page=$i>" . $i . "</a></li>";
                                        }

                                        //echo "<a href=?page=$i>" . $i . "</a> ";
                                    }
                                }

                                echo " <li class='page-item'>";
                                if ($page1 == $pages1) {
                                    $np = $pages1;
                                } else {
                                    $np = intval($page1) + 1;
                                }
                                echo "<a class='page-link' href='?news_page=$np' aria-label='Next'>";
                                echo "<i class='arrow aright'></i>";
                                echo "</a>";
                                echo "</li>";
                                /* echo "<a href=?news_page=$pages1>末頁</a>";*/
                                echo "</ul>";
                                echo "</nav>";
                                ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="old" role="tabpanel" aria-labelledby="old-tab">
                            <div class="link-list mb-4">
                                <?php

                                $sqlold = "SELECT * FROM posts where save='0' && old='1' && keep='0' order by date DESC";
                                $resultold = mysqli_query($db_link, $sqlold);

                                $date_nums2 = mysqli_num_rows($resultold);                          //講記數量
                                $per2 = 10;                                                      //5筆換頁
                                $pages2 = ceil($date_nums2 / $per2);                             //共幾頁
                                if (!isset($_GET["oldpage"])) {
                                    $page2 = 1;
                                } else {
                                    $page2 = intval($_GET["oldpage"]);                              //確認頁數只能是數值資料
                                }

                                $start2 = ($page2 - 1) * $per2;

                                $sqlresultold = "SELECT * FROM posts where save='0' && old='1' && keep='0' order by date DESC Limit $start2 , $per2";
                                $oldresult[$start2] = mysqli_query($db_link, $sqlresultold);
                                $oldresult[$page2] = mysqli_query($db_link, $sqlresultold);

                                while ($rowold = mysqli_fetch_assoc($oldresult[$start2])) {

                                    echo "<span class='text-style__sm'>$rowold[date]</span>";

                                    echo "<td ><a href = 'post.php?id=$rowold[p_id]'>$rowold[title]</a></td>";
                                }


                                echo "<center>";
                                /* echo '共 ' . $date_nums2 . ' 筆-在 ' . $page2 . ' 頁-共 ' . $pages2 . ' 頁';*/
                                echo "<nav>";
                                echo " <ul class='pagination justify-content-center'>";
                                /* echo "<br/><a href=?news_page=1>首頁</a> ";*/
                                echo " <li class='page-item'>";

                                if ($page2 == 1) {
                                    $fp = 1;
                                } else {
                                    $fp = intval($page2) - 1;
                                }
                                echo "<a class='page-link' href='?oldpage=$fp' aria-label='Previous'>";
                                echo "<i class='arrow aleft'></i>";
                                echo "</a>";
                                echo "</li>";
                                for ($i = 1; $i <= $pages2; $i++) {
                                    if ($page2 - 5 < $i && $i < $page2 + 5) {
                                        if ($i == $page2) {
                                            echo " <li class='page-item active'  aria-current='page'><a class='page-link' href=?oldpage=$i>" . $i . "</a></li>";
                                        } else {
                                            echo " <li class='page-item'><a class='page-link' href=?oldpage=$i>" . $i . "</a></li>";
                                        }

                                        //echo "<a href=?page=$i>" . $i . "</a> ";
                                    }
                                }

                                echo " <li class='page-item'>";
                                if ($page2 == $pages2) {
                                    $np = $pages2;
                                } else {
                                    $np = intval($page2) + 1;
                                }

                                echo "<a class='page-link' href='?oldpage=$np' aria-label='Next'>";
                                echo "<i class='arrow aright'></i>";
                                echo "</a>";
                                echo "</li>";
                                /* echo "<a href=?news_page=$pages1>末頁</a>";*/
                                echo "</ul>";
                                echo "</nav>";

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="wave-block in-buttom"></div>
    </main>
    <footer w3-include-html="include/_footer.php"></footer>

    <!-- JAVASCRIPT W3 -->
    <script>
        w3.includeHTML();
    </script>

    <!-- JAVASCRIPT -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/main.js"></script>
</body>

</html>