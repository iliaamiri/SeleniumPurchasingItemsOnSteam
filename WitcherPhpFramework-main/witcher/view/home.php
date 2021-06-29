<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \Core\controller::$page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=HTTP_SERVER?>/WitcherAssets/css/main.css">
</head>

<body>
<div class="container">
    <form target="_blank" method="POST" action="<?=HTTP_SERVER?>/selenium/initiate">
        <h1 style="color: white">Steam Surfer Bot Panel</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="FormInputLink">URL - Link *</label>
                    <input type="text" class="form-control" name="link" id="FormInputLink" placeholder="Link" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="FormInputAccountName">Account Name *</label>
                    <input type="text" class="form-control" id="FormInputAccountName"
                           placeholder="Your Account Name" value="<?=\Core\controller::$data['DefaultAuthCreds']['account_name']?>" name="account_name" required>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="FormInputPassword">Password *</label>
                    <input type="text" class="form-control" value="<?=\Core\controller::$data['DefaultAuthCreds']['password']?>" name="password" id="FormInputPassword" placeholder="Your Password" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"></label>
                    <a href="<?=HTTP_SERVER?>/auth_credentials/manage" class="btn btn-primary form-control" style="border-radius: 200px;">Manage</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntMaximumPurchases" title="Maximum Purchases of Founded Items *">Maximum Purchases of Founded Items *</label>
                    <input type="number" class="form-control" name="maximum_purchases_of_founded_items" id="FormInputIntMaximumPurchases" placeholder=">= 1" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntFloatMin">Float - Minimum *</label>
                    <input type="text"  class="form-control" name="float_min" id="FormInputIntFloatMin" placeholder="Minimum" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntFloatMax">Float - Maximum *</label>
                    <input type="text"  class="form-control" name="float_max" id="FormInputIntFloatMax" placeholder="Maximum" required>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputInt">Refresh in (Optional)</label>
                    <input type="number" class="form-control" id="FormInputRefreshIn" name="refresh_in" placeholder="In Seconds" >
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputIntPaintSeed">Paint Seed (Optional)</label>
                    <input type="text" class="form-control" name="paint_seed" ="FormControlInputIntPaintSeed" placeholder="Plaint Seed">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-lg" id="FormButtonRunIt" value="Run It" style="color: white!important;padding: 7px 30px 7px 30px;">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>