<?php

use PHPUnit\Framework\TestCase;
use Framework\Http\Response;

class ResponseTest extends TestCase
{
  public function testSetAndGetStatus()
  {
    $response = new Response(['Content-Type' => 'text/html'], 'Welcome to the test!', 200);

    $this->assertEquals(200, $response->getStatus());
  }

  public function testSetAndGetContent()
  {
    $response = new Response();
    $response->setContent('Hello World');

    $this->assertEquals('Hello World', $response->getContent());
  }

  public function testAddAndGetHeaders()
  {
    $response = new Response();
    $response->addHeader('Content-Type', 'application/json');
    $response->addHeader('X-Auth-Token', 'xyz123');

    $this->assertEquals([
      'Content-Type' => 'application/json',
      'X-Auth-Token' => 'xyz123'
    ], $response->getHeaders());
  }

  public function testSend()
  {
    $this->markTestIncomplete('not implemented yet');
  }


  public function testRedirect()
  {
    $this->markTestIncomplete('not implemented yet');
  }
}
