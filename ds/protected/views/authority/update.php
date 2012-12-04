<?php
$this->breadcrumbs=array(
	'Authorities'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Authority', 'url'=>array('index')),
	array('label'=>'Create Authority', 'url'=>array('create')),
	array('label'=>'View Authority', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Authority', 'url'=>array('admin')),
);
?>

<h1>Update Authority <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>