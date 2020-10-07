<?php
    class Backlog extends Model{
        public static $primary_key = "backlog_id";
        public static $table = "backlogs";
        public static $fields = ["backlog_name", "user_id"];
    }
?>