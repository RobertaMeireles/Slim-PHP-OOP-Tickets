<?php namespace TicketManager\Controllers;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use TicketManager\Models\TicketRepository;

class TicketsController {

    private $db;
    private $view;

    public function __construct(Container $container) {
        $this->db = $container['db'];
        $this->view = $container['view'];
    }

    public function index(Request $request, Response $response) {
        $repository = new TicketRepository($this->db);
        $tickets = $repository->getPendent();
    
        return $this->view->render($response, 'tickets.phtml', ['tickets' => $tickets]);
    }

    public function archived(Request $request, Response $response) {
        $repository = new TicketRepository($this->db);
        $tickets = $repository->getArchived();
    
        return $this->view->render($response, 'tickets.phtml', ['tickets' => $tickets]);
    }

    public function done(Request $request, Response $response, array $args) {
        $repository = new TicketRepository($this->db);
        $repository->markAsDone($args['id']);
    
        return $response->withRedirect('/tickets');
    }

    public function detail(Request $request, Response $response, array $args) {
        $repository = new TicketRepository($this->db);
        $ticket = $repository->byId($args['id']);
    
        return $this->view->render($response, 'ticket.phtml', ['ticket' => $ticket]);
    }

    public function create(Request $request, Response $response, array $args) {
        return $this->view->render($response, 'form.phtml', []);
    }

    public function save(Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();
        $repository = new TicketRepository($this->db);
        $repository->create($data);
    
        return $response->withRedirect('/tickets');
    }

    public function delete(Request $request, Response $response, array $args) {
        $repository = new TicketRepository($this->db);
        $repository->delete($args['id']);
    
        return $response->withRedirect('/tickets');
    }
}