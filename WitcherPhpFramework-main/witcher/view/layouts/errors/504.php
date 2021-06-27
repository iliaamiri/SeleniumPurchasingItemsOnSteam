
<html>
<head>


    <meta charset="UTF-8">
    <title><?= \Core\controller::$page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<div class="simpleslide100">
    <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg01.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg02.jpg');"></div>
    <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg03.jpg');"></div>
</div>

<div class="size1 overlay1">
    <!--  -->
    <div class="size1 flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-50">
        <h3 class="l1-txt1 txt-center p-b-25" style="color: #ff005d;">
            خطا
        </h3>

        <p class="m2-txt1 txt-center p-b-48">

        </p>

        <div class="flex-w flex-c-m cd100 p-b-33">


            <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
                <span class="l2-txt1 p-b-9 seconds">504</span>
            </div>
        </div>

        <footer>
            <p>WITCHER V<?=WITCHER_VERSION?></p>
        </footer>
    </div>

</div>



<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/bootstrap/js/popper.js"></script>
<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/select2/select2.min.js"></script>

<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="<?=HTTPS_SERVER?>/witcherAssets/loaderAssets/js/main.js"></script>
</body>
</html>

