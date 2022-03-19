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
            <div class="container main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        補充資料
                        <div class="tit-en">supplementary</div>
                    </div>
                </div>

                <div class="main-wrap__right">
                    <!-- 選擇項目 -->
                    <div class="supplementary-wrap mb-4">
                        <?php
                        $sqlatypecnum = "SELECT * FROM `spm_types` order by listorder";
                        $results_row = mysqli_query($db_link, $sqlatypecnum);
                        while ($row = mysqli_fetch_assoc($results_row)) {
                            echo "<a class='supplementary-wrap__link' href='supplementpages.php?sptid=$row[spt_id]' title='$row[spmtypename]'>";
                            echo "<p class='tit'>$row[spmtypename]</p>";
                            echo "<p class='txt'>卷數： 本地分 卷21-34，決擇分卷67的大部分加上卷68-71。</p>";
                            echo  "</a>";
                        }
                        ?>
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