<?php
ob_start();

$headColor = "green";


$exercisesBuilding = array_filter($exercises, function ($exercise) {
    return ($exercise->statusTitle == 'Building');
});

$exercisesAnswering = array_filter($exercises, function ($exercise) {
    return ($exercise->statusTitle == 'Answering');
});

$exercisesClosed = array_filter($exercises, function ($exercise) {
    return ($exercise->statusTitle == 'Closed');
});

require_once "components/head.php";
?>

<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Building</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php foreach ($exercisesBuilding as $exercise) : ?>
                <tr>
                    <?php
                    $title = $exercise->name;
                    $exerciseId = $exercise->id;
                    $ready = $exercise->numberFields;
                    require "components/manageExercise/cell-building.php"
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Answering</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php foreach ($exercisesAnswering as $exercise) : ?>
                <tr>
                    <?php
                    $title = $exercise->name;
                    $exerciseId = $exercise->id;
                        require "components/manageExercise/cell-answering.php"
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Closed</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php foreach ($exercisesClosed as $exercise) : ?>
                <tr>
                    <?php
                    $title = $exercise->name;
                    $exerciseId = $exercise->id;
                        require "components/manageExercise/cell-closed.php"
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";