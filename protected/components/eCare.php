<?php
class eCare extends Yii
{
    public static function powered()
    {
        echo 'Powered by: <a href="'
        	. Yii::app()->params->company['website']
        	.'" target="_blank">'
        	. Yii::app()->params->company['name']
        	.'</a>';
    }

    public function roles() {
        return array(
            'Tester' => 'tester',
            'Admin' => 'admin',
            'Operator' => 'operator'
        );
    }

}

