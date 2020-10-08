<?php
    header("Content-Type: application/json");
    define("APP_DIR", __DIR__);
    define("LIBRARIES_DIR", APP_DIR."/libraries");
    define("RESTY_DIR", LIBRARIES_DIR."/resty");
    define("ENVY_DIR", LIBRARIES_DIR."/envy");
    spl_autoload_register(function ($class_name) {
        $directories = [
            RESTY_DIR."/",
            ENVY_DIR."/",
            RESTY_DIR."/core/",
            APP_DIR."/controllers/",
            APP_DIR."/models/"
        ];
        foreach ($directories as $directory) {
            if(file_exists($directory.$class_name.".php")){
                require_once($directory.$class_name.".php");
                return;
            }
        }
    });
    Envy::load(APP_DIR, "/");
    Service::use("roles", RoleController::class);
    Service::use("status", StatusController::class);
    Service::use("users", UserController::class);
    Service::use("backlogs", BacklogController::class);
    Service::use("backlog-items", BacklogItemController::class);
    Service::use("sprints", SprintController::class);
    Service::use("sprint-items", BacklogItemController::class);
    Service::listen();
    function response($data = null, $code = 200){
        http_response_code($code);
        return $data;
    }
    function validate($model, $array){
        $errors = array();
        foreach ($model::$fields as $key) {
            if(!array_key_exists($key, (array)$array)){
                $errors[$key] = $key." is required";
            }
        }
        if(!empty($errors)){
            throw new Exception(json_encode($errors));
        }
        return $model::$fields == array_keys((array)$array);
    }