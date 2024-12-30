<table class="table display table-bordered table-striped table-hover ">
    <thead>
    <tr>
        <th><?php echo display('sl') ?></th>
        <th>Waybill #</th>
        <th>Updated by</th>
        <th>Status</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($waybill_log)){
        $i=0;
        foreach($waybill_log as $val){
            $i++;
            $log = json_decode($val->log_content);
            $status = getValue('trip_status', array('id' => $log->status));
            $created_by = getValue('user', array('id' => $log->created_by));
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url('vehiclereq/waybill/preview/'.$log->waybill_no); ?>" target="_blank"><?php echo $log->waybill_no;?></a></td>
                <td><?php echo $created_by->firstname.' '.$created_by->lastname; ?></td>
                <td><?php echo $status->name;?></td>
                <td><?php echo $val->created_date; ?></td>
            </tr>
        <?php } } ?>
    </tbody>
</table> <!-- /.table-responsive -->
