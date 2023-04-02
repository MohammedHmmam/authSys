<?php
namespace App\Models\Print;

use App\Models\Alerts\ErrorManager;

class PrintInputError implements IHtmlPrint{

    /*
    
    this class has a responsibility for
     print The Errors's Messages in html under each imput field have an error
    
    */


    public function __construct()
    {
        
    }

    //Print error Message unser input field
    public static function print($item)
    {
        //$item parameter = the input field NAme for example: piegonName, pigeonsGender ..etc
        if(isset(ErrorManager::showErrors()[$item])){
            ?>
                <div class="errors">
                 <?php       
                    foreach(ErrorManager::showErrors()[$item] as $key => $value ){
                        ?>
                            
                            <div class="alert alert-danger" role="alert">
                                    <?php echo $value;?>
                            </div>
                        <?php
                    }
                 ?>   
                </div>
            <?php
        }
    }


}

?>