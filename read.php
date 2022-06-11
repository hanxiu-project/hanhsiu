<?php include_once 'database.php'; ?>
<?php $title = '瑜論講記'; ?>
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
                <div data-boxname="head" class="heading-style__1 mx-auto mb-5">
                    法音流佈
                    <div class="tit-en">videos</div>
                </div>

                <form action="#">
                    <div class="close-wrap site1">
                        <button type="button" class="btn-style__arrow">
                            <i class="arrow"></i>
                        </button>
                        <div>
                            <label class="col-form-label">瑜論筆錄讀誦</label>
                            <select class="form-select">
                                <option value="本地分">本地分</option>
                                <option value="攝決擇分">攝決擇分</option>
                                <option value="攝釋分">攝釋分</option>
                                <option value="攝異門分">攝異門分</option>
                                <option value="攝事分">攝事分</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="main-wrap__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="videotypes.html">法音流佈</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">瑜論筆錄讀誦</li>
                    </ol>
                </nav>

                <?php
                    if (isset($_GET["tid"])) {
                        $sql_type = "Select * From `repeatafterme` where `t_id`= $_GET[tid]";
                        $result_type = mysqli_query($db_link, $sql_type);
                        $r_type = mysqli_fetch_row($result_type);
                ?>

                <h4 class="heading-style__2 mb-4"><?php echo $r_type[2] ?></h4>

                <table class="table table-style__1 mb-4">
                    <thead>
                    <tr>
                        <th scope="col">內容</th>
                        <th scope="col">備註</th>
                        <th scope="col">集數</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "Select * From `repeatafterme` where `t_id`= $_GET[tid]";
                        $result = mysqli_query($db_link, $sql);
                        while ($script = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td scope='row'>
                                    <a class='link-style__1 d-block' target='_blank'>$script[content]</a>
                                </td>
                                <td>$script[memo]</td>
                                <td>共 $script[vols] 集</td>
                              </tr>
                            ";
                    }
                    ?>
                    </tbody>
                </table>

                <div id="videoTable"></div>
                <?php
                    }
                ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <i class="arrow aleft"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <i class="arrow aright"></i>
                            </a>
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