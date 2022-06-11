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
                            <label class="col-form-label">聞思正法</label>
                            <select class="form-select mb-3">
                                <option value="瑜論-菩薩地選讀">瑜論-菩薩地選讀</option>
                                <option value="瑜論探義">瑜論探義</option>
                                <option value="百法明門論">百法明門論</option>
                                <option value="八識規矩頌">八識規矩頌</option>
                                <option value="五十陰魔">五十陰魔</option>
                                <option value="隨緣開示">隨緣開示</option>
                            </select>
                            <select class="form-select">
                                <option value="種性品">種性品</option>
                                <option value="發心品">發心品</option>
                                <option value="自他利品">自他利品</option>
                                <option value="真實義品">真實義品</option>
                                <option value="威力品">威力品</option>
                                <option value="成熟品">成熟品</option>
                                <option value="菩提品">菩提品</option>
                                <option value="力種性品">力種性品</option>
                                <option value="施品">施品</option>
                                <option value="戒品">戒品</option>
                                <option value="精進品">精進品</option>
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
                        <li class="breadcrumb-item active" aria-current="page">聞思正法</li>
                    </ol>
                </nav>

                <?php
                if (isset($_GET["v_bid"])) {
                    $sql_big = "SELECT v.*, b.b_typename FROM videos v , video_bigtypes b where v.v_id = $_GET[v_bid] and v.vbt_id = b.vbt_id";
                    $result_big = mysqli_query($db_link, $sql_big);
                    $row_big = mysqli_fetch_assoc($result_big);
                ?>

                <h4 class="heading-style__2 mb-4"><?php echo "$row_big[b_typename]"; ?></h4>

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
                        $result_big_for_while = mysqli_query($db_link, $sql_big);
                        while ($script = mysqli_fetch_assoc($result_big_for_while)) {
                         echo "<tr>";
                            echo "<td scope=row>";
                            echo "<a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video=zgaY3341eDU>$script[content]</a>";
                            echo "</td>";
                            echo "<td>$script[memo]</td>";
                            echo "<td>$script[vols]</td>";
                         echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>

                <div id="videoTable"></div>
                <?php
                    }
                ?>

                <?php
                if (isset($_GET["v_sid"])) {
                    $sql_small = "SELECT v.*, b.b_typename, s.s_typename FROM videos v , video_bigtypes b , video_smalltypes s where v.v_id = $_GET[v_sid] and v.vbt_id = b.vbt_id and v.vst_id = s.vst_id";
                    $result_small = mysqli_query($db_link, $sql_small);
                    $row_small = mysqli_fetch_assoc($result_small);
                    ?>

                    <h4 class="heading-style__2 mb-4"><?php echo "$row_small[b_typename]"; ?><span class="tline"><?php echo "$row_small[s_typename]"; ?></span></h4></h4>

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
                        $result_small_for_while = mysqli_query($db_link, $sql_small);
                        while ($script = mysqli_fetch_assoc($result_small_for_while)) {
                            echo "<tr>";
                            echo "<td scope=row>";
                            echo "<a class=link-style__1 d-block href=javascript:; data-bs-toggle=modal data-bs-target=#videoModal data-bs-video=zgaY3341eDU>$script[content]</a>";
                            echo "</td>";
                            echo "<td>$script[memo]</td>";
                            echo "<td>$script[vols]</td>";
                            echo "</tr>";
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

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-style__1">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="videoModalLabel"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="videobox">
                    <iframe src="" frameborder="0" allowfullscreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

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