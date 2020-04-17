<?php
 
Yii::import('zii.widgets.grid.CGridView');
 
class CGridViewPlus extends CGridView {
 
    public $addingHeaders = array();
 
    public function renderTableHeader() {
        if (!empty($this->addingHeaders))
            $this->multiRowHeader();
 
        parent::renderTableHeader();
    }
 
    protected function multiRowHeader() {
        echo CHtml::openTag('tbody') . "\n";
        foreach ($this->addingHeaders as $row) {
            $this->addHeaderRow($row);
        }
        echo CHtml::closeTag('tbody') . "\n";
    }
 
    protected function addHeaderRow($row) {
        // add a single header row
        echo CHtml::openTag('tr') . "\n";
        // inherits header options from first column
        $options = $this->columns[0]->headerHtmlOptions;
        foreach ($row as $header => $width) {
            $options['colspan'] = $width;
            echo CHtml::openTag('td', $options);
            echo $header;
            echo CHtml::closeTag('td');
        }
        echo CHtml::closeTag('tr') . "\n";
    }
 
}
?>