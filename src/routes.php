<?php

# Home Controller
$app->get('/', 'TicketManager\Controllers\HomeController:index');

# Tickets Controller
$app->get('/tickets', 'TicketManager\Controllers\TicketsController:index');
$app->get('/tickets/archived', 'TicketManager\Controllers\TicketsController:archived');
$app->get('/tickets/{id}', 'TicketManager\Controllers\TicketsController:detail');

$app->get('/tickets/{id}/save', 'TicketManager\Controllers\TicketsController:create');
$app->post('/tickets/{id}/save', 'TicketManager\Controllers\TicketsController:save');

$app->get('/tickets/{id}/remove', 'TicketManager\Controllers\TicketsController:delete');
$app->get('/tickets/{id}/done', 'TicketManager\Controllers\TicketsController:done');
