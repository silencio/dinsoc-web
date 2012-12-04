<?php
$this->breadcrumbs=array(
	'Foodies'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Foodie', 'url'=>array('index')),
	array('label'=>'Create Foodie', 'url'=>array('create')),
	array('label'=>'View Foodie', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Foodie', 'url'=>array('admin')),
);
?>

<h1>Update Foodie <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>