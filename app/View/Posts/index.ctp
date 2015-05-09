<div class="posts index">
	<h2><?php echo __('Posts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('file_name');?></th>
			<th><?php echo $this->Paginator->sort('file_type');?></th>
			<th><?php echo $this->Paginator->sort('file_size');?></th>
			<th><?php echo $this->Paginator->sort('content');?></th>
			<th><?php if ($logged_in) echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($posts as $post):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $post['Post']['id']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['title']; ?>&nbsp;</td>
		<td colspan="3"><?php echo $post['Post']['file_name']; ?>&nbsp;
		<br/><?php echo $post['Post']['file_type']; ?>&nbsp;
		<br/><?php echo $post['Post']['file_size']; ?>&nbsp;</td>
		<td><?php echo $post['Post']['content']; ?>&nbsp;</td>
		<td>
			<?php if ($logged_in) echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
			<?php if ($is_admin) echo  $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
			<?php if ($is_admin) echo  $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $post['Post']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</div>

<div class="actions">
<?php if ($logged_in): ?>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php if ($logged_in) echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php if ($logged_in) echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
  </ul>
<?php endif; ?>
</div>