<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercise/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once __DIR__ . "/../components/head.php";
?>
<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl"><?=$field->name?></h1>

        <table>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
            <?php foreach ($fulfillments as $key => $fulfillment) : ?>
                <tr>
                    <td>
                        <div class="title">
                            <!-- ToDo deal with color of links -->
                            <a href="/exercises/<?=$exercise->id?>/fulfillments/<?=$fulfillment->id?>">
                                <?=$fulfillment->timestamp_fulfillment?>
                            </a>
                        </div>
                    </td>
                    <td>
                        <?php if (isset($tableAnswers[$fulfillment->id])) : ?>
                            <div class="title">
                                <?=$tableAnswers[$fulfillment->id]->answer?>
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
require_once __DIR__ . "/../gabarit.php";