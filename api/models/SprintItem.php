<?php
    class SprintItem extends Model{
        public static $primary_key = "sprint_item_id";
        public static $table = "sprint_items";
        public static $fields = ["backlog_item_id", "status_id", "sprint_id"];
    }
?>