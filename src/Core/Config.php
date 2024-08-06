<?php
namespace Bookstore\Utils;
use Bookstore\Utils\NotFoundException;


class Config {
private $data;
private $instance = null;



public function __construct() {
$json = file_get_contents(__DIR__ . '/../../config/app.json');
$this->data = json_decode($json, true);
}
public function get($key) {
if (!isset($this->data[$key])) {
throw new NotFoundException("Key $key not in config.");
}
return $this->data[$key];
}

private function connect(){
   return {};
}

public function getInstance(){
    if (self::$instance == null) {
        self::$instance = self::connect();
        }
        return self::$instance;
 }        



 }