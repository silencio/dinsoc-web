<?php
$this->breadcrumbs=array(
	'Authorities'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List Authority', 'url'=>array('index')),
	array('label'=>'Create Authority', 'url'=>array('create')),
	array('label'=>'Update Authority', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Authority', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Authority', 'url'=>array('admin')),
);
?>

<h1>View Authority #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'provider_id',
	),
)); ?>
