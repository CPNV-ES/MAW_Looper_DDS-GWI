<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercises/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once "components/head.php";
?>
    <!-- ToDo ajust y spacing between elements also remove spacing when empty -->
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl"><?=$answers[array_key_first($answers)]->test->timestamp->format('Y-m-d H:i:s e')?></h1>
    <?php foreach ($fields as $field) : ?>
        <div>
            <a class="font-bold"><?=$field->name?></a>
        </div>
        <!-- ToDo replace style with marging class -->
        <div style="margin-left: 40px">
            <a>
                <?php if ($answers != null && isset($answers[$field->id])) {
                    echo $answers[$field->id]->answer;
                } ?>
            </a>
        </div>
    <?php endforeach; ?>
    </div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";