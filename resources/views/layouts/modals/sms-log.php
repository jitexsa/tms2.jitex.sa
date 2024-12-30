<table class="table display table-bordered table-striped table-hover ">
    <thead>
    <tr>
        <th><?php echo display('sl') ?></th>
        <th>Waybill #</th>
        <th>Mobile #</th>
        <th>Status</th>
        <th>SMS Response</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($sms_log)){
        $i=0;
        foreach($sms_log as $val){
            $i++;
            $sms_log = json_decode($val->log_content);
            $waybill = getValue('tbl_trip', array('id' => $val->log_type_id));
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url('vehiclereq/waybill/preview/'.$waybill->waybill_no); ?>" target="_blank"><?php echo $waybill->waybill_no;?></a></td>
                <td><?php echo $sms_log->phone_number;?></td>
                <td><?php echo ucfirst(str_replace('_sms', '',$sms_log->status));?></td>
                <td><?php echo $sms_log->sms_response;?></td>
            </tr>
        <?php } } ?>
    </tbody>
</table> <!-- /.table-responsive -->
