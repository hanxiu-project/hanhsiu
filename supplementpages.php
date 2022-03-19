<?php include_once 'database.php'; ?>
<?php $title = '補充資料'; ?>
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
            <?php
            if (isset($_GET["sptid"])) {
                $sptid = $_GET["sptid"];
                $sqltype = "SELECT * FROM `spm_types` where `spt_id` = $sptid";
                $resulttype = mysqli_query($db_link, $sqltype);
                $rtypename = mysqli_fetch_assoc($resulttype);
                $_SESSION['rtypename'] = $rtypename['spmtypename'];
            }
            ?>


            <div class="container main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        補充資料
                        <div class="tit-en">supplementary</div>
                    </div>
                </div>

                <div class="main-wrap__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="supplementtype.php">補充資料</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php
                                echo $_SESSION['rtypename'];
                                ?>
                            </li>
                        </ol>
                    </nav>

                    <div class="mb-4">
                        <h4 class="heading-style__2">
                            <?php
                            echo $_SESSION['rtypename'];
                            ?>
                        </h4>
                        <p>卷數： 本地分 卷21-34，決擇分卷67的大部分加上卷68-71。</p>
                    </div>


                    <div class="link-list mb-4">
                        <?php
                        $sqlatcnum = "SELECT * FROM `supplements` where  `save`='0' && `spt_id` = $sptid ";
                        $result_row = mysqli_query($db_link, $sqlatcnum);
                        $data = mysqli_num_rows($result_row);       //抓總共幾筆
                        if ($data != 0) {
                            $per = 10;
                            $pages = ceil($data / $per);
                            $k = $pages;
                            if (!isset($_GET["page"])) {
                                $page = 1;
                            } else {
                                $page = intval($_GET["page"]);
                            }

                            $resultnum = mysqli_query($db_link, $sqlatcnum);
                            $start = ($page - 1) * $per;
                            $sqlatcnum10 = "SELECT * FROM `supplements` where  `save`='0' &&`spt_id` = $sptid order by `sp_id` DESC Limit  $start  , $per";
                            $resultnum10[$start] = mysqli_query($db_link, $sqlatcnum10);

                            while ($supplement = mysqli_fetch_assoc($resultnum10[$start])) {
                                echo "<a href='supplement.php?spid=$supplement[sp_id]' title='$supplement[title]'>";
                                echo "<span class='text-style__sm'>$supplement[date]</span>";
                                echo "$supplement[title]";
                                echo "</a>";
                            }
                        } else {
                            echo "<script>alert('此類別尚無資料！');location.href = 'supplementtype.php';</script>";
                        }

                        ?>
                    </div>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php
                                $prepage = intval($page) - 1;

                                if ($page == 1) {
                                    echo "<a class='page-link ' href=?sptid=$sptid&page=1 aria-label='Previous'>";
                                    echo "<i class='arrow aleft'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?sptid=$sptid&page=$prepage aria-label='Previous'>";
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
                                        echo "<a class='page-link' href=?sptid=$sptid&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    } else {
                                        echo "<li class='page-item' id=page$i>";
                                        echo "<a class='page-link' href=?sptid=$sptid&page=$i>" . $i . "</a>";
                                        echo "</li>";
                                    }
                                }
                            }

                            ?>

                            <li class="page-item">
                                <?php
                                $nextpage = intval($page) + 1;

                                if ($page == $pages) {
                                    echo "<a class='page-link' href=?sptid=$sptid&page=$pages aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                } else {
                                    echo "<a class='page-link' href=?sptid=$sptid&page=$nextpage aria-label='Previous'>";
                                    echo "<i class='arrow aright'></i>";
                                    echo "</a>";
                                }
                                ?>
                            </li>

                        </ul>
                    </nav>

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