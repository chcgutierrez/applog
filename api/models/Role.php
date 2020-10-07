<?php
    class Role extends Model{
        public static $primary_key = "role_id";
        public static $table = "roles";
        public static $fields = ["role_name"];
    }
?>