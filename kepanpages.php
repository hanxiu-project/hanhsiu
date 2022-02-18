<?php include_once 'database.php'; ?>
<?php $title = '漢修學苑 - 科判'; ?>
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
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        科判
                        <div class="tit-en">judgments</div>
                    </div>
                </div>

                <div class="main-wrap__right">
                    <?php
                    if (isset($_GET["kptid"])) {
                        $kptid = $_GET["kptid"];
                        $sqltype = "SELECT * FROM `kp_types` where `kpt_id` = $kptid";
                        $resulttype = mysqli_query($db_link, $sqltype);
                        $rtypename = mysqli_fetch_row($resulttype);
                        $_SESSION['rtypename'] = $rtypename[1];
                    }
                    ?>
                    <!-- 選擇單元 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="kepan.html">科判</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo "$rtypename[1]" ?></li>
                        </ol>
                    </nav>

                    <div class="mb-4">
                        <h4 class="heading-style__2"><?php echo "$rtypename[1]" ?></h4>
                    </div>

                    <div class="link-list mb-4">
                        <?php
                        $sqlatcnum = "SELECT * FROM `kepans` where `kpt_id` = $kptid ";
                        $result_row = mysqli_query($db_link, $sqlatcnum);
                        $data = mysqli_num_rows($result_row);       //抓總共幾筆
                        if ($data == 0) {
                            echo "<script>alert('目前尚無資料!');location.href='kepan.php'</script>";
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
                            $sqlatcnum10 = "SELECT * FROM `kepans` where `kpt_id` = $kptid  Limit $start  , $per";
                            $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);
                            $resultnum10[$page] = mysqli_query($db_link, $sqlatcnum10);
                            while ($kepan = mysqli_fetch_assoc($resultnum10[$start])) {
                                echo "<a href='download.php?filename=./kepan/$kepan[kptypename]/$kepan[filename]' title='$kepan[filename]'>$kepan[filename]</a>";
                            }
                        }
                        ?>
                    </div>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php
                                $prepage = intval($page) - 1;

                                if ($page == 1) {
                                    echo "<a class='page-link ' href=?kptid=$kptid&page=1 aria-label='Previous'>";
                                    echo "<i class='arrow aleft'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?kptid=$kptid&page=$prepage aria-label='Previous'>";
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
                                        echo "<a class='page-link' href=?kptid=$kptid&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    } else {
                                        echo "<li class='page-item' id=page$i>";
                                        echo "<a class='page-link' href=?kptid=$kptid&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    }
                                }
                            }

                            ?>

                            <li class="page-item">
                                <?php
                                $nextpage = intval($page) + 1;

                                if ($page == $pages) {
                                    echo "<a class='page-link' href=?kptid=$kptid&page=$pages aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?kptid=$kptid&page=$nextpage aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                }
                                ?>
                            </li>

                        </ul>
                    </nav>

                    <div class="text-center my-5">
                        <a class="btn-style__1" href="kepan.php">回上一頁</a>
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