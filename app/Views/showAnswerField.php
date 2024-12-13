<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercises/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once "components/head.php";
?>
<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl"><?=$field->name?></h1>

        <table>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
            <?php foreach ($tests as $test) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <!-- ToDo deal with color of links -->
                            <a href="/exercises/<?=$exercise->id?>/fulfillments/<?=$test->id?>">
                                <?=$test->timestamp->format('Y-m-d H:i:s e')?>
                            </a>
                        </div>
                    </td>
                    <td>
                        <?php if (isset($tableAnswers[$test->id][$field->id])) : ?>
                            <div class="title">
                                <?=$tableAnswers[$test->id][$field->id]->answer?>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";