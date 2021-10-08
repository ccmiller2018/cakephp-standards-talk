<?php

use App\Model\Entity\Article;
?>
<?= $this->Form->create(null); ?>

<?= $this->Form->control('title'); ?>
<?= $this->Form->control('slug'); ?>
<?= $this->Form->control('body', ['rows' => '3']); ?>

<?= $this->Form->button(__('Save Article')); ?>
<?= $this->Form->end(); ?>