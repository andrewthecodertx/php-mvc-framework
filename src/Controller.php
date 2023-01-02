<?php namespace Framework;

abstract class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct()
    {
        $this->request = App::load()->request();
        $this->response = App::load()->response();
    }

    public function view(string $view, array $data = [])
    {
        return new View($view, $data);
    }
}