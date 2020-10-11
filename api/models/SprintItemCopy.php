<?php
    class SprintItemCopy extends Model{
        public static $primary_key = "sprint_item_id";
        public static $table = "sprint_items_copy";
        public static $fields = ["backlog_item_id", "status_id", "sprint_id", "item_display_order"];
    }
?>