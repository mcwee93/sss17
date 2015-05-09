<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
 		<legend><?php echo __('Edit Comment on ' . $title); ?></legend>
	<?php
		echo $this->Form->input('id');
		/* modification by MD - user cannot chose a different post ID or user ID
		echo $this->Form->input('post_id');
		echo $this->Form->input('user_id');
		*/
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if ($logged_in) echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Comment.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Comment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Comments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>