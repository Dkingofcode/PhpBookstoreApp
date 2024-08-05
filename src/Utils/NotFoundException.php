<?php
namespace Bookstore\Utils;

use Exception;

class NotFoundException extends Exception {
    public function __construct($message = null){
       $message = $message ?: 'Value Not FOund.';
       parent::__construct($message);
    }
}


















?>