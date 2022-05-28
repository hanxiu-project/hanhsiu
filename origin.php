<?php include 'database.php'; ?>
<?php $title = '漢修學苑'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

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
                        緣起
                        <div class="tit-en">origin</div>
                    </div>
                </div>
                <div class="main-wrap__right">
                    <div class="mb-4">
                        <h4 class="heading-style__2">《瑜伽師地論講記》電子筆錄網頁 緣起</h4>
                    </div>
                    <?php
                    $sql = "SELECT * FROM origin";
                    $result = mysqli_query($db_link, $sql);
                    while ($row = $result->fetch_assoc()) {
                        /*echo "<tr>"*/
                        echo "<td >$row[content]</td>";
                        /*echo "</tr>";*/
                    }
                    /*echo "</table>"; */
                    mysqli_close($db_link);
                    ?>
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