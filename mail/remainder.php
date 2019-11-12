<?php

use yii\helpers\Html;





?>

<h2> <?="Hello  ".$group_name." , You mast check your data list contract now!"?></h2>
<table class="table-bordered" border="1">
    <thead>
        <th>reg_number</th>
        <th>Nama</th>
        <th>No.Contract</th>
        <th>Start</th>
        <th>End</th>
       
</thead>
<?php foreach ($contract as $dt){?>
    <tr>
        <td><?=$dt['reg_number']?></td>
        <td><?=$dt['name']?></td>
        <td><?=$dt['number_contract']?></td>
        <td><?=$dt['start_date']?></td>
        <td><?=$dt['end_date']?></td>
        
    </tr>

<?php }?>
</table>
