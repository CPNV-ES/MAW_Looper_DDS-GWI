<?php
ob_start();

$headColor = "orange";
$headTitle = "Exercise : <a href=\"/exercises/"
    . $exercise->id .
    "/fields\" class=\"font-bold\">"
    . $exercise->name .
    "</a>";

require_once "components/head.php";
?>

    <div class="editFields max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
        <div class="grow space-y-10">
            <h1 class="text-7xl">Editing Field</h1>

            <form action="/exercises/<?=$exercise->id?>/fields/<?=$field->id?>" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <label for="field_label">Label</label>
                <input type="text" name="field[label]" id="field_label" value="<?=$field->name?>" required>
                <label for="field_value_kind" class="mt-10">Value kind</label>
                <select name="field[value_kind]" id="field_value_kind" required>
                    <option
                        <?php if ($field->type->id == 1) :?>
                            selected
                        <?php endif; ?>
                        value="1"
                    >Single line text</option>
                    <option
                        <?php if ($field->type->id == 2) :?>
                            selected
                        <?php endif; ?>
                        value="2"
                    >List of single lines</option>
                    <option
                        <?php if ($field->type->id == 3) :?>
                            selected
                        <?php endif; ?>
                        value="3"
                    >Multi-line text</option>
                </select>
                <input type="submit" value="Update field" class="bg-purple mt-12">
            </form>
        </div>
    </div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";