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
                    <label for="exampleFormControlInput1">URL - Link *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Link">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Account Name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="Your Account Name">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Password">
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
                    <label for="FormControlInputInt" title="Maximum Purchases of Founded Items *">Maximum Purchases of Founded Items *</label>
                    <input type="number" class="form-control" id="FormControlInputInt" placeholder=">= 1">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputIntFloatMin">Float - Minimum *</label>
                    <input type="number" step="0.01" class="form-control" id="FormControlInputIntFloatMin" placeholder="Minimum">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <label for="FormControlInputIntFloatMax">Float - Maximum *</label>
                    <input type="number" step="0.01" class="form-control" id="FormControlInputIntFloatMax" placeholder="Maximum">
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
        <button type="submit" class="btn btn-primary btn-lg">Run It</button>
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