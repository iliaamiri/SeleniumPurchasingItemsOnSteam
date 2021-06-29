<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \Core\controller::$page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?=HTTP_SERVER?>/WitcherAssets/fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"> <!--load all styles -->
</head>
<style>
    body {
        background-color: #1b1f23;
    }

    .form-control {
        background-color: #1b2838;
    }

    label {
        color: #00B5D0;
    }

    input {
        color: #00C2D0 !important;
    }

    input:focus {
        color: black !important;
    }
</style>

<body>
<div class="container-fluid" style="color: white">
    <div class="row" style="margin-top: 20px">
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
                                        <td>asdfjl;kad</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Password:</b></td>
                                        <td>password</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Maximum Purchases of Founded Items:</b></td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Float - Minimum:</b></td>
                                        <td>0.00000001</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Float - Maximum:</b></td>
                                        <td>0.0000005</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Refresh in:</b></td>
                                        <td>60 seconds</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #17a2b8;"><b>Paint Seed:</b></td>
                                        <td>300</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <a href="<?= HTTP_SERVER ?>/selenium/cancel/{@id}" class="btn btn-lg btn-danger"
               style="width: 100%;border-radius: 200px">Cancel</a>
        </div>
        <div class="col-md-9">
            <div class="row" >
                <div class="col-md-6 justify-content-md-center text-center"><h1 style="border:1px solid white;border-radius: 200px;">Refresh In: 00:60</h1></div>
                <div class="col-md-6 justify-content-md-center text-center"><h1 style="border:1px solid white;border-radius: 200px;">Processed 1000 out of 4000 items</h1>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 justify-content-md-center">
                    <h2 style="text-align: center;color: #28a745; border:1px solid #28a745;border-radius: 200px;"><i style="color: white" class="fas fa-angle-double-down"></i> Items that are Found and Purchased <i style="color: white" class="fas fa-angle-double-down"></i></h2>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Float</th>
                        <th scope="col">Paint Seed</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>0.93972074985504</td>
                        <td>181</td>
                        <td>₹ 2.25</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>0.70411992073059</td>
                        <td>485</td>
                        <td>₹ 2.35</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>0.81528592109680</td>
                        <td>866</td>
                        <td>₹ 2.36</td>
                    </tr>
                    </tbody>
                </table>
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
</script>
</body>
</html>