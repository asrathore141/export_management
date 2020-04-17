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
class Sorter extends CWidget {

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
        $controller_url = $this->controller_url;
        $table_class = $this->table_class;
        $object = $datas[0];
        $class = get_class($object);
        $count = count($datas);
        echo "<div class='noprint recordcount'>$count records found </div>";

        // Table start
        $table_id = $this->table_id ? $this->table_id : 'table1';

        $hidden_cols = array();
        
        if ( array_key_exists ( 'hiddenCols', $_COOKIE ) ) {
            $hidden_cols = explode(",",$_COOKIE["hiddenCols"]);
        }
        echo "<table id='$table_id' class='dataTable $table_class tablesorter-bootstrap'>\n";

        // Table head start

        echo "<thead>\n";
        echo "<tr>\n";
        
        if ( $this->buttons ){
            echo "<th width='10'>&nbsp;</th>";
        }
        
        $filters = $this->filters;
        $i = 0;
        foreach($this->columns as $column) {
            $find = explode(".", $column[1]);
            $col_width = sizeof($column) > 2 ? $column[2] : '';
            $sort_url = Yii::app()->createAbsoluteUrl($controller_url, array(
                'order' => $column[1],
                'od' => $this->order_direction
            ));
            if ( preg_match('/s_no|student_id|studentSubjects|input|custom*/', $column[1]) ){
                $sort_url = '#';
            }
            $hide = '';
            if ( in_array( $find[0], $hidden_cols)){
                $hide ="style='display:none;'";
            }
            echo "<th $hide width='$col_width' class='" . $filters[$i] . ' ' . $find[0] . "'>"
            . "<a href='$sort_url'>" . ucfirst($column[0]) . '</a>'
            . "</th>";
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

            if ( $this->buttons ){
                echo "<td class='noprint'>";
                foreach($this->buttons as $button) {
                    $icon  = $button['icon_class'];
                    $url   = $button['url'];
                    $title = '';
                    if ( array_key_exists( 'title', $button ) ){
                        $title = $button['title'];
                    }
                    $new_url = '#';
                    if ( $url ) {

                        $url_parameters = explode(',',$url);
                        $url_pram_key = explode(".", $url_parameters[2]);

                        if ( sizeof($url_pram_key) > 1 ) {
                            $url_pram_key_style = $url_pram_key[0];
                            if ( sizeof($url_pram_key) == 1) {
                                $url_pram_key_style = $data->$url_pram_key[0];
                            }
                            if ( sizeof($url_pram_key) == 2) {
                                $url_pram_key_style = $data->$url_pram_key[0]->$url_pram_key[1];
                            }
                        }
                        else {
                            $url_pram_key_style = $data->$url_parameters[2];
                        }
                        
                        $new_url = Yii::app()->createAbsoluteUrl($url_parameters[0], array(
                            $url_parameters[1] => $url_pram_key_style
                        ));
                    }
                    
                    $button_class = $button['button_class'] | 'btn-small';
                    echo "<a title='$title' class='btn $button_class' href='$new_url'><i class='$icon'></i></a>";
                }
                echo "</td>";
            }
            
            foreach($this->columns as $column) {
                $hide = '';
                if ( in_array( $column[1], $hidden_cols)){
                    $hide ="style='display:none;'";
                }
                $find = explode(".", $column[1]);
                $subjects = array();
                if (count($find) > 1) {
                    $found = 0;
                    if (isset($data->$find[0])) {
                        if (isset($find[2])) {
                            foreach($data->$find[0] as $subject) {
                                array_push($subjects, $subject->$find[1]->$find[2]);
                            }
                            $this->_print_td( join(', ', $subjects), $find[0], $hide );
                        }
                        else {
                            $this->_print_td( $data->$find[0]->$find[1], $find[0], $hide );
                        }
                    }
                    else {
    
                        $this->_print_td( '', $find[0], $hide );
                    }
                }
                else {
                    $url_pram_key = '';
                    if ( $column[1] && !preg_match('/s_no|input|custom*/', $column[1]) ){
                        $url_pram_key = $data->$column[1];
                    }
                    $css_class = $column[1] ? $column[1] : $column[0];

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
                    if ( preg_match('/custom_value/', $column[1]) ){
                        if ( array_key_exists( $data->phone, $column[3]) ) {
                            $url_pram_key = $column[3][$data->phone]['status'];
                        }
                    }
                    if ( preg_match('/input/', $column[1]) ){
                        $phone = $data->phone;
                        $url_pram_key = "<input type='checkbox' name='sms_select[]' class='sms_select' value='". trim($phone) ."'/>";
                    }
                    $hide = '';
                    if ( in_array( $column[1], $hidden_cols)){
                        $hide ="style='display:none;'";
                    }
                    $this->_print_td( $url_pram_key, $css_class, $hide );
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
    
    private function _print_td($html, $css_class, $attr){
        echo "<td $attr class='$css_class'>$html</td>";
    }

}

?>
