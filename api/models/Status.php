<?php
    class Status extends Model{
        public static $primary_key = "status_id";
        public static $table = "status";
        public static $fields = ["status_name"];
    }
?>