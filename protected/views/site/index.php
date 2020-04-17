<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
?>

<div class="row-fluid">

    <div class="span6 text-center">
        <h1>Welcome <small>  Stone World Exclusive </small></h1>
        <p style="color:#000;">Please login to your accout to perform operation</p> <br/>
    </div>

<?php $this->renderPartial('login',array('model'=>$model)); ?>

</div>

