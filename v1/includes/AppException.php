<?php
class AppException extends Exception {
    public $message;
    public $status;
    function __construct($message, $status) {
    //   super();
        Exception::__construct();
        $this->message = $message;
        $this->status = $status;
    }
  }

  /** 404 NOT FOUND Exception. */
  
  class NotFoundException extends AppException {
    function __construct($message = "Not Found") {
      AppException::__construct($message, 404);
    }
  }
  
  /** 401 UNAUTHORIZED Exception. */
  
  class UnauthorizedException extends AppException {
    function __construct($message = "Unauthorized") {
        AppException::__construct($message, 401);
      }
  }
  
  /** 400 BAD REQUEST Exception. */
  
  class BadRequestException extends AppException {
    function __construct($message = "Bad Request") {
        AppException::__construct($message, 400);
      }
  }
  
  /** 403 BAD REQUEST Exception. */
  
  class ForbiddenException extends AppException {
    function __construct($message = "Bad Request") {
        AppException::__construct($message, 403);
      }
  }