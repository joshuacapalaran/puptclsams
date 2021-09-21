<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Attendance Report</title>
    
</head>
 <style>
 
 th,td,tr {
  border:1px solid black;
  border-collapse:collapse;
}

table { border-collapse: collapse; border: 1px solid black; border: none; }

td {
  font-family:Arial;
  font-size:11px;
}
 </style>

<body>
    
    <div id="container">

    <?php if($info):?>
        
        <?php if($type == 'event'):?>
        <div style="font-size:11px;">Time: <?= $info['start_time'];?> - <?= $info['end_time'];?> &nbsp; &nbsp;Subject: <?= $info['subj_name'];?> &nbsp;&nbsp; Professor: <?= $info['last_name'];?>, <?= $info['first_name'];?> <?= $info['m_initial'];?>&nbsp;&nbsp;&nbsp;&nbsp; Course: <?= $info['course_abbrev'];?> &nbsp;&nbsp;&nbsp;Year & Section: <?= $info['year'];?> - <?= $info['section'];?> &nbsp;&nbsp; S.Y: <?= $info['start_sy'];?>-<?= $info['end_sy'];?>  &nbsp;&nbsp; Sem: <?= $info['sem'];?> </div>
        <span style="font-size:11px;">Printed On: <?= date('F d, Y');?></span>
        <?php else:?>
        <span style="font-size:11px">Time: <?= $info['start_time'];?> - <?= $info['end_time'];?> &nbsp;&nbsp;&nbsp; Event Name: <?= $info['event_name'];?> &nbsp;&nbsp;&nbsp;&nbsp; Assigned Person: <?= $info['assigned_person'];?>&nbsp;&nbsp;&nbsp; Laboratory: <?= $info['lab_name'];?> &nbsp;&nbsp;&nbsp;&nbsp; Category: <?= $info['category'];?> &nbsp;&nbsp;&nbsp;&nbsp;Printed On: <?= date('F d, Y');?></span>

        <?php endif;?>
    <?php endif;?>

        <table id="attendance" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>

                <th colspan=2>Date</th>
                <?php foreach($headers as $header):?>
                    <th colspan="3"><?= $header['date'];?></th>
                <?php endforeach;?>

            </tr>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <?php foreach($headers as $header):?>
                    <th>Time in</th>
                    <th>Time out</th>
                    <th>Remarks</th>
                <?php endforeach;?>

            </tr>
        </thead>
        <tbody>
        <?php $ctr = 1;?>
            <?php foreach($attendances as $attendance):?>
                <tr>
                    <td><?= $ctr++ ?></td>
                    <td><?=esc($attendance['last_name'])?>, <?=esc($attendance['first_name'])?> <?=esc($attendance['m_initial'])?></td>
                
                <?php foreach($times as $header):?>

                    <?php  if(trim($attendance['student_number']) == trim($header['student_number']) ||  in_array($header['date'] ,$headers)): ?>

                        <td><?=esc(date('h:i:s A', strtotime($header['time_in'])))?></td>
                        <td><?=esc(($header['time_out']) ? date('h:i:s A', strtotime($header['time_out'])):'')?></td>
                        <td><?=esc($header['remarks'])?></td>

                    <?php endif;?>

                </tr>
                <?php endforeach;?>

            <?php endforeach;?>

        </tbody>
        </table>
       
    </div>
    <br>
    <br>
    <br>
    <br>
        <div >
        <span >Verified by: ____________________________</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <span >Certified true copy: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ____________________________</span>
        </div>
</body>
 
</html>
