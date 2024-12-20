<?php

use App\Controllers\AnswerController;
use App\Controllers\FieldController;
use App\Core\Router;
use App\Controllers\ExerciseController;
use App\Models\Database;
use App\Core\Model;

require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router();
$exercise = new ExerciseController();
$answer = new AnswerController();
$field = new FieldController();

Model::$db = new Database();

$router->get('/', function () {
    require_once __DIR__ . "/../app/Views/home.php";
});

###################
# PRINCIPAL PAGES #
###################

# "Take an exercise" page
$router->get('/exercises/answering', [$exercise, 'show']);

# "Create an exercise" page
$router->get('/exercises/new', [$exercise, 'create']);

# "Manage an exercise" page
$router->get('/exercises', [$exercise, 'showManage']);

###############
# OTHER PAGES #
###############

# Answer an exercise (new answer)
$router->get('/exercises/{exerciseId}/fulfillments/new', [$answer, 'create']);

# Answer an exercise (edit answer)
$router->get('/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit', [$answer, 'edit']);

# Access 1 fulfillment results
$router->get('/exercises/{exerciseId}/fulfillments/{fulfillmentId}', [$answer, 'showByFulfillment']);

# Access all exercise results
$router->get('/exercises/{exerciseId}/results', [$answer, 'show']);

# Access exercise results (per question)
$router->get('/exercises/{exerciseId}/results/{fieldId}', [$answer, 'showByField']);

# Edit an exercise
$router->get('/exercises/{exerciseId}/fields', [$exercise, 'edit']);

# Edit a field
$router->get('/exercises/{exerciseId}/fields/{fieldId}/edit', [$field, 'edit']);

###########
# ACTIONS #
###########

# Create an exercise
$router->post('/exercises', [$exercise, 'publish']);

# Update an exercise status
$router->put('/exercises/{exerciseId}', [$exercise, 'update']);

# Delete an exercise
$router->delete('/exercises/{exerciseId}', [$exercise, 'delete']);

# Answer an exercise (new answer)
$router->post('/exercises/{exerciseId}/fulfillments', [$answer, 'publish']);

# Answer an exercise (edit answer)
$router->patch('/exercises/{exerciseId}/fulfillments/{fulfillmentId}', [$answer, 'update']);

# Create exercise fields
$router->post('/exercises/{exerciseId}/fields', [$field, 'publish']);

# Delete exercise field
$router->delete('/exercises/{exerciseId}/fields/{fieldId}', [$field, 'delete']);

# Update exercise field
$router->patch('/exercises/{exerciseId}/fields/{fieldId}', [$field, 'update']);

# If no route matches, show a 404 error
if (!$router->routeMatched()) {
    $router->noMatch();
}
