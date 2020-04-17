<?php
/**
 * Tablesorter extension for Yii.
 *
 * jQuery tablesorter extension for Yii, for turning a standard grid view into a sortable table without page refreshes.
 * Its a wrapper of https://github.com/Mottie/tablesorter
 *
 * @author Nachi <innovativenachi@gmail.com>
 * @link https://github.com/Mottie/tablesorter
 * @link https://github.com/innovativenachi/tablesorter
 * @version 0.1
 *
 */
class SorterPrint extends CWidget {

    // Parameters passed

    private $_options = array(
        'data' => null,
        'order_direction' => null,
        'controller_url' => null,
        'columns' => null,
        'filters' => null,
        'buttons' => null,
        'table_id' => null,
        'table_class' => null
    );
    
    public function init() {
        // Table sorter was intialized
    }

    // Magic function for get parameters

    public function __get($name) {
        if (array_key_exists($name, $this->_options)) {
            return $this->_options[$name];
        }
        return parent::__get($name);
    }

    // Magic function for setting parameters
    public function __set($name, $value) {
        if (array_key_exists($name, $this->_options)) {
            return $this->_options[$name] = $value;
        }
        return parent::__set($name, $value);
    }

    // Register CSS and Jquery

    public function registerClientScript() {
        $bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
        $cs = Yii::app()->clientScript;

        // Intialize CSS
        //$cs->registerCssFile($bu . '/css/tablesorter.css');
        //$cs->registerCssFile($bu . '/css/tablesorter.pager.css');
        $cs->registerCssFile($bu . '/css/bootstrap.css');

        // Intialize Jquery
        //$cs->registerScriptFile($bu . '/js/tablesorter.js');
        //$cs->registerScriptFile($bu . '/js/tablesorter.pager.js');
        //$cs->registerScriptFile($bu . '/js/tablesorter.widgets.js');
        //$cs->registerScriptFile($bu . '/js/tablesorter.widgets-filter-formatter.js');
        //$cs->registerScriptFile($bu . '/js/scripts.js');
    }

    public function genTable() {
        $datas = $this->data;
        $object = $datas[0];
        $class = get_class($object);
        $count = count($datas);
        echo "<div class='noprint'>$count records found </div>";

        // Table start
        $table_id = $this->table_id ? $this->table_id : 'table1';

        $hidden_cols = array();
        
        if ( array_key_exists ( 'hiddenCols', $_COOKIE ) ) {
            $hidden_cols = explode(",",$_COOKIE["hiddenCols"]);
        }
        echo "<table id='$table_id' class='dataTable draggable tablesorter-bootstrap'>\n";

        // Table head start

        echo "<thead>\n";
        echo "<tr>\n";
        $filters = $this->filters;
        $i = 0;
        foreach($this->columns as $column) {
            $find = explode(".", $column[1]);
            if ( !in_array( $find[0], $hidden_cols)){
                echo "<th class='" . $filters[$i] . ' ' . $find[0] . "'>" . ucfirst($column[0]) . "</th>";
            }
            $i++;
        }

        echo "</tr>\n";
        echo "</thead>\n";

        // Table head end
        // Table body start
        
        echo "<tbody>\n";
        $count = 1;
        foreach($datas as $data) {
            echo "<tr>\n";

            foreach($this->columns as $column) {
                $find = explode(".", $column[1]);
                $subjects = array();
                if (count($find) > 1) {
                    $found = 0;
                    if (isset($data->$find[0])) {
                        if (isset($find[2])) {
                            foreach($data->$find[0] as $subject) {
                                array_push($subjects, $subject->$find[1]->$find[2]);
                            }
                            if ( !in_array( $find[0], $hidden_cols)){
                                $this->_print_td( join(', ', $subjects), $find[0] );
                            }
                        }
                        else {
                            if ( !in_array( $find[0], $hidden_cols)){
                                $this->_print_td( $data->$find[0]->$find[1], $find[0] );
                            }
                        }
                    }
                    else {
                        if ( !in_array( $find[0], $hidden_cols)){
                            $this->_print_td( '', $find[0] );
                        }
                    }
                }
                else {
                    $url_pram_key = '';
                    if ( $column[1] && !preg_match('/s_no/', $column[1]) ){
                        $url_pram_key = $data->$column[1];
                    }
                    $css_class = $column[1];
                    if ( preg_match('/photo/', $column[1]) ){
                        $data_dir = "/images/student/". $data->$column[3] .'/'.$data->$column[2];
                        $image_name = $data->$column[1];
                        if ( !$image_name){
                            $image_name = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzEiIGhlaWdodD0iMTgwIj48cmVjdCB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijg1LjUiIHk9IjkwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTcxeDE4MDwvdGV4dD48L3N2Zz4=';
                        }
                        else {
                            $image_name = $data_dir.'/'.$image_name;
                        }
                        $url_pram_key = '<img class=\'student_photo\' src='.$image_name.'>'; 
                        
                    }
                    if ( preg_match('/s_no/', $column[1]) ){
                        $url_pram_key = $count;
                        $count++;
                    }
                    if ( !in_array( $column[1], $hidden_cols)){
                        $this->_print_td( $url_pram_key, $css_class );
                    }
                }
            }

            echo "</tr>\n";
        }

        echo "</tbody>\n";

        // Table body end

        echo "</table>\n";

        // Table end

    }

    // Runs after the widget is intialized

    public function run() {
        $this->registerClientScript();
        $this->genTable();
    }
    
    private function _print_td($html, $css_class){
        echo "<td class='$css_class'>$html</td>";
    }

}

?>
