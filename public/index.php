<?php

use App\Core\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router();

$router->get('/', function () {
    echo "home";
});

# "Take an exercise" page
$router->get('/exercises/answering', function () {
    echo "Take an exercise page (GET)";
});

# "Create an exercise" page
$router->get('/exercises/new', function () {
    echo "Create an exercise (GET)";
});

# Create an exercise
$router->post('/exercises', function () {
    echo "Create an exercise (POST)";
});

# "Manage an exercise" page
$router->get('/exercises', function () {
    echo "Manage an exercise page (GET)";
});

# Update an exercise (status for example)
$router->put('/exercises/{exerciseId}', function ($exerciseId) {
    echo "Update an exercise (status for example) (PUT)";
});
# Delete an exercise
$router->delete('/exercises/{exerciseId}', function ($exerciseId) {
    echo "Delete an exercise (DELETE)";
});

# Answer an exercise (new answer)
$router->get('/exercises/{exerciseId}/fulfillments/new', function ($exerciseId) {
    echo "Answer an exercise (new answer) (GET)";
});
$router->post('/exercises/{exerciseId}/fulfillments', function ($exerciseId) {
    echo "Answer an exercise (new answer) (POST)";
});

# Answer an exercise (edit answer)
$router->get('/exercises/{exerciseId}/fulfillments/{answerId}/edit', function ($exerciseId, $answerId) {
    echo "Answer an exercise (edit answer) (GET)";
});
$router->patch('/exercises/{exerciseId}/fulfillments/{answerId}', function ($exerciseId, $answerId) {
    echo "Answer an exercise (edit answer) (PATCH)";
});

# Access an exercise result
$router->get('/exercises/{exerciseId}/fulfillments/{answerId}', function ($exerciseId, $answerId) {
    echo "Access an exercise result (GET)";
});

# Access exercise results
$router->get('/exercises/{exerciseId}/results', function ($exerciseId) {
    echo "Access exercise results (GET)";
});

# Access exercise results (per question)
$router->get('/exercises/{exerciseId}/results/{fieldId}', function ($exerciseId, $fieldId) {
    echo "Access exercise results (GET)";
});

# Edit an exercise page (GET) / Create exercise fields (POST)
$router->get('/exercises/{exerciseId}/fields', function ($exerciseId) {
    echo "Edit an exercise page (GET)";
});
$router->post('/exercises/{exerciseId}/fields', function ($exerciseId) {
    echo "Create exercise fields (POST)";
});

# If no route matches, show a 404 error
if (!$router->routeMatched()) {
    $router->noMatch();
}
