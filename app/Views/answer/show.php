<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercise/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once __DIR__ . "/../components/head.php";
?>
<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <table>
            <tr>
                <th>Take</th>
            <?php foreach ($fields as $field) : ?>
                <th>
                    <!-- ToDo deal with color of links -->
                    <a href="/exercises/<?=$exercise->id?>/results/<?=$field->id?>">
                        <?=$field->name?>
                    </a>
                </th>
            <?php endforeach; ?>
            </tr>
            <?php foreach ($fulfillments as $fulfillment) : ?>
                <tr>
                    <td>
                        <!-- ToDo deal with color of links -->
                        <a href="/exercises/<?=$fulfillment->exercise->id?>/fulfillments/<?=$fulfillment->id?>"><?=$fulfillment->timestamp_fulfillment?></a>
                    </td>
                <?php foreach ($fields as $key => $field) : ?>
                    <td>
                    <?php if (isset($tableAnswers[$fulfillment->id])) : ?>
                        <!--Icons are a bit different. That's because the real ones used aren't free-->
                        <?php if (strlen($tableAnswers[$fulfillment->id][$key]->answer) > 9): ?>
                        <i class="fa fa-check-double fa-lg" style="color: #49a835;"></i>
                        <?php elseif (strlen($tableAnswers[$fulfillment->id][$key]->answer)): ?>
                        <i class="fa-solid fa-check fa-lg" style="color: #49a835;"></i>
                        <?php else: ?>
                        <i class="fa fa-times fa-lg" style="color: #ff0000;"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                    </td>
                <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
$pageContent = ob_get_clean();
require_once __DIR__ . "/../gabarit.php";