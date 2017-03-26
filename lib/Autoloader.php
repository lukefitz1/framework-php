<?php

class Autoloader {

    private static $classes = array();

     public static function loader() {

         $root = new RecursiveDirectoryIterator(ROOT);

         foreach (new RecursiveIteratorIterator($root) as $file) {
             if ((substr($file, -4)) === '.php') {
                 if (preg_match("/[A-Z][a-zA-Z0-9]+_[Controller|Model|View)]+_[a-zA-Z0-9]+.php/", $file) == 1) {
                     Autoloader::$classes[$file->getFilename()] = $file;
                     //echo 'Filepath: ' . $file . '<br />';
                     Autoloader::getClass(file_get_contents($file));
                     require_once $file;
                 }
             }
         }

         Autoloader::loadLibModulesArray();
         Autoloader::loadAppModulesArray();
     }

    public static function getClassesArray() {
        return Autoloader::$classes;
    }

    public static function loadLibModulesArray() {
        $x = glob(LIB . '*', GLOB_ONLYDIR);

        for ($i = 0; $i<(count($x)); $i++) {
            //echo 'LIB Module Name: ' . basename($x[$i]) . '<br />';
        }
    }

   public static function loadAppModulesArray() {
       $x = glob(APP . '*', GLOB_ONLYDIR);

       for ($i = 0; $i<(count($x)); $i++) {
           //echo 'APP Module Name: ' . basename($x[$i]) . '<br />';
       }
   }

   public static function getClass($contents) {
       $tokens = token_get_all($contents);

       for ($i = 2; $i < count($tokens); $i ++) {
           if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
               $className = $tokens[$i][1];

               if (preg_match("/[A-Z][a-zA-Z0-9]+_[Controller|Model|View)]+_[a-zA-Z0-9]/", $className) == 1) {
                   echo 'Classname: ' . $className . '<br />';
               }
           }
       }
   }

}

spl_autoload_register(array('Autoloader', 'loader'));