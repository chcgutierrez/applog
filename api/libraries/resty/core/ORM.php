<?php
    abstract class ORM extends Database{
        protected static $table;
        protected static $primary_key;
        protected static $fields;
        public abstract function getData();
        public function save(){
            // echo var_dump($this->getData());
            $query = "";
            $parameters = "";
            if(is_null($this->{static::$primary_key})){
                $values = join(",",static::$fields);
                $parameters = ":".join(",:",static::$fields);
                $query = "insert into ".static::$table."(".$values.") values (".$parameters.")";
            }else{
                foreach (static::$fields as $field) {
                    $parameters .= $field.'=:'.$field.',';
                }
                $parameters = trim($parameters, ",");
                $query = "update ".static::$table." set ".$parameters." where ".static::$primary_key." = ".$this->{static::$primary_key};
            }
            self::getConnection();
            $statement = self::$connection->prepare($query);
            foreach ($this->getData() as $field => &$value) {
                if($field != static::$primary_key){
                    $statement->bindParam(':'.$field, $value);
                }
            }
            if($statement->execute()){
                self::destroyConnection();
                return true;
            }else{
                return false;
            }
        }
        public static function all(){
            $results = array();
            $query = "select * from ".static::$table;
            $class = get_called_class();
            self::getConnection();
            $statement = self::$connection->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $i => $row) {
                $results[$i] = $row;
            }
            self::destroyConnection();
            return $results;
        }
        private static function where($field, $value){
            $results = array();
            $query = "select * from ".static::$table." where ".$field." = :".$field;
            $class = get_called_class();
            self::getConnection();
            $statement = self::$connection->prepare($query);
            $statement->bindParam(":".$field, $value);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $i => $row) {
                // $results[$i] = new $class($row);
                $results[$i] = $row;
            }
            self::destroyConnection();
            return $results;
        }
        public static function find($id){
            $elements = static::where(static::$primary_key, $id);
            return !empty($elements) ? $elements[0] : array();
        }
        public function delete(){
            $query = "delete from ".static::$table." where ".static::$primary_key." = ".$this->{static::$primary_key};
            self::getConnection();
            $statement = self::$connection->prepare($query);
            if($statement->execute()){
                self::destroyConnection();
                return true;
            }else{
                return false;
            }
        }
    }
?>