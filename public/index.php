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
$router->get('/exercises/answering', [$exercise, 'takeAnExercise']);

# "Create an exercise" page
$router->get('/exercises/new', [$views, 'createAnExercise']);

# "Manage an exercise" page
$router->get('/exercises', [$exercise, 'exercisesPage']);

###############
# OTHER PAGES #
###############

# Answer an exercise (new answer)
$router->get('/exercises/{exerciseId}/fulfillments/new', [$exercise, 'answerExercisePage']);

# Answer an exercise (edit answer)
$router->get('/exercises/{exerciseId}/fulfillments/{testId}/edit', [$exercise, 'editAnswerPage']);

# Access 1 exercise result
$router->get('/exercises/{exerciseId}/fulfillments/{testId}', [$exercise, 'showAnswerPage']);

# Access all exercise results
$router->get('/exercises/{exerciseId}/results', [$exercise, 'showAnswersAllPage']);

# Access exercise results (per question)
$router->get('/exercises/{exerciseId}/results/{fieldId}', [$exercise, 'showAnswersFieldPage']);

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
$router->patch('/exercises/{exerciseId}/fulfillments/{testId}', [$exercise, 'editAnswer']);

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
