<?php

declare(strict_types=1);

namespace Framework;

class Response
{
    public function setStatus(int $code): void
    {
        http_response_code($code);
    }

    public function status(): int
    {
        return http_response_code();
    }
}
