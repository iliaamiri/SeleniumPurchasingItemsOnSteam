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
        <div class="wrap-login100">
            <form method="<?=\Core\controller::$data['auth_method']?>" class="login100-form validate-form">
					<span class="login100-form-logo" style="background-color: transparent">
						<img src="<?=HTTPS_SERVER?>/witcherAssets/login-forms/login1/images/witcher-logo.png" alt="">
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						<b><?=\Model\Message::msg_box_session_show()?></b>
					</span>
                <input type="hidden" name="token" value="<?=\Core\tokenCSRF::get_token()?>" >
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text" name="login" placeholder="Username" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" href="#">
                        Forgot Password?
                    </a>
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