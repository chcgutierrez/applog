<?php
    class User extends Model{
        public static $primary_key = "user_id";
        public static $table = "users";
        public static $fields = ["user_email", "user_password", "role_id"];
    }
?>