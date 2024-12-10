<?php
ob_start();

$headColor = "green";

$headTitle = "Exercise : <a href=\"/exercises/$exercise->id/results\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once "components/head.php";
?>
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
            <?php foreach ($tests as $test) : ?>
                <tr>
                    <td>
                        <!-- ToDo deal with color of links -->
                        <a href="/exercises/<?=$test->exercise->id?>/fulfillments/<?=$test->id?>"><?=$test->timestamp->format('Y-m-d H:i:s e')?></a>
                    </td>
                <?php foreach ($fields as $field) : ?>
                    <td>
                    <?php if (isset($tableAnswers[$test->id][$field->id])) : ?>
                        <!--Icons are a bit different. That's because the real ones used aren't free-->
                        <?php if (strlen($tableAnswers[$test->id][$field->id]->answer) > 9): ?>
                        <i class="fa fa-check-double fa-lg" style="color: #49a835;"></i>
                        <?php elseif (strlen($tableAnswers[$test->id][$field->id]->answer)): ?>
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
<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";