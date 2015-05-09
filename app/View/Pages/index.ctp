<div class="view">
<h3><?php if ($logged_in) echo 'Welcome to the Blog! As a registered member you have access to posts made by the group. From there you can view and comment on any of the posts. Please keep it clean, thanks for getting involved.' ?></h3>
<h2><?php if ($is_admin) echo 'Welcome Admin' ?></h2>

</div>
<div class="actions">
<?php if ($logged_in): ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if ($logged_in) echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php if ($logged_in) echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?></li>
		<li><?php if ($logged_in) echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
  </ul>
<?php endif; ?>
</div>