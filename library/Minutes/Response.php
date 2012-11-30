<?php
namespace Minutes;
class Response
{
    private $headers;
    private $body;
    
    public function __construct() {
        $this->setHeader('Content-type:', 'text/html;charset=UTF-8');
    }


    public function setHeader($headerName, $headerValue) {
        $this->headers[trim($headerName)] = $headerValue;
    }

    public function setBody($body) {
        $this->body = $body;
    }
    
    public function send() {
        if (is_array($this->headers)) {
            if (!headers_sent()) {
                foreach ($this->headers as $name => $value) {
                    $header = $name . ' ' . $value;
                    header($header);
                }
            } else {
                throw new \Exception('Headers already sent!');
            }
        }
        echo $this->body;
    }
}
