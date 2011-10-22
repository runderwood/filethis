<?php
class Filethis_Handler_Main extends Filethis_Handler {
    public function get() {
        header('Content-Type: application/xml');
        $response = <<<EREIAM
<?xml version="1.0" encoding="UTF-8"?>
    <Response>
        <Say>Hello, Monkey.</Say>
    </Response>
EREIAM;
    }

    public function post() {

    }
}
