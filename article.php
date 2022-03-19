<?php include_once 'database.php'; ?>
<?php $title = '瑜論講記'; ?>
<?php include_once 'include/head.php'; ?>
<?php include_once 'include/nav-bar.php'; ?>

<body>
    <main class="article-mode">
        <section>
            <div class="container-lg main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto mb-5">
                        瑜論講記
                        <div class="tit-en">lecture</div>
                    </div>

                    <div class="article-mode__ctrl">
                        <select class="form-select">
                            <option value="初發論端">初發論端</option>
                            <option value="本地分" selected>本地分</option>
                            <option value="攝決擇分">攝決擇分</option>
                            <option value="攝釋分">攝釋分</option>
                            <option value="攝異門分">攝異門分</option>
                            <option value="攝事分">攝事分</option>
                            <option value="連結檔">連結檔</option>
                        </select>

                        <select class="form-select">
                            <option value="1" selected>01</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                            <option value="2">02</option>
                        </select>

                        <button type="submit" class="btn-style__1 smaller full-w" disabled>上一卷</button>
                        <button type="submit" class="btn-style__1 smaller full-w">下一卷</button>
                    </div>
                </div>

                <?php
                if (isset($_GET["sid"])) {
                    $sqltit = "Select * From `scripture` where `s_id`= $_GET[sid]";
                    $tit = "";
                    $resultshow[$tit] = mysqli_query($db_link, $sqltit);
                    $rtit = mysqli_fetch_row($resultshow[$tit]);
                    $sqltype = "SELECT s_id , scripture.typename , number , title , filename , date FROM `scripture` ,`types` WHERE `scripture`.`s_id`=$_GET[sid] AND `types`.`t_id`=$rtit[1]";
                    $resulttype = mysqli_query($db_link, $sqltype);
                    $type = mysqli_fetch_row($resulttype);
                    $sql_count = "update  scripture set clicktimes =clicktimes+1  WHERE scripture.s_id = $_GET[sid]";
                    mysqli_query($db_link, $sql_count);
                    $sqlcount = "SELECT * FROM scripture  WHERE scripture.s_id = $_GET[sid] ";
                    $resultcount = mysqli_query($db_link, $sqlcount);
                    $rowcount = mysqli_fetch_assoc($resultcount);
                ?>

                    <div class="main-wrap__right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item">
                                    <a href="articletype.html">瑜論講記</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="articlepages.html">
                                        <?php echo "$type[1]"; ?>
                                    </a>
                                </li>
                            </ol>
                        </nav>

                        <!-- 文章標題 -->
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4">
                            <h4 class="heading-style__2 mb-2 mb-md-0">
                                <?php echo "$type[1]"; ?>
                                <span class="tline">
                                    <?php echo "$type[2]"; ?>
                                </span>
                            </h4>
                            <p class="mb-0 color02">瀏覽人次為
                                <span class="ms-2">
                                <?php echo "$rowcount[clicktimes]";
                            }
                                ?>
                                </span>
                            </p>
                        </div>

                        <!-- 文章內文 -->
                        <article>
                            <?php
                            $_SESSION["tid"] = "$rtit[0]";

                            $typename = $rtit[2];
                            $filename = $rtit[5];
                            $str = "";
                            //判斷是否有該檔案
                            if (file_exists("./ScriptureFile/$typename/$filename")) {
                                $file = fopen("./ScriptureFile/$typename/$filename", "r");
                                if ($file != NULL) {
                                    //當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
                                    while (!feof($file)) {
                                        $str .= fgets($file);
                                    }
                                    fclose($file);
                                }
                            }
                            echo "$str";
                            ?>
                        </article>
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