<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \Core\controller::$page_title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

    input{
        color: #00C2D0!important;
    }

    input:focus{
        color: black!important;
    }
</style>

<body>
<div class="container">
    <form>
        <h1 style="color: #58a6ff">Steam Surfer Bot Panel</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="FormInputLink">URL - Link *</label>
                    <input type="text" class="form-control" id="FormInputLink" placeholder="Link">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="FormInputAccountName">Account Name *</label>
                    <input type="text" class="form-control" id="FormInputAccountName"
                           placeholder="Your Account Name">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="FormInputPassword">Password *</label>
                    <input type="text" class="form-control" id="FormInputPassword" placeholder="Your Password">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"></label>
                    <a href="<?=HTTP_SERVER?>/auth_credentials/manage" class="btn btn-primary form-control">Manage</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntMaximumPurchases" title="Maximum Purchases of Founded Items *">Maximum Purchases of Founded Items *</label>
                    <input type="number" class="form-control" id="FormInputIntMaximumPurchases" placeholder=">= 1">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntFloatMin">Float - Minimum *</label>
                    <input type="number" step="0.01" class="form-control" id="FormInputIntFloatMin" placeholder="Minimum">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormInputIntFloatMax">Float - Maximum *</label>
                    <input type="number" step="0.01" class="form-control" id="FormInputIntFloatMax" placeholder="Maximum">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputInt">Refresh in (Optional)</label>
                    <input type="number" class="form-control" id="FormInputRefreshIn" placeholder="In Seconds">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputIntPaintSeed">Paint Seed (Optional)</label>
                    <input type="text" class="form-control" id="FormControlInputIntPaintSeed" placeholder="Plaint Seed">
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary btn-lg" id="FormButtonRunIt">Run It</a>
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
<script>
    $('#FormButtonRunIt').click(function () {
        event.preventDefault();

        $.post( "/selenium/initiate", {
            link: $('#FormInputLink').val(),
            account_name: $('#FormInputAccountName').val(),
            password: $('#FormInputPassword').val(),
            maximum_purchases_of_founded_items: $('#FormInputIntMaximumPurchases').val(),
            float_min: $('#FormInputIntFloatMin').val(),
            float_max: $('#FormInputIntFloatMax').val(),
            paint_seed: $('#FormControlInputIntPaintSeed').val(),
            refresh_in: $('#FormInputRefreshIn').val()
        }, function( data ) {
            var result = jQuery.parseJSON( data );
            if (result.status){
                alert("Done");
                location.reload();
            }else{
                alert("Inputs contain invalid characters");
                location.reload();
            }
        });
    });
</script>
</body>
</html>