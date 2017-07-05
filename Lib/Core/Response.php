<?php
namespace Lib\Core;

class Response {

    protected $content = null;
    protected $httpcode = 200;

    public function setContent($content)
    {
        $this->content = (string) $content;


    }
    public function setHttpResponseCode($code)
    {
        $this->httpcode = $code;


    }

    public function getHttpResponseCode ()
    {


        return http_response_code($this->httpcode);
    }

    public function getContent()
    {
        $this->getHttpResponseCode();
        echo $this->content;
    }

}

?>
