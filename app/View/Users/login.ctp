<h1>Welcome, please login below</h1>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User',array('action'=>'login')); ?>
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end('Login'); ?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'add')); ?> </li>
  </ul>
</div>

