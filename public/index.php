<?php

use App\Core\Router;
use App\Controllers\Views;
use App\Controllers\ExerciseController;

require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router();
$views = new Views();
$exercise = new ExerciseController();

$router->get('/', [$views, 'home']);

###################
# PRINCIPAL PAGES #
###################

# "Take an exercise" page
$router->get('/exercises/answering', [$views, 'takeAnExercise']);

# "Create an exercise" page
$router->get('/exercises/new', [$views, 'createAnExercise']);

# "Manage an exercise" page
$router->get('/exercises', [$views, 'manageExercises']);

###############
# OTHER PAGES #
###############

# Answer an exercise (new answer)
$router->get('/exercises/{exerciseId}/fulfillments/new', function ($exerciseId) {
    echo "Answer an exercise (new answer) (GET)";
});

# Answer an exercise (edit answer)
$router->get('/exercises/{exerciseId}/fulfillments/{answerId}/edit', function ($exerciseId, $answerId) {
    echo "Answer an exercise (edit answer) (GET)";
});

# Access 1 exercise result
$router->get('/exercises/{exerciseId}/fulfillments/{answerId}', function ($exerciseId, $answerId) {
    echo "Access an exercise result (GET)";
});

# Access all exercise results
$router->get('/exercises/{exerciseId}/results', function ($exerciseId) {
    echo "Access exercise results (GET)";
});

# Access exercise results (per question)
$router->get('/exercises/{exerciseId}/results/{fieldId}', function ($exerciseId, $fieldId) {
    echo "Access exercise results (GET)";
});

# Edit an exercise
$router->get('/exercises/{exerciseId}/fields', [$exercise, 'editExercise']);

###########
# ACTIONS #
###########

# Create an exercise
$router->post('/exercises', function () {
    echo "Create an exercise (POST)";
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
$router->post('/exercises/{exerciseId}/fulfillments', function ($exerciseId) {
    echo "Answer an exercise (new answer) (POST)";
});

# Answer an exercise (edit answer)
$router->patch('/exercises/{exerciseId}/fulfillments/{answerId}', function ($exerciseId, $answerId) {
    echo "Answer an exercise (edit answer) (PATCH)";
});

# Create exercise fields
$router->post('/exercises/{exerciseId}/fields', [$exercise, 'addField']);

# Delete exercise field
$router->delete('/exercises/{exerciseId}/fields/{fieldId}', [$exercise, 'deleteField']);

# If no route matches, show a 404 error
if (!$router->routeMatched()) {
    $router->noMatch();
}
