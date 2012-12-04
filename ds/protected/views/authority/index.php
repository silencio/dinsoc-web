<?php
$this->breadcrumbs=array(
	'Authorities',
);

$this->menu=array(
	array('label'=>'Create Authority', 'url'=>array('create')),
	array('label'=>'Manage Authority', 'url'=>array('admin')),
);
?>

<h1>Authorities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
