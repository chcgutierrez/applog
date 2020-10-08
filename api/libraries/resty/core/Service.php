<?php
    class Service{
        private static $resources;
        private static $url;
        private static $method;
        private static $resource;
        private static $document;
        private static $body;
        private static $response;
        public static function use($path, $resource) {
            self::$resources[$path] = $resource;
        }
        public static function listen(){
            self::$url = $_GET['url'] != '/' ? explode('/', trim($_GET['url'], '/')) : null;
            self::$method = $_SERVER['REQUEST_METHOD'];
            self::$resource = isset(self::$url[0]) ? self::$url[0] : null;
            self::$document = isset(self::$url[1]) ? self::$url[1] : null;
            self::$body = json_decode(file_get_contents('php://input'));
            if($_GET["url"] != "/") {
                if(array_key_exists(self::$resource, self::$resources)){
                    if(is_subclass_of(self::$resources[self::$resource], Controller::class)){
                        $controller = new self::$resources[self::$resource]();
                        if(!is_null(self::$document)){
                            switch (self::$method) {
                                case "GET":
                                    self::$response = $controller->show(self::$document);
                                    break;
                                case "PUT":
                                    self::$response = $controller->update(self::$document, self::$body);
                                    break;
                                case "DELETE":
                                    self::$response = $controller->destroy(self::$document);
                                    break;
                                default:
                                    echo "method not supported response";
                                    break;
                            }
                        }else{
                            switch (self::$method) {
                                case "GET":
                                    self::$response = $controller->collection();
                                    break;
                                case "POST":
                                    self::$response = $controller->store(self::$body);
                                    break;
                                default:
                                    echo "method not supported response";
                                    break;
                            }
                        }
                    }else{
                        echo "is not a controller object response";
                    }
                }else{
                    echo "resource not exists response";
                }
            }else{
                echo "home";
            }
            echo is_array(self::$response) ? json_encode(self::$response) : self::$response;
            // echo json_encode(self::$response) : self::$response;
        }
    }
?>