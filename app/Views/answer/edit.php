<?php
ob_start();

$headColor = "purple";

require_once __DIR__ . "/../components/head.php";
?>

    <div class="list space-y-10 max-w-[112rem] flex flex-col mx-auto my-4">
        <h1 class="text-7xl">Your take</h1>
        <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>

        <form
            action="/exercises/<?=$exercise->id?>/fulfillments/<?=$answers[array_key_first($answers)]->fulfillment->id?>"
            method="POST"
            class="space-y-10"
        >
            <input type="hidden" id="_method" name="_method" value="PATCH">
            <?php foreach ($fields as $field) : ?>
                <div>
                    <label for="<?=$field->id?>"><?=$field->name?></label>

                    <?php if ($field->type->title != 'Single line text') : ?>
                        <textarea name="field[<?=$field->id?>]" id="<?=$field->id?>"><?php
                        if ($answers != null && isset($answers[$field->id])) {
                            echo $answers[$field->id]->answer;
                        }
                        ?></textarea>
                    <?php else : ?>
                        <input
                            type="text"
                            name="field[<?=$field->id?>]"
                            id="<?=$field->id?>"
                            value="<?php if ($answers != null && isset($answers[$field->id])) {
                                echo $answers[$field->id]->answer;
                                   } ?>"
                        >
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Save" class="bg-purple mt-12">
        </form>
    </div>

<?php
$pageContent = ob_get_clean();
require_once __DIR__ . "/../gabarit.php";