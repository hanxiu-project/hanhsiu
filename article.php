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
                        <select class="form-select" id="type_select" onchange="changeType(this.value)">
                            <?php
                            $sqlatypecnum = "SELECT * FROM `types` order by listorder";
                            $results_row = mysqli_query($db_link, $sqlatypecnum);

                            while ($row = mysqli_fetch_assoc($results_row)) {
                                echo "<option value='$row[t_id]'>$row[typename]</option>";
                            }
                            ?>
                        </select>

                        <select class="form-select" id="chapter_select" onchange="goArticle(this.value)">
                        </select>
                        <button type="submit" name="previous" class="btn-style__1 smaller full-w" onclick="page('pre')">上一卷</button>
                        <button type="submit" name="next" class="btn-style__1 smaller full-w" onclick="page('next')">下一卷</button>
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
                                    <a href="articlepages.html" name="articletype-id" id="<?php echo "$rtit[1]" ?>">
                                        <?php echo "$type[1]"; ?>
                                    </a>
                                </li>
                            </ol>
                        </nav>

                        <!-- 文章標題 -->
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4">
                            <h4 class="heading-style__2 mb-2 mb-md-0">
                                <?php echo "$type[1]"; ?>
                                <span class="tline" name="article-id" id="<?php echo "$_GET[sid]" ?>">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    var prePage = '';
    var nextPage = '';
    //載入後執行帶入tid撈出第二層下拉
    window.onload = function() {
        var currentlyTId = document.getElementsByName('articletype-id')[0].id;
        var optionLength = document.getElementById("type_select").options.length;

        for (var i = 0; i < optionLength; i++) {
            if (document.getElementById("type_select").options[i].value == currentlyTId) {
                document.getElementById("type_select").options[i].selected = true;
            }
        }
        changeType(currentlyTId);
    }

    function changeType(index) {
        var chapterSelect = document.getElementById("chapter_select");

        $.ajax({
            url: "deal.php",
            method: "POST",
            data: {
                SelectedArticleType: index
            },
            success: function(res) {
                chapterSelect.innerHTML = res;
                keepAID();
            }
        });
    }

    function goArticle(sid) {
        window.open('article.php?sid=' + sid, '_self');
    }

    //
    function keepAID() {
        var currentlyAId = document.getElementsByName('article-id')[0].id;
        var optionLength = document.getElementById("chapter_select").options.length;

        for (var i = 0; i < optionLength; i++) {
            if (document.getElementById("chapter_select").options[i].value == currentlyAId) {
                document.getElementById("chapter_select").options[i].selected = true;

                if (i == 0) {
                    prePage = document.getElementById("chapter_select").options[i].value;
                    nextPage = document.getElementById("chapter_select").options[i + 1].value;
                    document.getElementsByName('previous')[i].disabled = true
                } else if (i == optionLength - 1) {
                    prePage = document.getElementById("chapter_select").options[i - 1].value;
                    nextPage = document.getElementById("chapter_select").options[i].value;
                    document.getElementsByName('previous')[i].disabled = true
                } else {
                    prePage = document.getElementById("chapter_select").options[i - 1].value;
                    nextPage = document.getElementById("chapter_select").options[i + 1].value;
                }
            }
        }
    }

    //上一卷,下一卷
    function page(arg) {
        if (arg == 'pre') {
            window.location.href = "article.php?sid=" + prePage;
        } else if (arg == 'next') {
            window.location.href = "article.php?sid=" + nextPage;
        }

    }
</script>

</html>