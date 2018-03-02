<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10"><?php echo e(Breadcrumbs::render('noticias')); ?></div>
	</div>
	<br>
	<?php if(session()->has('message')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
    <?php if((Auth::user()->is_admin)==1): ?>
        <form name="formNoticia" method="POST" action="<?php echo e(url('servicios/noticias/createNoticia')); ?>" enctype="multipart/form-data"  class="form-group">
            <?php echo e(csrf_field()); ?>

            <div name="substituir1"></div>
        </form>
        <script type="text/javascript">
            crearNoticia();
        </script>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12" style="padding: 40px;">
                <h4 class="text-center">Sólo pueden crear notícias los administradores.</h4>
            </div>
        </div>
    <?php endif; ?>

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
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <select id="noticiasCategorias" class="form-control">
                    <?php $__currentLoopData = $arrayNoticias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo $noticia->categoria;?>"><?php echo $noticia->categoria;?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-info" onclick="buscarNoticia()">Buscar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div id="categoria" class="col-md-10">


            </div>


        </div>


    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>