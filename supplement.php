<?php include_once 'database.php'; ?>
<?php $title = '補充資料'; ?>
<?php include_once 'include/head.php'; ?>
<?php include_once 'include/nav-bar.php'; ?>

<body>
    <main class="article-mode">
        <section>
            <div class="container-lg main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto mb-5">
                        補充資料
                        <div class="tit-en">supplementary</div>
                    </div>

                    <div class="article-mode__ctrl">
                        <select class="form-select" id="type_select" onchange="changeType(this.value)">
                            <?php
                            $sqlatypecnum = "SELECT * FROM `spm_types` order by listorder";
                            $results_row = mysqli_query($db_link, $sqlatypecnum);

                            while ($row = mysqli_fetch_assoc($results_row)) {
                                echo "<option value='$row[spt_id]'>$row[spmtypename]</option>";
                            }
                            ?>
                        </select>

                        <select class="form-select" id="chapter_select" onchange="goSupplement(this.value)">
                        </select>

                        <button type="submit" name="previous" class="btn-style__1 smaller full-w" onclick="page('pre')">上一卷</button>
                        <button type="submit" name="next" class="btn-style__1 smaller full-w" onclick="page('next')">下一卷</button>
                    </div>
                </div>

                <?php
                if (isset($_GET["spid"]))                                                            //sid為經文id(同資料庫的s_id意思)
                {
                    $sqltit = "Select * From `supplements` where `sp_id`= $_GET[spid]";
                    $tit = "";
                    $resultshow[$tit] = mysqli_query($db_link, $sqltit);
                    $rtit = mysqli_fetch_row($resultshow[$tit]);

                    $sqltype = "SELECT sp_id , supplements.spmtypename, title , filename , date FROM `supplements` ,`spm_types` WHERE `supplements`.`sp_id`=$_GET[spid] AND `spm_types`.`spt_id`=$rtit[1]";

                    $resulttype = mysqli_query($db_link, $sqltype);
                    $type = mysqli_fetch_row($resulttype);
                    $sql_count = "update  supplements set clicktimes =clicktimes+1  WHERE supplements.sp_id = $_GET[spid]";
                    mysqli_query($db_link, $sql_count);

                    $sqlcount = "SELECT * FROM supplements  WHERE supplements.sp_id = $_GET[spid] ";
                    $resultcount = mysqli_query($db_link, $sqlcount);
                    $rowcount = mysqli_fetch_assoc($resultcount);
                ?>

                    <div class="main-wrap__right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item">
                                    <a href="supplementtype.php">補充資料</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="supplementpages.php?sptid=<?php echo "$rtit[1]" ?>" name="supplementtype-id" id="<?php echo "$rtit[1]" ?>">
                                        <?php echo "$type[1]"; ?>
                                    </a>
                                </li>
                            </ol>
                        </nav>

                        <!-- 文章標題 -->
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mb-4">
                            <h4 class="heading-style__2 mb-2 mb-md-0">
                                <?php echo "$type[1]"; ?>
                                <span class="tline" name="supplement-id" id=<?php echo "$_GET[spid]" ?>>
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
                            $_SESSION["sptid"] = "$rtit[0]";

                            $typename = $rtit[2];
                            $filename = $rtit[4];
                            $str = "";
                            //判斷是否有該檔案
                            if (file_exists("./supplement/$typename/$filename")) {
                                $file = fopen("./supplement/$typename/$filename", "r");
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
    //載入後執行帶入typeid撈出第二層下拉
    function opData() {
        var currentlyTId = document.getElementsByName('supplementtype-id')[0].id;
        var optionLength = document.getElementById("type_select").options.length;

        for (var i = 0; i < optionLength; i++) {
            if (document.getElementById("type_select").options[i].value == currentlyTId) {
                document.getElementById("type_select").options[i].selected = true;
            }
        }
        changeType(currentlyTId);
    }
    opData();

    function changeType(index) {
        var chapterSelect = document.getElementById("chapter_select");

        $.ajax({
            url: "deal.php",
            method: "POST",
            data: {
                SelectedSupplementType: index
            },
            success: function(res) {
                chapterSelect.innerHTML = res;
                keepAID();
            }
        });
    }

    function goSupplement(spid) {
        window.open('supplement.php?spid=' + spid, '_self');
    }

    //
    function keepAID() {
        var currentlyAId = document.getElementsByName('supplement-id')[0].id;
        var optionLength = document.getElementById("chapter_select").options.length;

        for (var i = 0; i < optionLength; i++) {
            if (document.getElementById("chapter_select").options[i].value == currentlyAId) {
                document.getElementById("chapter_select").options[i].selected = true;

                if (i == 0) {
                    prePage = document.getElementById("chapter_select").options[i].value;
                    nextPage = document.getElementById("chapter_select").options[i + 1].value;
                    document.getElementsByName('previous')[0].disabled = true
                } else if (i == optionLength - 1) {
                    prePage = document.getElementById("chapter_select").options[i - 1].value;
                    nextPage = document.getElementById("chapter_select").options[i].value;
                    document.getElementsByName('next')[0].disabled = true
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
            window.location.href = "supplement.php?spid=" + prePage;
        } else if (arg == 'next') {
            window.location.href = "supplement.php?spid=" + nextPage;
        }

    }
</script>

</html>