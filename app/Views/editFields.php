<?php
ob_start();

$headColor = "orange";
$headTitle = "Exercise : <a href=\"\" class=\"font-bold\">" . $exercise->name . "</a>";

require_once "components/head.php";
?>

<div class="editFields max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10">
        <h1 class="text-7xl">Fields</h1>

        <table>
            <tr>
                <th>Label</th>
                <th>Value kind</th>
                <th></th>
            </tr>
            <?php foreach ($exercise->fields as $field) : ?>
                <tr>
                    <?php
                        $label = $field->name;
                        $valueKind = $field->type->title;
                        $fieldId = $field->id;
                        require "components/editFields/row-table.php"
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="/exercises/answering" class="button bg-purple">
            <i class="fa-solid fa-comment"></i> Complete and be ready for answers
        </a>
    </div>
    <div class="grow space-y-10">
        <h1 class="text-7xl">New Field</h1>

        <div class="form">
        <form action="/exercises/<?=$exercise->id?>/fields" method="post">
            <label for="field_label">Label</label>
            <input type="text" name="field[label]" id="field_label" required>
            <label for="field_value_kind" class="mt-10">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind" required>
                <option selected="selected" value="1">Single line text</option>
                <option value="2">List of single lines</option>
                <option value="3">Multi-line text</option>
            </select>
            <input type="submit" value="Create field" class="bg-purple mt-12">
        </form>
    </div>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";