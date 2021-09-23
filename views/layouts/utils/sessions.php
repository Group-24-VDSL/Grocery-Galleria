<?php if (\app\core\Application::$app->session->getFlash('success')):  ?>
    <div class="alert alert-green">
        <a href="#" class="alert-close" onclick="this.parentElement.style.display='none';"><i
                class="fa fa-times-circle"></i></a>
        <strong>Success!</strong> <?php echo \app\core\Application::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if (\app\core\Application::$app->session->getFlash('warning')):  ?>
    <div class="alert alert-yellow">
        <a href="#" class="alert-close" onclick="this.parentElement.style.display='none';"><i
                class="fa fa-times-circle"></i></a>
        <strong>Warning!</strong> <?php echo \app\core\Application::$app->session->getFlash('warning'); ?>
    </div>
<?php endif; ?>
<?php if (\app\core\Application::$app->session->getFlash('danger')):  ?>
    <div class="alert alert-red">
        <a href="#" class="alert-close" onclick="this.parentElement.style.display='none';"><i
                class="fa fa-times-circle"></i></a>
        <strong>Danger!</strong> <?php echo \app\core\Application::$app->session->getFlash('danger'); ?>
    </div>
<?php endif; ?>


