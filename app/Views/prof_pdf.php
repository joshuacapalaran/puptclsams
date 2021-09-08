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


        <table id="attendance" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Time in</th>
                <th>Time out</th>
                <th>Subject</th>
                <th>Date</th>

            </tr>
        </thead>
        <tbody>
        <?php $ctr = 1;?>
            <?php foreach($attendances as $attendance):?>
                <tr>
                    <td><?= $ctr++ ?></td>
                    <td><?=esc($attendance['last_name'])?>, <?=esc($attendance['first_name'])?> <?=esc($attendance['m_initial'])?></td>
                    <td><?=esc($attendance['time_in'])?></td>
                    <td><?=esc($attendance['time_out'])?></td>
                    <td><?=esc($attendance['subj_name'])?></td>
                    <td><?=esc($attendance['date'])?></td>

                </tr>
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
