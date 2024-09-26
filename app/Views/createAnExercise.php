<?php
ob_start();

$headColor = "orange";
$headTitle = "New exercise";

require_once "components/head.php";
?>

<div class="content max-w-[112rem] flex flex-col mx-auto space-y-12">
    <h1 class="text-7xl">New Exercise</h1>
    <div class="form">
        <form action="#">
            <label for="exercise_title">Title</label>
            <input type="text" name="exercise[title]" id="exercise_title">
            <input type="submit" value="Create an exercise" class="bg-purple mt-12">
        </form>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";