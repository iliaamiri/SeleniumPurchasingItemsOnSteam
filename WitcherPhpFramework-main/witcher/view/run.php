<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \Core\controller::$page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?=HTTP_SERVER?>/WitcherAssets/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
    <link rel="stylesheet" href="<?=HTTP_SERVER?>/WitcherAssets/css/main.css">
    <script>
        <?php
        if (\Core\controller::$data['LoginFailedCheck']){
            echo 'alert("'. \Core\controller::$data['LoginFailedError'] .'");';
        }
        ?>
    </script>
</head>
<body>
<div class="container-fluid" style="color: white">
    <div class="row justify-content-center text-center" style="margin-top: 20px;">
        <div class="col-md-3">
            <div class="row justify-content-md-center">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <h4 class="panel-title text-center">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <h2 style="color: #17a2b8;border:1px solid white;padding:8px;border-radius: 200px;">
                                        Test Description</h2></a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in show">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Link:</b></td>
                                        <td>
                                            <a href="https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Redline%20%28Field-Tested%29"
                                               title="https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Redline%20%28Field-Tested%29" target="_blank">Click
                                                here</a></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Account Name:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->account_name?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Password:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->password?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Maximum Purchases of Founded Items:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->maximum_attempts_to_purchase?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Item's Name:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->item_name?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Float - Minimum:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->float_min?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Float - Maximum:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->float_max?></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Refresh in:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->refresh_in?> seconds</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Paint Seed:</b></td>
                                        <td><?=\Core\controller::$data['ThreadInfo']->paint_seed?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="row justify-content-center">
                <div class="col-auto justify-content-md-center">
                    <h3 style="text-align: center;color: white; border:1px solid white;border-radius: 200px;padding: 15px 20px 15px 20px;"><i style="color: white" class="fas fa-angle-double-down"></i><b> Items that are Found and Purchased </b><i style="color: white" class="fas fa-angle-double-down"></i></h3>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-8 ">
                    <table class="table justify-content-md-center text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Float</th>
                            <th scope="col">Paint Seed</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>0.93972074985504</td>
                            <td>181</td>
                            <td>₹ 2.25</td>
                            <td><i class="far fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>0.70411992073059</td>
                            <td>485</td>
                            <td>₹ 2.35</td>
                            <td><i class="far fa-check-circle"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>0.81528592109680</td>
                            <td>866</td>
                            <td>₹ 2.36</td>
                            <td><i class="far fa-check-circle"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <hr>
            <div class="row justify-content-md-center">
            <div class="col-auto justify-content-md-center text-center"><h1 style="font-size:20px;padding: 5px 20px 5px 20px;border:1px solid white;border-radius: 200px;">00:60</h1></div>

            </div>
            <div class="row justify-content-md-center" >
                <div class="col-auto justify-content-md-center text-center"><h1 style="font-size:17px;padding: 10px 20px 10px 20px;border:1px solid white;border-radius: 200px;">Processed 1000 out of 4000 items</h1>
                </div>
            </div>
            <a href="<?= HTTP_SERVER ?>/selenium/cancel/{@id}" class="btn btn-lg btn-danger"
               style="width: 30%;border-radius: 200px; border-color: #32383e; margin-bottom: 30px;">Cancel</a>
        </div>
    </div>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display: none">Open Modal</button>
    <!-- Modal -->
    <div class="modal fade  <?= (\Core\controller::$data['SteamGuardCheck']) ? "show" : ""?>" id="myModal" role="dialog" style="display: <?= (\Core\controller::$data['SteamGuardCheck']) ? "block" : "none"?>;background-color:rgba(0,0,0,0.8);">
        <div class="modal-dialog" >

            <!-- Modal content-->
            <div class="modal-content"style="background-color: #000000;
background-image: linear-gradient(147deg, #000000 0%, #04619f 74%);!important; border: 2px solid white!important; border-radius: 30px; padding: 60px;
margin-top:200px;">
                <div class="modal-header" style="border: none">
                </div>
                <div class="modal-body" style="border: none;">
                    <div class="form-group" style="text-align: center">
                        <label for="exampleFormControlInput1" style="color: white"><h3>Security Code</h3></label>
                        <input required autofocus type="text" name="AuthCode" class="form-control text-uppercase" id="exampleFormControlInput1" style="text-align: center; border-radius:200px; font-size: 20px;" value="">
                        <p style="margin-top: 20px;"><u>You have ONLY ONE CHANCE!</u></p>
                    </div>
                </div>
                <div class="modal-footer justify-content-md-center" style="border: none;">
                    <button type="button" id="ButtonAuthCodeSubmit" class="btn btn-light btn-lg" style="color:black;border-radius: 200px;padding: 5px 70px 5px 70px;">Submit</button>
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
<script>
    $('.btn-danger').click(function () {
        return window.confirm("Are you sure?");
    });

    $('#ButtonAuthCodeSubmit').click(function () {
        var InputValue = $('div[name="AuthCode"]').val();

        $.ajax({
            type: "POST",
            url: "<?=HTTP_SERVER?>/selenium/api/steam-guard-submit",
            data: {
                thread_id: <?=\Core\controller::$data['ThreadInfo']->thread_id?>,
                AuthCode: InputValue
            },
            success: function (resultData) {
console.log(resultData);
            },
            dataType: "json"
        });
    });

</script>
</body>
</html>