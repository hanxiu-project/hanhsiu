<?php include_once 'database.php'; ?>
<?php $title = '搜尋結果'; ?>
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

                    <form method="GET" action="">
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

                    <?php
                    if (isset($_GET['searchArticle'])) {
                        if (isset($_GET['title'])) {
                            echo "<script>location.href='search.php?keyword=$_GET[keyword]&search=$_GET[title]';</script>";
                        } else if (isset($_GET['content'])) {
                            echo "<script>location.href='search.php?keyword=$_GET[keyword]&search=$_GET[content]';</script>";
                        }
                    }
                    ?>

                </div>

                <div class="main-wrap__right">
                    <!-- 選擇單元 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="articletype.php">瑜論講記</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">搜尋結果</li>
                        </ol>
                    </nav>

                    <div class="mb-4">
                        <h4 class="heading-style__2">搜尋結果</h4>
                    </div>

                    <div class="page-wrap">
                        <?php
                        $_SESSION["keyword"] = $_GET['keyword'];
                        if (isset($_GET['search']) && $_GET['search'] == "title") {
                            $sqlarg = "and `title` LIKE '%$_SESSION[keyword]%'";
                        } else if (isset($_GET['search']) && $_GET['search'] == "content") {
                            $sqlarg = "and `content` LIKE '%$_SESSION[keyword]%'";
                        }

                        $sqlmain = "SELECT * FROM `scripture` where 1=1  ORDER BY `number` ASC";
                        $sqlsrc = str_replace('1=1', "1=1 " . $sqlarg, $sqlmain);


                        $resultshow = mysqli_query($db_link, $sqlsrc);
                        $countresult = mysqli_num_rows($resultshow);
                        if ($countresult == 0) {
                            echo "<script>alert('查無資料！');location.href='articletype.php';</script>";
                        } else {
                            while ($rowt = $resultshow->fetch_assoc()) {
                                $srctitleresult_id[] = $rowt['s_id'];
                                $srctitleresult_number[] = $rowt['number'];
                                $srctitleresult_type[] = $rowt['typename'];
                            }
                            for ($i = 0; $i < $countresult; $i++) {
                                echo "<a href=article.php?sid='$srctitleresult_id[$i]' title='$srctitleresult_number[$i]'>$srctitleresult_type[$i] / $srctitleresult_number[$i]</a>";
                            }
                        }
                        ?>
                    </div>

                    <div class="text-center my-5">
                        <a class="btn-style__1" href="javascript:window.history.go(-1);">回上一頁</a>
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