<?php $__env->startSection('content'); ?>
    <script type="text/javascript" src="/js/chat.js"></script>
    <?php header('Access-Control-Allow-Origin: *');?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('xat')); ?>

        <?php echo e(csrf_field()); ?>

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <div class="col-md-12" style="padding-bottom: 40px;">
            <h2 class="text-center title">Chat Cornella</h2>
        </div>
        <div class="row">
            <div class="col-md-12" style="border-style: solid;border-color: greenyellow; height: 70px; border-radius: 15px; margin-bottom: 10px;">
                <div class="row">
                    <div class="col-md-12">
                        <h3 id="tituloChat" style="text-align: center;margin-top: 10px;width: 100%; height: 100%; background-color: black;padding: 10px; color: white; opacity: 0.4; border-radius: 5px; cursor:pointer;">
                            Chatea, informate, conoce gente en nuestro chat...
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="border-style: solid;border-color: greenyellow; height: 500px;border-radius: 15px; margin-right: 10px">
                <div class="row">
                    <div class="col-md-12" style="height: 220px;overflow: auto;">
                        <div class="text-center">
                            <h4>Salas de chat</h4>
                            <hr style="border-width: 4px; border-color: greenyellow; margin-top: 0;">
                        </div>
                        <div class="text-center">
                            <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p onclick="abrirSala(<?php echo $sala->id.",'".$usuario->name."','".$sala->titulo."'"?>)" style="width: 100%; height: 100%; background-color: black;padding: 5px; font-size: 15px; color: white; opacity: 0.4; border-radius: 5px; cursor:pointer;"><?php echo $sala->titulo?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-12" style="overflow: auto;">
                        <div class="text-center">
                            <h4>Chats privados</h4>
                            <hr style="border-width: 4px; border-color: greenyellow; margin-top: 0;">
                        </div>
                    </div>
                </div>

            </div>
            <div id="boxMensajes" class="col-md-8" style="border-style: solid;border-color: greenyellow; height: 440px;border-radius: 15px; width: 865px; overflow: auto;">
                <div id="layoutInitial" class="text-center" style="margin-top: 25%;">
                    <h3>Accede a una sala para empezar a chatear!</h3>
                </div>
            </div>
            <div class="col-md-8" style="border-style: solid;border-color: greenyellow; height: 50px;border-radius: 15px; width: 865px; margin-top: 10px;">
                <div class="col-md-2">
                    <button  type="submit" onclick="enviarMensajeSala()" class="btn btn-primary col-md-12"  style="margin-top: 4px">
                        Enviar
                    </button>
                </div>
                <div class="col-md-10">
                    <input id="newMensaje" name="mensaje" class="form-control" type="text" maxlength="150" style="margin-top: 4px" disabled>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>