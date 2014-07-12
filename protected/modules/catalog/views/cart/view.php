<table>
    <?php foreach($elements as $data): ?>
        <?php $element = $data['element']; ?>
        <?php $quantity = $data['quantity']; ?>
        <tr>
            <td><?= $element->getImageUrl('150x150') ?></td>
            <td><?= $element->title ?></td>
            <td><?= $quantity ?></td>
        </tr>
    <?php endforeach ?>
</table>