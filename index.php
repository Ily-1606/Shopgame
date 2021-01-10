<?php
session_start();
include_once("_connect.php");
include_once("functions/Class.profile.php");
include_once("functions/Class.product.php");
include_once("functions/functions.php");
$check_login = check_login();
if ($check_login) {
    $id = $_SESSION["id"];
    $account = new Profile($id);
    $username = $account->get_username();
    if ($account->get_status() == 0) {
        header("Location: /404.php");
        die;
    }
}
?>
<DOCTYPE html></DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopgame</title>
    <link rel="stylesheet" href="/css3/index.css">
    <link rel="shortcut icon" href="/assets/img/logo-72.png" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">
    <script src="/assets/jquery/jquery.js"></script>
</head>

<body>
    <?php include_once("header_main.php"); ?>
    <?php include_once("nav.php") ?>
    <div class="container">
        <div class="image">
            <div class="main-img">
                <div class="img-left">
                    <div class="img-flex">
                        <div class="back" onclick="myBack()"><i class="fas fa-arrow-left"></i></div>
                        <div class="box-img"></div>
                        <div class="next" onclick="myNext()"><i class="fas fa-arrow-right"></i></div>
                        <div class="li-flex">
                            <div class="border-li-1 border-li"></div>
                            <div class="border-li"></div>
                            <div class="border-li"></div>
                            <div class="border-li"></div>
                            <div class="border-li"></div>
                        </div>
                    </div>
                </div>
                <div class="img-right">
                    <img src="css3/image/games6.jpg" width="470px" ; height="200px">
                    <img src="css3/image/games7.jpg" width="470px;" height="195px" style="margin-top:5px;">

                </div>


            </div>
        </div>
        <div class="body-main">
            <?php include("sliderbar.php"); ?>
            <div class="body-right">
                <h2>Sản phẩm sale</h2>
                <div class="flex-img">
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM table_product WHERE `status` = 1 AND enable_sale = 1 AND end_sale > " . time() . " ORDER BY create_time DESC LIMIT 0,10");
                    $array_banner = array();
                    while ($row = mysqli_fetch_array($res)) {
                        $product = new Product(null, $row);
                        $money = number_format($product->get_money()) . " VND";
                        $selled = $product->get_selled();
                        $poster = $product->get_poster();
                        if (count($array_banner) < 5) {
                            $data_banner = json_decode($row["banner"], true);
                            if (count($data_banner) > 0) {
                                $data_banner = $data_banner[0];
                                $banner = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_banner");
                                $banner = mysqli_fetch_assoc($banner);
                                array_push($array_banner, $banner["url_file"]);
                            }
                        }
                    ?>
                        <a href="/item.php?id=<?php echo $row["id"]; ?>" class="border-img">
                            <img src="<?php echo $poster ?>" class="grenal-img">
                            <div class="informatiton">
                                <p class="word-information"><?php echo $product->get_name(); ?></p>
                            </div>
                            <div class="word-information d-flex">
                                <div class="progress">
                                    <div class="progress_bar" style="width: <?php echo ceil($selled / $product->get_soluong() * 100); ?>%"></div>
                                    <div class="text_progess">Đã bán: <?php echo $selled; ?></div>
                                </div>
                            </div>
                            <div class="d-flex star_rate">
                                <?php echo render_vote($product->get_stats()) ?>
                                <span style="margin-left: 20px;">(<?php echo $product->get_count_voted(); ?>)</span>
                            </div>
                            <div class=" d-flex">
                                <div class="col-left">
                                    <div class="price">
                                        <div class="font-size-p"><?php echo number_format($product->get_current_money()); ?> VND</div>
                                    </div>
                                </div>
                                <div class="col-right">Đã bán:
                                    <?php echo $selled; ?>
                                </div>
                            </div>
                            <?php if ($product->get_enable_sale() && $product->get_end_sale() > time()) { ?>
                                <div class="sell_rounded">
                                    <?php echo $product->get_money_sale(); ?>%
                                </div>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
                <h2>Sản phẩm mới</h2>
                <div class="flex-img">
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM table_product WHERE `status` = 1 ORDER BY create_time DESC LIMIT 0,10");
                    $array_banner = array();
                    while ($row = mysqli_fetch_array($res)) {
                        $product = new Product(null, $row);
                        $money = number_format($product->get_money()) . " VND";
                        $selled = $product->get_selled();
                        $poster = $product->get_poster();
                        if (count($array_banner) < 5) {
                            $data_banner = json_decode($row["banner"], true);
                            if (count($data_banner) > 0) {
                                $data_banner = $data_banner[0];
                                $banner = mysqli_query($conn, "SELECT * FROM table_medias WHERE id = $data_banner");
                                $banner = mysqli_fetch_assoc($banner);
                                array_push($array_banner, $banner["url_file"]);
                            }
                        }
                    ?>
                        <a href="/item.php?id=<?php echo $row["id"]; ?>" class="border-img">
                            <img src="<?php echo $poster ?>" class="grenal-img">
                            <div class="informatiton">
                                <p class="word-information"><?php echo $product->get_name(); ?></p>
                            </div>
                            <div class="word-information d-flex">
                                <div class="progress">
                                    <div class="progress_bar" style="width: <?php echo ceil($selled / $product->get_soluong() * 100); ?>%"></div>
                                    <div class="text_progess">Đã bán: <?php echo $selled; ?></div>
                                </div>
                            </div>
                            <div class="d-flex star_rate">
                                <?php echo render_vote($product->get_stats()) ?>
                                <span style="margin-left: 20px;">(<?php echo $product->get_count_voted(); ?>)</span>
                            </div>
                            <div class=" d-flex">
                                <div class="col-left">
                                    <div class="price">
                                        <div class="font-size-p"><?php echo number_format($product->get_current_money()); ?> VND</div>
                                    </div>
                                </div>
                                <div class="col-right">Đã bán:
                                    <?php echo $selled; ?>
                                </div>
                            </div>
                            <?php if ($product->get_enable_sale() && $product->get_end_sale() > time()) { ?>
                                <div class="sell_rounded">
                                    <?php echo $product->get_money_sale(); ?>%
                                </div>
                            <?php } ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("footer.php") ?>
</body>
<script type="text/javascript">
    function myFunction() {
        var khoi = document.querySelectorAll(".fixed");
        khoi[0].classList.add("move");
        var khoi = document.querySelectorAll(".fixed-1");
        khoi[0].classList.add("move_1");
    }

    function myShow() {
        var show = document.querySelectorAll(".fixed-1");
        show[0].classList.remove("move_1");
        var show = document.querySelectorAll(".fixed");
        show[0].classList.remove("move");
    }


    var slider_poster = document.querySelectorAll('.box-img');
    slider_poster = slider_poster[0];
    var image = <?php echo json_encode($array_banner); ?>;
    var i = image.length;
    var start = true;
    slider_poster.innerHTML = '<img src="' + image[0] + '" width="700px" height="400px"/>';

    function reload_dot(i) {
        $(".li-flex>div").removeClass("border-li-1");
        $(".li-flex>div:nth-of-type(" + (i) + ")").addClass("border-li-1");
    }

    function myNext() {
        if (start == true) {
            i = 2;
            start = false;
        } else {
            if (i < image.length) {
                i = i + 1;
            } else {
                i = 1;
            }
        }
        reload_dot(i);
        slider_poster.innerHTML = '<img src="' + image[i - 1] + '" width="700px" height="400px"/>';
        slider_poster[0].classList.add("img_animation_1");
    }

    function myBack() {
        if (i == 1)
            i = image.length;
        else
            i--;
        reload_dot(i);
        slider_poster.innerHTML = '<img src="' + image[i - 1] + '" width="700px" height="400px"/>';
    }
</script>

</html>