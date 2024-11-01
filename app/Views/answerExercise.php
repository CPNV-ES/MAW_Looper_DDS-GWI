<?php
ob_start();

$headColor = "purple";

require_once "components/head.php";
?>

    <div class="list space-y-10 max-w-[112rem] flex flex-col mx-auto my-4">
        <h1 class="text-7xl">Your take</h1>
        <p>If you'd like to come back later to finish, simply submit it with blanks</p>

        <form action="/exercises/<?=$exercise->id?>/fulfillments" method="POST" class="space-y-10">
            <?php foreach ($fields as $field) : ?>
            <div>
                <label for="field_<?=$field->id?>"><?=$field->name?></label>

                    <?php if ($field->type->title != 'Single line text') : ?>
                    <textarea name="field[<?=$field->id?>]" id="field_<?=$field->id?>"></textarea>
                    <?php else : ?>
                    <input type="text" name="field[<?=$field->id?>]" id="field_<?=$field->id?>">
                    <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <input type="submit" value="Save" class="bg-purple mt-12">
        </form>
    </div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";