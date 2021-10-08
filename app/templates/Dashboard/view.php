<table>
    <thead>
        <th>Article Title</th>
        <th>Date</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?=$article->title;?></td>
                <td><?=$article->created;?></td>
                <td><?= $this->Html->link('Edit', ['_name' => 'Article.Edit', $article->id]); ?></td>
            </tr>
        <?php endforeach;?> 
    </tbody>
</table>
<?= $this->Html->link('Create New Article', ['_name' => 'Article.Create']); ?>