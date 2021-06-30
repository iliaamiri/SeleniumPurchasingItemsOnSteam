<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \Core\controller::$page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?= HTTP_SERVER ?>/WitcherAssets/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <link rel="stylesheet" href="<?= HTTP_SERVER ?>/WitcherAssets/css/main.css">
    <!-- MDBootstrap Datatables  -->
    <link href="<?= HTTP_SERVER ?>/WitcherAssets/MDB/css/addons/datatables.min.css" rel="stylesheet">

    <script>
        <?php
        if (\Core\controller::$data['LoginFailedCheck']) {
            echo 'alert("' . \Core\controller::$data['LoginFailedError'] . '");';
        }
        ?>
    </script>
</head>
<body>
<div class="container-fluid" style="color: white">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <!-- Modal -->
            <div class="modal fade show" id="myModal"
                 role="dialog"
                 style="display: block;background-color:rgba(0,0,0,0.8);">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" style="background-color: #000000;
background-image: linear-gradient(147deg, #000000 0%, #04619f 74%);!important; border: 2px solid white!important; border-radius: 30px; padding: 60px;
margin-top:200px;">
                        <div class="modal-header" style="border: none">
                        </div>
                        <div class="modal-body" style="border: none;">
                            <div class="form-group" style="text-align: center">
                                <label for="exampleFormControlInput1" style="color: white"><h3><i style="color: white" class="far fa-exclamation-circle"></i></h3></label>

                                <p style="margin-top: 20px;font-size: 30px;"><b>Test has been cancelled.</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="<?= HTTP_SERVER ?>/WitcherAssets/MDB/js/addons/datatables.min.js"></script>
</body>
</html>