<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercise/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once __DIR__ . "/../components/head.php";
?>
<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl"><?=$answers[array_key_first($answers)]->fulfillment->timestamp_fulfillment?></h1>
    <?php foreach ($fields as $field) : ?>
        <div>
            <a class="font-bold"><?=$field->name?></a>
        </div>
        <div style="margin-left: 40px">
            <a>
                <?php if (!empty($answers) && isset($answers[$field->id])) {
                    echo $answers[$field->id]->answer;
                } ?>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php
$pageContent = ob_get_clean();
require_once __DIR__ . "/../gabarit.php";