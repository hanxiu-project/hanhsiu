<?php include_once 'database.php'; ?>
<?php $title = '公告訊息'; ?>
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
                    <ul class="book-wrap mb-4">
                        <?php
                        $sqlkptypecnum = "SELECT * FROM `kp_types` order by listorder";
                        $results_row = mysqli_query($db_link, $sqlkptypecnum);
                        //$datas = mysqli_num_rows($results_row); //抓總共幾筆

                        $result = mysqli_query($db_link, $results_row);

                        while ($row = mysqli_fetch_assoc($results_row)) {
                            echo "<li>";
                            echo "<a class='book-wrap__link' href=kepanpages.php?kptid='$row[kpt_id]'>";
                            echo "<div class='book-wrap__front'>";
                            echo "<span>$row[kptypename]</span>";
                            echo "</div>";
                            echo "</a>";
                            echo "</li>";
                        }
                        ?>
                    </ul>
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