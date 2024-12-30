<style>
    h1{
        text-align: center;
    }
    .main{
        padding-right: 10px;
        padding-left: 10px;
        padding-top: 20px;
        font-family: Arial;
    }
     .column{
         float: left;
         width: 376px;
         padding-right: 10px;
     }
    .column2{
        width: 385px;
        float: left;
    }
    .vehicle-info{
        width: 100%;
        border: 1px solid;
        border-collapse: collapse;
        font-family: Arial;
    }
    .vehicle-info tbody td{
        padding: 5px 10px;
    }
    .listing{
        width: 100%;
        margin-top: 10px;
    }
    .table{
        width: 100%;
        border: 1px solid;
        border-collapse: collapse;
        font-family: Arial;
        margin-bottom: 10px;
    }
    .table thead td, .table thead th{
        background: #c1c1c1;
        padding: 5px;
        font-weight: bold;
        border: 1px solid
    }
    .table tbody td{
        border: 1px solid;
        padding: 5px;
    }
    .text-center{
        text-align: center;
    }
    .sketch{
        margin-bottom: 10px;
    }
    .pdf-header{
        width: 100%;
        border-collapse: collapse;
        font-family: Arial;
        margin-bottom: 10px;
    }
    .pdf-header .title{
        width: 60%;
        text-align: right;
    }
    .pdf-header .logo{
        width: 40%;
    }
    .pdf-header h1{
        font-size: 13px;
    }
    .signature{
        margin-top: 100px;
    }
