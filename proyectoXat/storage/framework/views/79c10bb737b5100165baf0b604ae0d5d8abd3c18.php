<?php $__env->startSection('content'); ?>
	<?php echo e(Breadcrumbs::render('denuncias')); ?>

    PANTALLA DENUNCIAS
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>