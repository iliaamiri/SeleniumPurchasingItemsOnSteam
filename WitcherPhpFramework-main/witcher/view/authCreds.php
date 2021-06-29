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
</head>

<body>
<div class="container">
    <form>
        <h1 style="color: #58a6ff"><a href="../">Steam Surfer Bot Panel</a>/Auth Credentials Management</h1>
        <div class="row">
            <?php
            $AuthCreds = \Core\controller::$data['AuthCreds'];

            if ($AuthCreds){
            ?>
            <div class="col-md-1">
                <label for="exampleFormControlInput1">Id</label>
                <?php foreach ($AuthCreds as $authCredKey => $authCred){?>
                <div class="form-group"><h3 style="color: #b0cdd0">#<?=$authCredKey + 1?></h3>
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1">Account Name *</label>
                <?php foreach ($AuthCreds as $authCred){?>
                <div class="form-group"><input type="text" value="<?=$authCred['account_name']?>" class="form-control" id="FormInputAccountName<?=$authCred['id']?>"
                           placeholder="Account Name">
                </div>
                <?php } ?>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1">Password *</label>
                <?php foreach ($AuthCreds as $authCred){?>
                <div class="form-group">
                    <input type="text" value="<?=$authCred['password']?>" class="form-control" id="FormInputPassword<?=$authCred['id']?>" placeholder="Your Password">
                </div>
                <?php } ?>
            </div>
                <div class="col-md-1">
                    <label for="exampleFormControlInput1"><i class="fas "></i></label>
                    <?php foreach ($AuthCreds as $authCred){?>
                        <div class="form-group">
                            <a href="<?=$authCred['id']?>" class="btn btn-primary FormButtonSave">Save</a>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-1">
                    <label for="exampleFormControlInput1"><i class="fas "></i></label>
                    <?php foreach ($AuthCreds as $authCred){?>
                        <div class="form-group">
                            <a href="<?=HTTP_SERVER?>/auth_credentials/manage/makeDefault/<?=$authCred['id']?>" class="btn <?php if ($authCred['default_status'] == 1){echo "disabled";}else{echo "btn-dark";}?>">Default</a>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-1">
                    <label for="exampleFormControlInput1"><i class="fas "></i></label>
                    <?php foreach ($AuthCreds as $authCred){?>
                        <div class="form-group">
                            <a href="<?=HTTP_SERVER?>/auth_credentials/manage/delete/<?=$authCred['id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <hr>
        <h1 style="color: #58a6ff">Add a New:</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="FormInputNewAccountName">Account Name *</label>
                    <input type="text" class="form-control" id="FormInputNewAccountName" placeholder="Account Name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="FormInputNewPassword">Password *</label>
                    <input type="text" class="form-control" id="FormInputNewPassword" placeholder="Your Password" required>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary btn-lg" id="FormButtonAdd">Add</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script>
    $('.FormButtonSave').click(function () {
        event.preventDefault();

        $.post( "/auth_credentials/manage/update", {id: $(this).attr('href'), account_name: $('#FormInputAccountName' + $(this).attr('href')).val(), password: $('#FormInputPassword' + $(this).attr('href')).val()}, function( data ) {
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
        $('.btn-danger').click(function() {
            return window.confirm("Are you sure?");
        });
    if (location.hash == "#done"){
        alert("Done");
    }

    $('#FormButtonAdd').click(function () {
        event.preventDefault();

        $.post( "/auth_credentials/manage/add", {account_name: $('#FormInputNewAccountName').val(), password: $('#FormInputNewPassword').val()}, function( data ) {
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