<?php namespace Framework;

class Response
{
    public int $status;

    public function setStatus(int $code): void
    {
        $this->status = http_response_code($code);
    }
}