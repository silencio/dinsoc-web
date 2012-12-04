<?php
$this->breadcrumbs=array(
	'Authorities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Authority', 'url'=>array('index')),
	array('label'=>'Manage Authority', 'url'=>array('admin')),
);
?>

<h1>Create Authority</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>