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
                        瑜論講記
                        <div class="tit-en">lecture</div>
                    </div>

                    <form method="GET" action="search.php">
                        <div class="close-wrap site1">
                            <button type="button" class="btn-style__arrow">
                                <i class="arrow"></i>
                            </button>
                            <div class="mb-3">
                                <label class="col-form-label">搜尋 / Search</label>
                                <input type="text" class="form-control" name="keyword" placeholder="請輸入文字" />
                            </div>
                            <div class="d-flex mb-3">
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="search" id="flexRadioDefault1" value="title" checked />
                                    <label class="form-check-label" for="flexRadioDefault1"> 標題 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="search" id="flexRadioDefault2" value="content" />
                                    <label class="form-check-label" for="flexRadioDefault2"> 內容 </label>
                                </div>
                            </div>
                            <input type="submit" class="btn-style__1 smaller full-w" naem="searchArticle" value="搜尋" />
                        </div>
                    </form>
                </div>

                <!--  **********  判斷是否點選講記類別  **************-->
                <?php
                if (isset($_GET["tid"])) {
                    $tid = $_GET["tid"];
                    $sqltype = "SELECT * FROM `types` where `t_id` = $tid";
                    $resulttype = mysqli_query($db_link, $sqltype);
                    $rtypename = mysqli_fetch_row($resulttype);
                    $_SESSION['rtypename'] = $rtypename[1]; ?>

                    <!--  **********  已點選講記類別  **************-->
                    <div class="main-wrap__right">
                        <!-- 選擇單元 -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item">
                                    <a href="articletype.php">瑜論講記</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php echo "$rtypename[2]" ?>
                                </li>
                            </ol>
                        </nav>

                        <div class="mb-4">
                            <h4 class="heading-style__2">
                                <?php echo "$rtypename[2]" ?>
                            </h4>
                        </div>

                        <div class="page-wrap">
                            <?php
                            $sqlatcnum = "SELECT * FROM `scripture` where  `save`='0' && `t_id` = $tid ";

                            $result_row = mysqli_query($db_link, $sqlatcnum);
                            $data = mysqli_num_rows($result_row);
                            $per = 10;
                            $rows = ceil($data / $per);

                            $resultnum = mysqli_query($db_link, $sqlatcnum);

                            for ($i = 1; $i <= $rows; $i++) {
                                $start = ($i - 1) * 10;
                                $sqlatcnum10 = "SELECT * FROM `scripture` where  `save`='0' &&`t_id` = $tid order by CAST(`number` AS UNSIGNED) ASC,s_id ASC Limit  $start  , $per";
                                $resultnum10 = mysqli_query($db_link, $sqlatcnum10);
                                while ($script = mysqli_fetch_assoc($resultnum10)) {
                                    echo "<a href=article.php?sid='$script[s_id]' title='$script[number]'>$script[number]</a>";
                                }
                            } ?>
                        </div>

                        <div class="text-center my-5">
                            <a class="btn-style__1" href="javascript:window.history.go(-1);">回上一頁</a>
                        </div>
                    </div>

                <?php
                } else {
                ?>

                    <!--  **********  未點選講記類別  **************-->
                    <div class="main-wrap__right">
                        <!-- 選擇項目 -->
                        <ul class="book-wrap mb-4">
                            <?php
                            $sqlatypecnum = "SELECT * FROM `types` order by listorder";
                            $results_row = mysqli_query($db_link, $sqlatypecnum);
                            $datas = mysqli_num_rows($results_row);       //抓總共幾筆
                            $per = 10;
                            $rows = ceil($datas / $per);
                            $resultsnum = mysqli_query($db_link, $sqlatypecnum);
                            $sqlscr = "SELECT * FROM `scr_show` ";
                            $result = mysqli_query($db_link, $sqlscr);
                            $rowscr = mysqli_fetch_assoc($result);
                            if ($_SESSION['authority'] == '1' || $_SESSION['authority'] == '2') { //還未編輯之處理
                                for ($j = 1; $j <= $rows; $j++) {
                                    $start = ($j - 1) * 10;
                                    $sqlatcnums10 = "SELECT * FROM types order by listorder Limit $start , $per";
                                    $resultnums10 = mysqli_query($db_link, $sqlatcnums10);

                                    while ($row = mysqli_fetch_assoc($resultnums10)) {
                                        echo "<li>";
                                        echo "<a class='book-wrap__link' href=?tid='$row[t_id]' title='$row[typename]'`>";
                                        echo "<div class='book-wrap__front'>";
                                        echo "<span>$row[typename]</span>";
                                        echo "</div>";
                                        echo "</a>";
                                        echo "</li>";
                                    }
                                }
                            } else {
                                if ($rowscr['shownumber'] == '0') {
                                    echo "<center> <font color=#612E04><h1>※網頁尚在構置中※<h1></font></center>";
                                } else {
                                    for ($j = 1; $j <= $rows; $j++) {
                                        $start = ($j - 1) * 10;
                                        $sqlatcnums10 = "SELECT * FROM types order by listorder Limit $start , $per";
                                        $resultnums10 = mysqli_query($db_link, $sqlatcnums10);

                                        while ($row = mysqli_fetch_assoc($resultnums10)) {
                                            echo "<li>";
                                            echo "<a class='book-wrap__link' href=?tid='$row[t_id]' title='$row[typename]'`>";
                                            echo "<div class='book-wrap__front'>";
                                            echo "<span>$row[typename]</span>";
                                            echo "</div>";
                                            echo "</a>";
                                            echo "</li>";
                                        }
                                    }
                                }
                            } ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
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