<?php
    class Sprint extends Model{
        public static $primary_key = "sprint_id";
        public static $table = "sprints";
        public static $fields = ["sprint_goal", "sprint_time", "sprint_start_date", "sprint_end_date", "backlog_id"];
    }
?>