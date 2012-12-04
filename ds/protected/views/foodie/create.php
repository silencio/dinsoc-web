<?php
$this->breadcrumbs=array(
	'Foodies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Foodie', 'url'=>array('index')),
	array('label'=>'Manage Foodie', 'url'=>array('admin')),
);
?>

<h1>Create Foodie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>