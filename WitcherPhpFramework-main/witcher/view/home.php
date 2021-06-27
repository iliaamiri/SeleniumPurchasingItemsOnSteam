<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=\Core\controller::$page_title?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/images/witcher-logo.png/"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/bootstrap/css/bootstrap.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/fonts/font-awesome-4.7.0/css/font-awesome.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/fonts/iconic/css/material-design-iconic-font.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/animate/animate.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/css-hamburgers/hamburgers.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/animsition/css/animsition.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/select2/select2.min.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/daterangepicker/daterangepicker.css/">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/css/util.css/">
    <link rel="stylesheet" type="text/css" href="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/css/main.css/">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/images/bg-01.jpg');">
        <div class="wrap-login101">
            <form method="<?=\Core\controller::$data['auth_method']?>" class="login100-form validate-form">
					<span class="login100-form-logo" style="background-color: transparent;height: 0px">
						<img src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/images/witcher-logo.png" alt="" class="witcherLogoImg_101">
					</span>

                <span class="login101-form-title p-b-34 p-t-27">
                    <h1 class="login100-form-title">Welcome To Witcher</h1>
                    <h1 class="login100-form-title">LoGiN via <i><b>API KEY</b></i> Please</h1>
						<b style="color: #fff700;font-size: 25px;"><?=\Model\message::msg_box_session_show()?></b>
					</span>
                <input type="hidden" name="token" value="<?=\Core\tokenCSRF::get_token()?>" >
                <div class="wrap-input100 validate-input" data-validate = "Enter api">
                    <input class="input101" type="text" name="login" placeholder="API KEY" autocomplete="on" style="text-align: center">
                </div>

                <div class="container-login100-form-btn">
                    <button class="login101-form-btn">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/jquery/jquery-3.2.1.min.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/animsition/js/animsition.min.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/bootstrap/js/popper.js/"></script>
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/bootstrap/js/bootstrap.min.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/select2/select2.min.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/daterangepicker/moment.min.js/"></script>
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/daterangepicker/daterangepicker.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/vendor/countdowntime/countdowntime.js/"></script>
<!--===============================================================================================-->
<script src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/js/main.js/"></script>

</body>
</html>