</style>
 <div class="main">
     <table class="pdf-header">
         <tbody>
         <tr>
             <td class="title"><h1>Vehicle Inspection</h1></td>
             <td class="logo"><img src="{{ baseURL((!empty($setting->logo)?$setting->logo:'assets/dist/img/logo.png')) }}"
                      width="100"></td>
         </tr>
         </tbody>
     </table>
    <table class="vehicle-info">
        <tbody>
            <tr>
                <td>Vehicle:</td>
                <td>{{ $rec->licence_plate_no }}</td>
                <td>Inspection Date:</td>
                <td>{{ dateFormat($rec->inspection_date,'shortdate') }}</td>
            </tr>
            <tr>
                <td>Vehicle Type:</td>
                <td>{{ $rec->type_name }}</td>
                <td>Registration Number:</td>
                <td>{{ $rec->vehicleRegistration }}</td>
            </tr>
            <tr>
                <td>Date &amp; Time Outgoing:</td>
                <td>{{ $rec->datetime_out }}</td>
                <td>Date &amp; Time Incoming:</td>
                <td>{{ $rec->datetime_in }}</td>
            </tr>
        </tbody>
    </table>
    <div class="listing">
        <div class="column">
            <table class="table">
        <thead>
        <tr>
            <td>Engine</td>
            <th>Yes</th>
            <th>No</th>
            <th>Comments</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Meter Reading Outgoing (km)</td>
            <td></td>
            <td></td>
            <td>{{ $rec->kms_out }}</td>
        </tr>
        <tr>
            <td>Meter Reading Incoming (km)</td>
            <td></td>
            <td></td>
            <td> {{ $rec->kms_in }}</td>
        </tr>
        <tr>
            <td>Oil Check</td>
            <td>{{ inspectionStatusPdf($rec->oil_chk,1) }}</td>
            <td>{{ inspectionStatusPdf($rec->oil_chk,0) }}</td>
            <td>{{ $rec->oil_chk_text }}</td>
        </tr>
        </tbody>
    </table>
            <table class="table">
                <thead>
                <tr>
                    <td>Interior</td>
                    <th>Yes</th>
                    <th>No</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Lights, Indicators</td>
                    <td>{{ inspectionStatusPdf($rec->lights,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->lights,0) }}</td>
                    <td>{{ $rec->lights_text }}</td>
                </tr>
                <tr>
                    <td>Inverter/Cigarette</td>
                    <td>{{ inspectionStatusPdf($rec->invertor,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->invertor,0) }}</td>
                    <td>{{ $rec->invertor_text }}</td>
                </tr>
                <tr>
                    <td>Car mats/Car seat covers</td>
                    <td>{{ inspectionStatusPdf($rec->car_mats,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->car_mats,0) }}</td>
                    <td>{{ $rec->car_mats_text }}</td>
                </tr>
                <tr>
                    <td>Interior damages</td>
                    <td>{{ inspectionStatusPdf($rec->int_damage,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->int_damage,0) }}</td>
                    <td>{{ $rec->int_damage_text }}</td>
                </tr>
                <tr>
                    <td>Interior Lights</td>
                    <td>{{ inspectionStatusPdf($rec->int_lights,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->int_lights,0) }}</td>
                    <td>{{ $rec->int_lights_text }}</td>
                </tr>
                <tr>
                    <td>Lights, headlights working</td>
                    <td>{{ inspectionStatusPdf($rec->head_light,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->head_light,0) }}</td>
                    <td>{{ $rec->head_light_text }}</td>
                </tr>
                <tr>
                    <td>Condition or car seats</td>
                    <td>{{ inspectionStatusPdf($rec->condition,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->condition,0) }}</td>
                    <td>{{ $rec->condition_text }}</td>
                </tr>
                <tr>
                    <td>Air conditioner working or not</td>
                    <td>{{ inspectionStatusPdf($rec->ac,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->ac,0) }}</td>
                    <td>{{ $rec->ac_text }}</td>
                </tr>
                <tr>
                    <td>Automatic locks/alarms working</td>
                    <td>{{ inspectionStatusPdf($rec->lock,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->lock,0) }}</td>
                    <td>{{ $rec->lock_text }}</td>
                </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <td>Suspension</td>
                    <th>Yes</th>
                    <th>No</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Any of our power tools</td>
                    <td>{{ inspectionStatusPdf($rec->power_tool,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->power_tool,0) }}</td>
                    <td>{{ $rec->power_tool_text }}</td>
                </tr>
                <tr>
                    <td>Suspension</td>
                    <td>{{ inspectionStatusPdf($rec->suspension,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->suspension,0) }}</td>
                    <td>{{ $rec->suspension_text }}</td>
                </tr>
                <tr>
                    <td>Tool boxes, gas struts on tool boxes, roller draws inside tool  boxes trundle tray</td>
                    <td>{{ inspectionStatusPdf($rec->tool_box,1) }}</td>
                    <td>{{ inspectionStatusPdf($rec->tool_box,0) }}</td>
                    <td>{{ $rec->tool_box_text }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="column2">
            <div class="text-center sketch">
               @if(isset($rec) and $rec->vehicle_inspection_image)
                  <img src="{{ baseURL($rec->vehicle_inspection_image) }}" width="300">
                @endif
            </div>
            <table class="table">
            <thead>
            <tr>
                <td>Body</td>
                <th>Yes</th>
                <th>No</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Damage to exterior of car: dents, scratches, broken lights etc</td>
                <td>{{ inspectionStatusPdf($rec->ext_car,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->ext_car,0) }}</td>
                <td>{{ $rec->ext_car_text }}</td>
            </tr>
            <tr>
                <td>Windows working or any damages/tints</td>
                <td>{{ inspectionStatusPdf($rec->windows,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->windows,0) }}</td>
                <td>{{ $rec->windows_text }}</td>
            </tr>
            <tr>
                <td>Ladders, extension ladder</td>
                <td>{{ inspectionStatusPdf($rec->ladder,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->ladder,0) }}</td>
                <td>{{ $rec->ladder_text }}</td>
            </tr>
            <tr>
                <td>Extension leeds</td>
                <td>{{ inspectionStatusPdf($rec->leed,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->leed,0) }}</td>
                <td>{{ $rec->leed_text }}</td>
            </tr>
            <tr>
                <td>Tyres: New / need replacing</td>
                <td>{{ inspectionStatusPdf($rec->tyre,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->tyre,0) }}</td>
                <td>{{ $rec->tyre_text }}</td>
            </tr>
            <tr>
                <td>Lights, headlights working</td>
                <td>{{ inspectionStatusPdf($rec->head_light,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->head_light,0) }}</td>
                <td>{{ $rec->head_light_text }}</td>
            </tr>
            </tbody>
        </table>
            <table class="table">
            <thead>
            <tr>
                <td>Fuel System</td>
                <th>Yes</th>
                <th>No</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Fuel level Outgoing</td>
                <td></td>
                <td></td>
                <td>{{ fuelType($rec->fuel_out) }}</td>
            </tr>
            <tr>
                <td>Fuel level Incoming</td>
                <td></td>
                <td></td>
                <td> {{ fuelType($rec->fuel_in) }}</td>
            </tr>
            <tr>
                <td>Petrol Card</td>
                <td>{{ inspectionStatusPdf($rec->petrol_card,1) }}</td>
                <td>{{ inspectionStatusPdf($rec->petrol_card,0) }}</td>
                <td>{{ $rec->petrol_card_text }}</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
     <div class="signature">
         <label>Inspected By:</label>
         {{ $rec->inspected }}
     </div>
 </div>