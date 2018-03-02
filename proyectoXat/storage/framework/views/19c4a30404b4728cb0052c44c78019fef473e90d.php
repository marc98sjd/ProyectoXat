<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10"><?php echo e(Breadcrumbs::render('noticias')); ?></div>
	</div>
	<br>
    <div class="row">
    	<div class="col-md-5"></div>
    	<button class="col-md-2 btn btn-info" onclick="crearNoticia()">Crear notícia</button>
    </div>

	<?php if($arrayNoticias->isEmpty()): ?>
        <div class="row">
            <div class="col-md-12" style="padding: 40px;">
                <h4 class="text-center">Todavía no hay noticias</h4>
            </div>
        </div>

    <?php else: ?>
    	<div class="row">
          	<div class="col-md-12" style="padding: 40px;">
                <h2 class="text-center title">Noticias</h2>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>