<?php namespace TicketManager\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController {

    public function index(Request $request, Response $response) {
        return $response->withRedirect('/tickets');
    }
}