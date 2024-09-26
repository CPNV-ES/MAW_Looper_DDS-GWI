<?php
ob_start();

$headColor = "orange";
$headTitle = "Exercise : <a href=\"\" class=\"font-bold\">" . $exerciseId . "</a>";

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
            <?php for($i = 0; $i < 4; $i++): ?>
                <tr>
                    <?php
                        $label = "Label - " . $i;
                        $valueKind = "Value_" . $i;
                        require "components/editFields/row-table.php"
                    ?>
                </tr>
            <?php endfor; ?>
        </table>

        <a href="/exercises/answering" class="button bg-purple"><i class="fa-solid fa-comment"></i> Complete and be ready for answers</a>
    </div>
    <div class="grow space-y-10">
        <h1 class="text-7xl">New Field</h1>

        <div class="form">
        <form action="#">
            <label for="field_label">Label</label>
            <input type="text" name="field[label]" id="field_label">
            <label for="field_value_kind" class="mt-10">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind">
                <option selected="selected" value="single_line">Single line text</option>
                <option value="single_line_list">List of single lines</option>
                <option value="multi_line">Multi-line text</option>
            </select>
            <input type="submit" value="Create field" class="bg-purple mt-12">
        </form>
    </div>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";