<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="logo outside" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger" id="hamburger-1">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-lg-0 w-100 justify-content-lg-between">
                    <li class="nav-item order-1 inside">
                        <a class="nav-link logo" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" href="origin.php">緣起</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" href="articletype.php">瑜論講記</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" href="kepan.php">科判</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" href="supplementtype.php">補充資料</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link" href="videotypes.html">法音流佈</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link active" href="news.php">公告訊息</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link" href="contact.php">聯絡我們</a>
                    </li>
                    <!--帳號判斷-->
                    <?php
                    $sql_search_acc = "SELECT * FROM `members` WHERE `account` = '$_SESSION[acc]'";
                    $resultsrchacc = mysqli_query($db_link, $sql_search_acc);
                    $rows = mysqli_fetch_assoc($resultsrchacc);
                    $acc = $rows["account"];
                    $pwd = $rows["password"];
                    $name = $rows["name"];
                    $authority = $rows["authority"];
                    if ($_SESSION["acc"] == null || $_SESSION["pwd"] == null) {
                        echo "<li class='nav-item order-2'>";
                        echo "<a class=nav-link href=login.php>註冊/登入</a>";
                        echo "</li>";
                    } else if ($_SESSION["acc"] != $acc  || $_SESSION["pwd"] != $pwd) {
                        echo "<li class=nav-item order-2>";
                        echo "<a class=nav-link href=login.php>註冊/登入</a>";
                        echo "</li>";
                    } else if ($authority == '1' || $authority == '2') {
                        echo "<li class='nav-item order-2'>";
                        echo "<div class='dropdown'>";
                        echo "<a class='nav-link d-flex align-items-center dropdown-toggle active' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                        echo "<span class=account_text>";
                        echo "$name";
                        echo "，您好";
                        echo "</span>";
                        echo "</a>";
                        echo "<ul class='dropdown-menu dropdown-menu-end text-center' aria-labelledby='dropdownMenuLink'>";
                        echo "<li><a class='dropdown-item' href='member.html'>會員中心</a></li>";
                        echo "<li><a class='dropdown-item' href='#'>回後台</a></li>";
                        echo "<li><a class='dropdown-item' href='logout.php'>登出</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "</li>";
                    } else {
                        echo "<li class='nav-item order-2'>";
                        echo "<div class='dropdown'>";
                        echo "<a class='nav-link d-flex align-items-center dropdown-toggle active' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                        echo "<span class=account_text>";
                        echo "$name";
                        echo "，您好";
                        echo "</span>";
                        echo "</a>";
                        echo "<ul class='dropdown-menu dropdown-menu-end text-center' aria-labelledby='dropdownMenuLink'>";
                        echo "<li><a class='dropdown-item' href='member.html'>會員中心</a></li>";
                        echo "<li><a class='dropdown-item'href='logout.php'>登出</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "</li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
</header>