<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>


<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>


<?php if($errors->any()): ?>
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<ul>
	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><?php echo e($error); ?></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php endif; ?><?php /**PATH /home2/securtac/public_html/securtac/resources/views/admin/partials/flash-message.blade.php ENDPATH**/ ?>