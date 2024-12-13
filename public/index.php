<?php

use App\Core\Router;
use App\Controllers\ExerciseController;
use App\Models\Database;
use App\Core\Model;

require_once __DIR__ . "/../vendor/autoload.php";

$router = new Router();
$exercise = new ExerciseController();

Model::$db = new Database();

$router->get('/', function () {
    require_once __DIR__ . "/../app/Views/home.php";
});

###################
# PRINCIPAL PAGES #
###################

# "Take an exercise" page
$router->get('/exercises/answering', [$exercise, 'takeAnExercise']);

# "Create an exercise" page
$router->get('/exercises/new', function () {
    require_once __DIR__ . "/../app/Views/createAnExercise.php";
});

# "Manage an exercise" page
$router->get('/exercises', [$exercise, 'exercisesPage']);

###############
# OTHER PAGES #
###############

# Answer an exercise (new answer)
$router->get('/exercises/{exerciseId}/fulfillments/new', [$exercise, 'answerExercisePage']);

# Answer an exercise (edit answer)
$router->get('/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit', [$exercise, 'editAnswerPage']);

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
$router->get('/exercises/{exerciseId}/fields', [$exercise, 'editExercisePage']);

# Edit a field
$router->get('/exercises/{exerciseId}/fields/{fieldId}/edit', [$exercise, 'editFieldPage']);

###########
# ACTIONS #
###########

# Create an exercise
$router->post('/exercises', [$exercise, 'exerciseCreation']);

# Update an exercise status
$router->put('/exercises/{exerciseId}', [$exercise, 'exerciseStatusAlteration']);

# Delete an exercise
$router->delete('/exercises/{exerciseId}', [$exercise, 'exerciseDelete']);

# Answer an exercise (new answer)
$router->post('/exercises/{exerciseId}/fulfillments', [$exercise, 'answer']);

# Answer an exercise (edit answer)
$router->patch('/exercises/{exerciseId}/fulfillments/{fulfillmentId}', [$exercise, 'editAnswer']);

# Create exercise fields
$router->post('/exercises/{exerciseId}/fields', [$exercise, 'addField']);

# Delete exercise field
$router->delete('/exercises/{exerciseId}/fields/{fieldId}', [$exercise, 'deleteField']);

# Update exercise field
$router->patch('/exercises/{exerciseId}/fields/{fieldId}', [$exercise, 'editField']);

# If no route matches, show a 404 error
if (!$router->routeMatched()) {
    $router->noMatch();
}
