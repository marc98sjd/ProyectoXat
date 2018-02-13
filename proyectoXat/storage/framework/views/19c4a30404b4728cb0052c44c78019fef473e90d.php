<?php $__env->startSection('content'); ?>
	<?php echo e(Breadcrumbs::render('noticias')); ?>

    PANTALLA NOTICIAS
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>