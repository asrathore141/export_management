<?php
	$user_id = Yii::app()->user->getState('user')->user_id;
	$criteria = new CDbCriteria;
	$criteria->compare('type', 'LEADNOTE');
	$criteria->addCondition('due_date IS NOT NULL');
	$criteria->addCondition('due_date >= DATE(NOW()) ');

//$a = new Note;
//$query = $a->getCommandBuilder()->createFindCommand($a->getTableSchema(), $criteria)->getText();
//var_dump( $query );

	if ( !Yii::app()->user->isAdmin() ){
		$criteria->compare('note_by', $user_id);
	}

	$data = new CActiveDataProvider('Note', array(
		'criteria' => $criteria,
		'pagination' => array(
			'pageSize' => 100
		),
		'sort'=>array(
			'defaultOrder'=> 'note_on, due_date DESC',
		),
	));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$data,
	'dataProvider'=>$data,
	'template'=>'{items}',
	'columns'=>array(
		array(
			'value' => function($data,$row){ return ($row + 1); },
			'header'=>'#',
			'htmlOptions'=>array(
				'width'=>'2%',
			),
		),
		array(
			'header' => 'Follow-up',
			'name' => 'note',
		),
		array(
			 'header'=>'Dues in Days',
			 'type' =>'raw',
			 'value'=> function($data){

				$color = '';
				if ( new DateTime($data->due_date) <= new DateTime("NOW") ) {
					$color = 'red';
				}

				$date2 = new DateTime("NOW");
				$date1 = new DateTime($data->due_date);
				$diff = $date2->diff($date1);
				$n = $diff->d * ( $diff->invert ? -1 : 1);
				$st = $n . (abs($n)>1?" days":" day") . ($n<0?" ago":" from now");
				return "<span style='color:$color'>$st &nbsp;&nbsp;-&nbsp;$data->due_date</span>";
			 },
			'htmlOptions'=>array(
				'width'=>'5%',
			),
		),
	    array(
			'header' => 'Follow-up By',
			'name' => 'noteby.full_name',
			'visible' => Yii::app()->user->isAdmin() ? true : false,
		),
		array(
			'header' => 'Follow-up for Lead',
			'name'=>'lead.company',
			'value' => function($data){
				return $data->lead->company ? $data->lead->company : $data->lead->first_name;
			},
			'urlExpression'=>'array("leads/view","id"=>$data->lead->lead_id)',
			'class'=>'YDataLinkColumn',
		),
	),
)); ?>