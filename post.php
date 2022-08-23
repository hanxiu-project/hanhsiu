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
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM posts WHERE p_id = $id";
                $result = mysqli_query($db_link, $sql);
                $row = mysqli_fetch_assoc($result);
            }
            ?>
            <div class="container main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        公告訊息
                        <div class="tit-en">news</div>
                    </div>
                </div>
                <div class="main-wrap__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="news.php">公告訊息</a>
                            </li>
                            <?php
                            if ($row['old'] == 1) {
                            ?>
                                <li class="breadcrumb-item active" aria-current="page">歷史公告</li>
                            <?php
                            } else {
                            ?>
                                <li class="breadcrumb-item active" aria-current="page">最新公告</li>
                            <?php

                            }
                            ?>

                        </ol>
                    </nav>



                    <div class="mb-4">
                        <h4 class="heading-style__2"><?php echo $row["title"] ?></h4>
                        <p><?php echo $row["date"] ?></p>
                    </div>

                    <hr class="line-style__1" />

                    <!-- 文章內文 -->
                    <?php echo $row["content"] ?>

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