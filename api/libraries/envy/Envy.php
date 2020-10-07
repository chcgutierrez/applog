<?php
    class Envy {
        public static function set(string $key, string $value) {
            $_ENV[$key] = $value;
            putenv($key."=".$value);
        }
        public static function get($key){
            return getenv($key);
        }
        public static function load($file_path, $file_name){
            $path = $file_path.$file_name.".env";
            if(file_exists($path)){
                $file = file($path);
                foreach ($file as $line) {
                    $variable = explode("=", $line);
                    $key = trim($variable[0]," \n\r");
                    $value = trim($variable[1]," \n\r");
                    self::set($key, $value);                    
                }
            }else{
                echo "no hay";
            }
        }
    }
?>