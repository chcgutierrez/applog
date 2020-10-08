<?php
    class BacklogItem extends Model{
        public static $primary_key = "backlog_item_id";
        public static $table = "backlog_items";
        public static $fields = ["backlog_item_name", "backlog_item_description", "backlog_item_effort", "backlog_id"];
    }
?>