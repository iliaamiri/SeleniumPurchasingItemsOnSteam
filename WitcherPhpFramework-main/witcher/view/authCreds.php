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
        <h1 style="color: #58a6ff"><a href="../">Steam Surfer Bot Panel</a>/Auth Credentials Management</h1>
        <div class="row">
            <div class="col-md-1">
                <label for="exampleFormControlInput1">Id</label>
                <div class="form-group"><h3 style="color: #b0cdd0">#1</h3>
                </div>
                <div class="form-group"><h3 style="color: #b0cdd0">#2</h3>
                </div>
            </div>
            <div class="col-md-5">
                <label for="exampleFormControlInput1">Account Name *</label>
                <div class="form-group"><input type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="Account Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                           placeholder="Account Name">
                </div>
            </div>
            <div class="col-md-5">
                <label for="exampleFormControlInput1">Password *</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Password">
                </div>
            </div>
            <div class="col-md-1">
                <label for="exampleFormControlInput1"><i class="fas "></i></label>
                <div class="form-group">
                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </div>
                <div class="form-group">
                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Save</button>
        <hr>
        <h1 style="color: #58a6ff">Add a New:</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Account Name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Account Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your Password"
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Add</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>