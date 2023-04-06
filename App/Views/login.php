<?php
require_once '../../vendor/autoload.php';
require_once '../asset/Templates/header.php';

use App\Models\Alerts\ErrorManager;
use App\Models\Print\PrintInputError;
use App\Models\Sessions\Session;

Session::startSession();
?>

    <main>
        <form class="row g-3" action="../Controllers/LoginController.php" method="post">

            <div class="col-6">
                <label for="user-name" class="form-label">Username</label>
                <input type="text" name="loginName" class="form-control" id="user-name" placeholder="Enter Username" required>
                <?php
                    PrintInputError::print('loginName');
                ?>
            </div>


            <div class="col-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4" required>
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