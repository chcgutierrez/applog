<?php
    abstract class Controller {
        abstract public function collection();
        abstract public function store($element);
        abstract public function show($id);
        abstract public function update($id, $element);
        abstract public function destroy($id);
    }
?>