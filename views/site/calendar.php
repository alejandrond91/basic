<?php
use kartik\widgets\DateTimePicker;
use kartik\widgets\AlertBlock;
use kartik\widgets\DatePicker;

echo '<label class="control-label">Valid Dates</label>';
echo DatePicker::widget([
    'name' => 'from_date',
    'value' => '01-Feb-1996',
    'type' => DatePicker::TYPE_RANGE,
    'name2' => 'to_date',
    'value2' => '27-Feb-1996',
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy'
    ]
]);

?>