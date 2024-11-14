<td class="flex justify-between">
    <div class="title">
        <?=$title?>
    </div>
    <div class="buttons flex space-x-2">
        <?php if ($ready): ?>
            <form action="/exercises/<?=$exerciseId?>" method="POST">
                <input type="hidden" name="_method" value="PUT"/>
                <button type="submit"><i class="fa-solid fa-comment text-purple"></i></button>
            </form>
        <?php endif; ?>
        <a href="/exercises/<?=$exerciseId?>/fields"><i class="fa-solid fa-pen-to-square text-purple"></i></a>
        <form action="/exercises/<?=$exerciseId?>" method="POST" onsubmit="return confirm('Are you sure?')">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit"><i class="fa-solid fa-trash text-purple"></i></button>
        </form>
    </div>
</td>