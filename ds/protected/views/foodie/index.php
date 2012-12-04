<?php
$this->breadcrumbs=array(
	'Foodies',
);

$this->menu=array(
	array('label'=>'Create Foodie', 'url'=>array('create')),
	array('label'=>'Manage Foodie', 'url'=>array('admin')),
);
?>

<h1>Foodies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
