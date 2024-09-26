<td class="flex justify-between">
    <div class="title">
        <?=$title?>
    </div>
    <div class="buttons flex space-x-2">
        <a href="/exercises/<?=$exerciseId?>?exercise[status]=answering"><i class="fa-solid fa-comment text-purple"></i></a>
        <a href="/exercises/<?=$exerciseId?>/fields"><i class="fa-solid fa-pen-to-square text-purple"></i></a>
        <a href="/exercises/<?=$exerciseId?>" data-confirm="Are you sure?"><i class="fa-solid fa-trash text-purple"></i></a>
    </div>
</td>