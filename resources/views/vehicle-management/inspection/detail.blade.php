<div class="row">
                <div class="col-6">
                        <label for="vehicle_id" class="form-label">Vehicle:</label>
                        {{ $rec->licence_plate_no }}
                </div>
                <div class="col-6">
                        <label for="reg_no" class="form-label">Registration Number:</label>
                        {{ $rec->vehicleRegistration }}
                </div>
                <div class="col-6">
                        <label for="kms_out" class="form-label">Meter Reading Outgoing (km):</label>
                        {{ $rec->kms_out }}
                </div>
                <div class="col-6">
                        <label for="kms_in" class="form-label">Meter Reading Incoming (km):</label>
                        {{ $rec->kms_in }}
                </div>
                <div class="col-6">
                        <label for="fuel_out" class="form-label">Fuel level Outgoing:</label>
                        {{ fuelType($rec->fuel_out) }}
                </div>
                <div class="col-6">
                        <label for="fuel_in" class="form-label">Fuel level Incoming:</label>
                        {{ fuelType($rec->fuel_in) }}
                </div>
                <div class="col-6">
                        <label for="datetime_out" class="form-label">Date &amp; Time Outgoing:</label>
                            {{ $rec->datetime_out }}
                </div>
                <div class="col-6">
                        <label for="datetime_in" class="form-label">Date &amp; Time Incoming:</label>
                            {{ $rec->datetime_in }}
                </div>
                <div class="col-6">
                        <label for="petrol_card" class="form-label">Petrol Card:</label>
                        {{ inspectionStatus($rec->petrol_card) }}
                        {{ $rec->petrol_card_text }}
                </div>
                <div class="col-6">
                        <label for="lights" class="form-label">Lights, Indicators:</label>
                        {{ inspectionStatus($rec->lights) }}
                        {{ $rec->lights_text }}
                </div>
                <div class="col-6">
                        <label for="invertor" class="form-label">Inverter/Cigarette:</label>
                        {{ inspectionStatus($rec->invertor) }}
                        {{ $rec->invertor_text }}
                </div>
                <div class="col-6">
                        <label for="car_mats" class="form-label">Car mats/Car seat covers:</label>
                        {{ inspectionStatus($rec->car_mats) }}
                        {{ $rec->car_mats_text }}
                </div>
                <div class="col-6">
                        <label for="int_damage" class="form-label">Interior damages:</label>
                        {{ inspectionStatus($rec->int_damage) }}
                        {{ $rec->int_damage_text }}
                </div>
                <div class="col-6">
                        <label for="int_lights" class="form-label">Interior Lights:</label>
                        {{ inspectionStatus($rec->int_lights) }}
                        {{ $rec->int_lights_text }}
                </div>
                <div class="col-6">
                        <label for="ext_car" class="form-label">Damage to exterior of car: dents, <br /> scratches, broken lights etc:</label>
                        {{ inspectionStatus($rec->ext_car) }}
                        {{ $rec->ext_car_text }}
                </div>
                <div class="col-6">
                        <label for="tyre" class="form-label">Tyres: New / need replacing:</label>
                        {{ inspectionStatus($rec->tyre) }}
                        {{ $rec->tyre_text }}
                </div>
                <div class="col-6">
                        <label for="ladder" class="form-label">Ladders, extension ladder:</label>
                        {{ inspectionStatus($rec->ladder) }}
                        {{ $rec->ladder_text }}
                </div>
                <div class="col-6">
                        <label for="leed" class="form-label">Extension leeds:</label>
                        {{ inspectionStatus($rec->leed) }}
                        {{ $rec->leed_text }}
                </div>
                <div class="col-6">
                        <label for="power_tool" class="form-label">Any of our power tools:</label>
                        {{ inspectionStatus($rec->power_tool) }}
                        {{ $rec->power_tool_text }}
                </div>
                <div class="col-6">
                        <label for="ac" class="form-label">Air conditioner working or not:</label>
                        {{ inspectionStatus($rec->ac) }}
                        {{ $rec->ac_text }}
                </div>
                <div class="col-6">
                        <label for="head_light" class="form-label">Lights, headlights working:</label>
                        {{ inspectionStatus($rec->head_light) }}
                        {{ $rec->head_light_text }}
                </div>
                <div class="col-6">
                        <label for="lock" class="form-label">Automatic locks/alarms working:</label>
                        {{ inspectionStatus($rec->lock) }}
                        {{ $rec->lock_text }}
                </div>
                <div class="col-6">
                        <label for="windows" class="form-label">Windows: working or <br /> not/ any damages/ window tints:</label>
                        {{ inspectionStatus($rec->windows) }}
                        {{ $rec->windows_text }}
                </div>
                <div class="col-6">
                        <label for="condition" class="form-label">Condition or car seats:</label>
                        {{ inspectionStatus($rec->condition) }}
                        {{ $rec->condition_text }}
                </div>
                <div class="col-6">
                        <label for="oil_chk" class="form-label">Oil check:</label>
                        {{ inspectionStatus($rec->oil_chk) }}
                        {{ $rec->oil_chk_text }}
                </div>
                <div class="col-6">
                        <label for="suspension" class="form-label">Suspension:</label>
                        {{ inspectionStatus($rec->suspension) }}
                        {{ $rec->suspension_text }}
                </div>
                <div class="col-6">
                        <label for="tool_box" class="form-label">Tool boxes, gas struts on tool boxes,<br /> roller draws inside tool  boxes trundle tray:</label>
                        {{ inspectionStatus($rec->tool_box) }}
                        {{ $rec->tool_box_text }}
                </div>
                <div class="col-6">
                    <label for="tool_box" class="form-label">Inspected By:</label>
                    {{ $rec->inspected }}
                </div>
                <div class="col-6">
                </div>
                @if(isset($rec) and $rec->vehicle_inspection_image)
                    <div class="col-6 text-center">
                        <img src="{{ baseURL($rec->vehicle_inspection_image) }}" width="250">
                    </div>
                @endif
</div>