<div class="posts view">
<h2><?php echo __('Post');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('File Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['file_name']; ?>
			&nbsp;
			<img src="<?php echo $this->webroot; ?>cms_uploads/id_<?php echo $post['Post']['id']; ?>_<?php echo $post['Post']['file_name']; ?>" height="100" width="100" /> 
			<?php 
			if ( $post['Post']['file_size']>0 and $post['Post']['file_name']!='' ) {
			echo $this->Html->link(__('View File'), array('controller'=>'posts','action' => 'serve', $post['Post']['id'],$post['Post']['file_name']));
			}
			?>			
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('File Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['file_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('File Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['file_size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Content'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['content']; ?>
			&nbsp;
		</dd>
		<?php if($logged_in): ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php  echo $this->Html->link($post['User']['name'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
	</dl>
</div>
<div class="actions">
<?php if ($logged_in): ?>
	<h3><?php echo __('Actions'); ?></h3>
	
	
	<ul>
		<li><?php if ($logged_in) echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'index')); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $post['Post']['id'])); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php if ($is_admin) echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
		<li><?php if ($logged_in) echo $this->Html->link(__('logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>

	
	</ul>
<?php endif; ?>
</div>
<div class="related">
<?php if ($logged_in): ?>
	<h3><?php echo __('Related Comments');?></h3>
	<?php if (!empty($post['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $comment['id'];?></td>
			<td><?php echo $comment['post_id'];?></td>
			<td><?php echo $comment['user_id'];?></td>
			<td><?php echo $comment['comment'];?></td>
			<td><?php echo $comment['created'];?></td>
			<td><?php echo $comment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

<?php endif; ?>
</div>

