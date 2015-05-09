<div class="posts form">
<?php 
echo $this->Form->create('Post', array('enctype'=>'multipart/form-data')); // edited by MD to allow file upload
?> 
	<fieldset>
 		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->file('submittedfile');
		/* modification by MD - replace the next few lines with the file input above
		echo $this->Form->input('file_name');
		echo $this->Form->input('file_type');
		echo $this->Form->input('file_size');
		*/
		echo $this->Form->input('content');
		/* modification by MD - user can't change their ID to pretend to be somebody else!
		echo $this->Form->input('user_id');
		*/
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php if ($logged_in) echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php if ($logged_in) echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>