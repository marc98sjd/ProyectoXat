<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10"><?php echo e(Breadcrumbs::render('noticias')); ?></div>
        </div>
        <br>

        <?php if(session()->has('message')): ?>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="alert alert-success">
                <?php echo e(session()->get('message')); ?>

            </div>
        </div>

        <?php endif; ?>
    </div>
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

        <?php if($arrayNoticias->isEmpty() and $noticiasImportantes -> isEmpty()): ?>
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
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Importantes</h4>
                </div>
            </div>
            <?php $__currentLoopData = $noticiasImportantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticiaImportante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row" style="padding: 50px; border-style: solid; border-color: red; margin: 10px;">
                    <div class="col-md-8">
                        <h4>Titulo:
                            <?php
                            echo "<ul>$noticiaImportante->titulo</ul>";
                            ?>
                        </h4>
                        <label>Descripción
                            <?php
                            echo "<ul><p>$noticiaImportante->descripcion</p></ul>";
                            ?>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <img src='<?php echo e(URL::asset("$noticiaImportante->imagen")); ?>' alt='Imagen no disponible!' style='height:250px'>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Otras...</h4>
                </div>
            </div>
            <?php $__currentLoopData = $arrayNoticias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row" style="padding: 50px; border-style: solid; border-color: blue; margin: 10px;">
                    <div class="col-md-8">
                        <h4>Titulo:
                            <?php
                            echo "<ul>$noticia->titulo</ul>";
                            ?>
                        </h4>
                        <label>Descripción
                            <?php
                            echo "<ul><p>$noticia->descripcion</p></ul>";
                            ?>
                        </label>
                        <?php if((Auth::user()->is_admin)==1): ?>
                            <?php if($noticiasImportantes->isEmpty()): ?>
                                <br><br>
                                <form method="POST" action="<?php echo e(url('servicios/noticias/updateNoticia')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <button type="submit" class="btn btn-danger">Importante</button>
                                    <input type="hidden" name="id" value="<?php echo $noticia->id; ?>">
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <img src='<?php echo e(URL::asset("$noticia->imagen")); ?>' alt='Imagen no disponible!' style='height:250px'>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h2 class="text-center title">Secciones</h2>
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