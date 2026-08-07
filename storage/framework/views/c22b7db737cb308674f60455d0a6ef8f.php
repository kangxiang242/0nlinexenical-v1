<?php $__env->startSection('title', "Not Found"); ?>
<?php $__env->startSection('keywords', ""); ?>
<?php $__env->startSection('description', ""); ?>
<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
<style>
    /*html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }*/


    .full-height {
        min-height: calc(100vh - 464px);
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script>
        $('#banner').remove();
        $('.parallax_holder').remove();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="flex-center position-ref full-height">
    <div class="code">404</div>

    <div class="message" style="padding: 10px;">Not Found</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/0nlinexenical/0nlinexenical-v1/resources/views/errors/404.blade.php ENDPATH**/ ?>