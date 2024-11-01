<td class="flex justify-between">
    <div class="title">
        <?=$title?>
    </div>
    <div class="buttons flex space-x-2">
        <i class="fa-solid fa-chart-column text-purple"></i>
        <form action="/exercises/<?=$exerciseId?>" method="POST">
            <input type="hidden" name="_method" value="PUT"/>
            <button type="submit"><i class="fa-solid fa-circle-minus text-purple"></i></button>
        </form>
    </div>
</td>