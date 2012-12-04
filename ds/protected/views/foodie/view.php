<?php
$this->breadcrumbs=array(
	'Foodies'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List Foodie', 'url'=>array('index')),
	array('label'=>'Create Foodie', 'url'=>array('create')),
	array('label'=>'Update Foodie', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Foodie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Foodie', 'url'=>array('admin')),
);
?>

<h1>View Foodie #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'email',
		'last_login_at',
	),
)); ?>
