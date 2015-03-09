<?php 
require_once 'libs/ErrorHandler.php';
//importing classes
function Autoloader ($class) {
    //class directories
    $directorys = array(
        'libs/',
        'controllers/',
        'models/'
    );
    //for each directory
    foreach($directorys as $directory)
    {
        //see if the file exsists
        if(file_exists($directory.$class . '.php'))
        {
            require_once($directory.$class . '.php');
            return;
        }            
    }
}
require_once 'libs/Twig/Autoloader.php';
require_once 'libs/PHPExcel.php';
require_once 'libs/RegressionLoader.php';
require_once 'libs/StatisticsLoader.php';

Twig_Autoloader::register();
spl_autoload_register("Autoloader");
?>