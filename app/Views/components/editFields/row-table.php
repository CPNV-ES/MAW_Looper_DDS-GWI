<tr>
    <td><?=$label?></td>
    <td><?=$valueKind?></td>
    <td class="flex">
        <a href="/exercises/<?=$exercise->id?>/fields/<?=$fieldId?>/edit"><i class="fa-solid fa-pen-to-square text-purple"></i></a>
        <form action="/exercises/<?=$exercise->id?>/fields/<?=$fieldId?>" method="POST" onsubmit="return confirm('Are you sure?')">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit"><i class="fa-solid fa-trash text-purple"></i></button>
        </form>
    </td>
</tr>
