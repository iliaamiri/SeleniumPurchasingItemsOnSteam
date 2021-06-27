<html>
<head>


    <meta charset="UTF-8">
    <title>منتظر بمانید...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"
          href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css"
          href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).ajaxStop(function () {
                $(location).attr('href', '<?= \Core\controller::$data['url'] ?>');
            });
            $.get("<?= \Core\controller::$data['url'] ?>", function (data, status) {
                $(location).attr('href', '<?= \Core\controller::$data['url'] ?>');
            });
        });
    </script>


    <style>
        #myProgress {
            width: 100%;
            background-color: grey;
        }

        #myBar {
            width: 10%;
            height: 30px;
            background-color: #af3e2a;
            text-align: center; /* To center it horizontally (if you want) */
            line-height: 30px; /* To center it vertically */
            color: white;
        }
    </style>
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
        <h3 class="l1-txt1 txt-center p-b-25">
            لطفا منتظر بمانید
        </h3>

        <p class="m2-txt1 txt-center p-b-48">
            در حال انتقال به صفحه پرداخت
        </p>
        <p class="m2-txt1 txt-center p-b-48">
            تونل ویچر نسخه <?= WITCHER_VERSION ?> اولین تونل ترمینال مجهز به رمز پویا
        </p>
        <p class="m2-txt1 txt-center p-b-48">
            لطفا برای پرداخت از رمز پویا استفاده فرمایید
        </p>
        <p>
        <div id="myProgress" style="width: 50%;margin-bottom: 20px;">
            <div id="myBar"></div>
        </div>
        </p>
      <!--<div class="flex-w flex-c-m cd100 p-b-33">

            <div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
                <span class="l2-txt1 p-b-9 seconds">25</span>
                <span class="s2-txt1">ثانیه</span>
            </div>
        </div>
        -->

        <footer>
            <p><img src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/images/favicon.png" height="50px" alt="">
                WITCHER V<?= WITCHER_VERSION ?></p>
        </footer>
    </div>

</div>


<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/bootstrap/js/popper.js"></script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/select2/select2.min.js"></script>

<!--<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/countdowntime/moment.min.js"></script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/countdowntime/moment-timezone.min.js"></script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/countdowntime/countdowntime.js"></script>-->
<script>
    var i = 0;
    var elem = document.getElementById("myBar");

    if (i == 0) {
        i = 1;
        var width = 10;
        var id = setInterval(frame, 250);

        function frame() {
            if (width >= 100) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
                elem.innerHTML = width + "%";
            }
        }
    }

   // $('.cd100').countdown100({
        /*Set Endtime here*/
        /*Endtime must be > current time*/
  /*      endtimeYear: 0,
        endtimeMonth: 0,
        endtimeDate: 0,
        endtimeHours: 0,
        endtimeMinutes: 0,
        endtimeSeconds: 20,
        timeZone: ""    */
        // ex:  timeZone: "America/New_York"
        //go to " http://momentjs.com/timezone/ " to get timezone
  //  });
</script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/vendor/tilt/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="<?= HTTPS_SERVER ?>/witcherAssets/loaderAssets/js/main.js"></script>
</body>
</html>

