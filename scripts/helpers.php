<?php

function redirect(string $url, int $status = 303): void
{
  header("Location: $url", true, $status);
  die();
}
