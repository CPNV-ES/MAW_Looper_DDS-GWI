<?php
ob_start();

$headColor = "green";

require_once "components/head.php";
?>

<div class="manageExercise max-w-[112rem] flex mx-auto space-y-10 md:space-x-10 md:space-y-0 flex-wrap">
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Building</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <tr>
                    <?php
                        $title = $i;
                        $exerciseId = $i;
                        require "components/manageExercise/cell-building.php"
                    ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Answering</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <tr>
                    <?php
                        $title = $i;
                        $exerciseId = $i;
                        require "components/manageExercise/cell-answering.php"
                    ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div class="grow space-y-10 w-full md:w-auto">
        <h1 class="text-7xl">Closed</h1>

        <table>
            <tr>
                <th>Title</th>
            </tr>
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <tr>
                    <?php
                        $title = $i;
                        $exerciseId = $i;
                        require "components/manageExercise/cell-closed.php"
                    ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";