<?php include_once 'database.php'; ?>
<?php $title = '法音流佈'; ?>
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

        <?php
        $sql_video_slogan = "SELECT * FROM `slogan` WHERE `sloganid` = 4";
        $result_video_slogan = mysqli_query($db_link, $sql_video_slogan);
        $row_video_slogan = $result_video_slogan->fetch_assoc();

        $sql_read_slogan = "SELECT * FROM `slogan` WHERE `sloganid` = 5 ";
        $result_read_slogan = mysqli_query($db_link, $sql_read_slogan);
        $row_read_slogan = $result_read_slogan->fetch_assoc();
        ?>

        <section>
            <div class="container main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        法音流佈
                        <div class="tit-en">videos</div>
                    </div>
                </div>
                <div class="main-wrap__right">

                    <div class="mb-4">
                        <h4 class="heading-style__2">聞思正法</h4>
                        <p><?php echo "$row_video_slogan[slogantext]"; ?></p>
                    </div>
                    <div class="inside-menu mb-5">
                        <?php
                        $sql_video = "SELECT b.*, s.vst_id FROM video_bigtypes b left join video_smalltypes s on s.vbt_id = b.vbt_id GROUP BY vbt_id ORDER BY listorder";
                        $result_video = mysqli_query($db_link, $sql_video);
                        while ($script = mysqli_fetch_assoc($result_video)) {
                            if ($script['vst_id'] == null) {
                                echo "<a class=inside-menu__link href=video.php?v_bid='$script[vbt_id]'>$script[b_typename]</a>";
                            } else {
                                echo "<div class=inside-menu__wrap>";
                                echo    "<a class=inside-menu__link href=javascript:;>$script[b_typename]</a>";
                                $sql_video_small = "SELECT * FROM video_smalltypes WHERE vbt_id = $script[vbt_id] ORDER BY listorder";
                                $result_video_small = mysqli_query($db_link, $sql_video_small);
                                echo    "<div class=inside-menu__link-box>";
                                while ($script_small = mysqli_fetch_assoc($result_video_small)) {
                                    echo    "<a href=video.php?v_sid='$script_small[vst_id]'>$script_small[s_typename]</a>";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>


                    <div class="mb-4">
                        <h4 class="heading-style__2">瑜論筆錄讀誦</h4>
                        <p><?php echo "$row_read_slogan[slogantext]"; ?></p>
                    </div>
                    <div class="inside-menu mb-5">
                        <?php
                        $sql_read = "SELECT b.*, s.st_id FROM repeatafterme_bigtypes b left join repeatafterme_smalltypes s on s.t_id = b.t_id GROUP BY t_id ORDER BY listorder";
                        $result_read = mysqli_query($db_link, $sql_read);
                        while ($script = mysqli_fetch_assoc($result_read)) {
                            if ($script['st_id'] == null) {
                                echo "<a class=inside-menu__link href=read.php?tid='$script[t_id]'>$script[repeatype]</a>";
                            } else {
                                echo "<div class=inside-menu__wrap>";
                                echo    "<a class=inside-menu__link href=javascript:;>$script[repeatype]</a>";
                                $sql_read_small = "SELECT * FROM repeatafterme_smalltypes WHERE t_id = $script[t_id] ORDER BY listorder";
                                $result_read_small = mysqli_query($db_link, $sql_read_small);
                                echo    "<div class=inside-menu__link-box>";
                                while ($script_small = mysqli_fetch_assoc($result_read_small)) {
                                    echo    "<a href=read.php?stid='$script_small[st_id]'>$script_small[s_typename]</a>";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
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