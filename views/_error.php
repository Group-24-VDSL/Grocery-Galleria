<?php

/** @var Exception $exception **/

use app\core\Application;

?>


<h1><?php echo $exception->getCode()?> - <?php echo $exception->getMessage()?></h1>
<pre>
<?php var_dump(Application::$app->getController()->action) ;?>
<?php var_dump(Application::isGuest()) ;?>
<?php var_dump(Application::getUserRole()) ;?>
<?php var_dump(Application::$app->user) ;?>
</pre>

<pre>
<?php var_dump(Application::$app->getController()->getMiddlewares()) ;?>
</pre>
<pre>
<?php var_dump(Application::$app->authMiddleware->actions) ;?>
</pre>





