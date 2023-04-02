<?php
require_once '../../vendor/autoload.php';
require_once '../asset/Templates/header.php';

use App\Models\Alerts\ErrorManager;
use App\Models\Print\PrintInputError;

?>
<div class="alert alert-primary" role="alert">
  A simple primary alert—check it out!
</div>
    <main>
        <form class="row g-3" action="../Controllers/NewUserController.php" method="post">

            <div class="col-12">
                <label for="user-name" class="form-label">Username</label>
                <input type="text" name="loginName" class="form-control" id="user-name" placeholder="Enter Username">
                <?php
                    PrintInputError::print('loginName');
                ?>
            </div>

            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="emailAddress" class="form-control" id="inputEmail4">
                <?php PrintInputError::print('emailAddress'); ?>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
                <?php
                    PrintInputError::print('password');
                ?>
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password-verify</label>
                <input type="password" name="re-password" class="form-control" id="inputPassword4">
                <?php
                    PrintInputError::print('password');
                ?>
            </div>

         
            <div class="col-12">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign in">
            </div>
        </form>
    </main>
<?php
require_once '../asset/Templates/footer.php';
?>