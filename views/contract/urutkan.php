<?php
use yii\grid\GridView;


?>



<?=GridView::widget([
    'dataProvider'=>$provider,
    'columns'=>[
        'id', 
        'reg_number',
        'person.name',
        
    ]
])?>