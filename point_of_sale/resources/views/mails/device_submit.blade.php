<html>
<head></head>
<style>
    table {
        border-collapse: separate;
        border-spacing: 10px; /* cellspacing */
    }

    tr {
        border: 1px solid #1b4b72;
    }
    table td
    {
        padding: 8px 8px;
    }
    table.d {
        table-layout: fixed;
        width: 100%;
    }
    #invoice{
        padding: 30px;
    }
    #invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }
    #invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

</style>
<body>
<div style="min-width: 600px" id="invoice">
    <header>
        <div class="row">
            <div class="col">
                <a target="_blank" href="http://fxitright.com">
                    <img src="{{ asset('/public/certified3.jpg') }}" width="300px" height="130px" data-holder-rendered="true" alt="FXitRight logo"/>
                </a>
            </div>
            <div class="col company-details">
                <h2 class="name">
                    <a target="_blank" href="https://fxitright.com">
                        FXitRight
                    </a>
                </h2>
                <div>2400 Saviers Rd. Ste 204a, Oxnard CA, 93033 USA</div>
                <div>805-710-5455</div>
                <div>brian@fxitright.com</div>
            </div>
        </div>
    </header>
    <br/>
    <main>
    @if($device->status == 'processing')
    <b>Your device has been successfully submitted to FXitRight, below is the information you submitted at the time of device submission :</b>
    @else
    <b>Your device has been successfully delivered to you, below is the information you delivered at the time of device submission :</b>
    @endif
    <br/>
    <h2>Customer Info: </h2>
    <table class="d">
        <tr>
            <td>First Name</td>
            <td>{{$device->first_name}}</td>
            <td>Last Name</td>
            <td>{{$device->last_name}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{$device->address}}</td>
            <td>City</td>
            <td>{{$device->city}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$device->email}}</td>
            <td>Phone</td>
            <td>{{$device->phone}}</td>
        </tr>

    </table>

    <h2>Device Info: </h2>
    <table class="d">
        <tr>
            <td>Model</td>
            <td>{{$device->model}}</td>
            <td>Model Make</td>
            <td>{{$device->model_make}}</td>
        </tr>
        <tr>
            <td>Device Type</td>
            <td>{{$device->device_type}}</td>
            <td>Serial / IMEI number</td>
            <td>{{$device->serial_number}}</td>
        </tr>
        <tr>
            <td>Ph. pin/code</td>
            <td>{{$device->pin_code}}</td>
            <td>Accessories</td>
            <td>
                @if($device->case)
                    Case,
                @endif
                @if($device->charge)
                    Charge,
                @endif
                @if($device->box)
                    Box,
                @endif
                {{$device->other}}
            </td>
        </tr>
        @if((!empty($device->deviceMobileCheckList)))
            <tr>
                <td>Face Id</td>
                <td>{{$device->deviceMobileCheckList->face_id}}</td>
                <td>Card/SD Card Slot</td>
                <td>{{$device->deviceMobileCheckList->memory_card}}</td>
            </tr>

            <tr>
                <td>Home Button</td>
                <td>{{$device->deviceMobileCheckList->home_button}}</td>
                <td>Charging Port / Data Port</td>
                <td>{{$device->deviceMobileCheckList->charging_port}}</td>
            </tr>

            <tr>
                <td>Ear Speaker</td>
                <td>{{$device->deviceMobileCheckList->earphone}}</td>
                <td>Headset Jack</td>
                <td>{{$device->deviceMobileCheckList->headset_jack}}</td>
            </tr>

            <tr>
                <td>Microphone</td>
                <td>{{$device->deviceMobileCheckList->microphone}}</td>
                <td>Volume Control</td>
                <td>{{$device->deviceMobileCheckList->volume_control}}</td>
            </tr>

            <tr>
                <td>Power Button</td>
                <td>{{$device->deviceMobileCheckList->power_button}}</td>
                <td>Rear Glass</td>
                <td>{{$device->deviceMobileCheckList->rear_glass}}</td>
            </tr>

            <tr>
                <td>Front Camera</td>
                <td>{{$device->deviceMobileCheckList->front_camera}}</td>
                <td>Rear Camera</td>
                <td>{{$device->deviceMobileCheckList->rear_camera}}</td>
            </tr>

            <tr>
                <td>Silent Mode Switch</td>
                <td>{{$device->deviceMobileCheckList->silent_mode_switch}}</td>
                <td>Wi-Fi</td>
                <td>{{$device->deviceMobileCheckList->wifi}}</td>
            </tr>

            <tr>
                <td>Cell Signal</td>
                <td>{{$device->deviceMobileCheckList->cell_signal}}</td>
                <td>Battery Health</td>
                <td>{{$device->deviceMobileCheckList->battery_health}}</td>
            </tr>

            <tr>
                <td>Proximity Sensor</td>
                <td>{{$device->deviceMobileCheckList->proximity_sensor}}</td>
                <td>Missing Screws</td>
                <td>{{$device->deviceMobileCheckList->missing_screws}}</td>
            </tr>

            <tr>
                <td>Vibrator</td>
                <td>{{$device->deviceMobileCheckList->vibrator}}</td>
                <td>Battery Connector</td>
                <td>{{$device->deviceMobileCheckList->battery_connector}}</td>
            </tr>

            <tr>
                <td>Bluetooth</td>
                <td>{{$device->deviceMobileCheckList->bluetooth}}</td>
                <td>Internet</td>
                <td>{{$device->deviceMobileCheckList->internet}}</td>
            </tr>

            <tr>
                <td>Antenna</td>
                <td>{{$device->deviceMobileCheckList->antenna}}</td>
                <td>All Buttons</td>
                <td>{{$device->deviceMobileCheckList->buttons}}</td>
            </tr>

            <tr>
                <td>Device has no power and can not test</td>
                <td>
                    @if($device->deviceMobileCheckList->device_checked == 'on')
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>Missing Screws</td>
                <td>
                    @if($device->deviceMobileCheckList->missing_screws == 'yes')
                        <span class="glyphicon glyphicon-ok"></span>
                    @else
                        <span class="glyphicon glyphicon-remove"></span>
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <td>Unit was reloaded</td>
                <td>{{$device->deviceComputerCheckList->unit_reloaded}}</td>
                <td>Mouse</td>
                <td>{{$device->deviceComputerCheckList->mouse}}</td>
            </tr>

            <tr>
                <td>optical Drive</td>
                <td>{{$device->deviceComputerCheckList->optical_drive}}</td>
                <td>Hinge</td>
                <td>{{$device->deviceComputerCheckList->hinge}}</td>
            </tr>

            <tr>
                <td>Heatsink</td>
                <td>{{$device->deviceComputerCheckList->heatsink}}</td>
                <td>Hard Drive</td>
                <td>{{$device->deviceComputerCheckList->hard_drive}}</td>
            </tr>

            <tr>
                <td>Touchpad</td>
                <td>{{$device->deviceComputerCheckList->touchpad}}</td>
                <td>Ram Memory</td>
                <td>{{$device->deviceComputerCheckList->ram_memory}}</td>
            </tr>

            <tr>
                <td>LCD</td>
                <td>{{$device->deviceComputerCheckList->lcd}}</td>
                <td>Keyboard</td>
                <td>{{$device->deviceComputerCheckList->keyboard}}</td>
            </tr>

            <tr>
                <td>AC Adapter</td>
                <td>{{$device->deviceComputerCheckList->ac_adapter}}</td>
                <td>Fan</td>
                <td>{{$device->deviceComputerCheckList->fan}}</td>
            </tr>

            <tr>
                <td>System Board</td>
                <td>{{$device->deviceComputerCheckList->system_board}}</td>
                <td>CPU</td>
                <td>{{$device->deviceComputerCheckList->cpu}}</td>
            </tr>

            <tr>
                <td>Other's</td>
                <td>{{$device->deviceComputerCheckList->other}}</td>
                <td>Device has no power and can not test</td>
                <td>
                    @if($device->deviceComputerCheckList->device_checked == 'on')
                        Yes
                    @else
                        No
                    @endif
                </td>
            </tr>
        @endif
    </table>
    <h2>Pricing Info: </h2>
    <table class="d">
        <tr>
            <td>Description</td>
            <td>{{$device->description}}</td>
            <td>Received By</td>
            <td>{{$device->received_by}}</td>
        </tr>
        <tr>
            <td>Payment Type</td>
            <td>{{$device->payment_type}}</td>
            <td>Price</td>
            <td>{{$device->price}}</td>
        </tr>
    </table>
        <br/>
    <div class="thanks">
        Thank you for trusting FXitRight with your gadget. We will persist until we succeed.
    </div>
    <div class="notices">
        <div>NOTICE:</div>
        <div class="notice">
            <b>PLEASE READ THE FOLLOWING TERMS OF SERVICE CAREFULLY AS IT CONTAINS
                IMPORTANT
                INFORMATION ABOUT YOUR RIGHTS AND OBLIGATION, AS WELL AS
                LIMITATIONS AND EXCLUSIONS THAT MAY APPLY TO YOU</b><hr/>
            <p>These terms govern the provision of any device support services (“Services”) provided
                by FXitRight.</p>
            <p><b id="modal_name"></b> provides you with access to and use of the Services subject to your
                compliance with the Terms. <b>FXitRight</b> reserves the right to refuse to provide the
                Services to anyone at any time without notice for any reason. You represent and
                warrant to us that you are at least 18 years old, and that you have the right, capacity
                and authorization necessary to legally bind yourself to these Terms.</p>

            <p>Authorization to Access your Mobile Phone or Tablet, Computer Device
                You acknowledge that by your use of the Services you are authorizing <b>FXitRight</b> to
                access and control your mobile phone or tablet, computer for the purposes of diagnosis, service
                and repair.</p>

            <p>In connection with delivering the services <b>FXitRight</b> may download and use software,
                gather system data and access or modify your devices settings. By accepting these
                terms, you hereby grant <b>FXitRight</b> the right to download, install and use software on
                your device to gather system data, repair your device and change the settings on your
                device while performing the services.</p>

            <p>Quotes Any verbal quote given by FXitRight is given as a guide based on limited information
                provided by a customer. A verbal quote is intended to give the customer an estimate
                on the price and not an assurance that the product or service will be sold at that price.
                Any written quote will be provided by <b>FXitRight</b> at that price. All written quotes are valid
                Backup Services & Potential Data Loss While <b>FXitRight</b> will make all reasonable efforts to safeguard the contents (data)
                stored on your device, you understand and agree that prior to contacting or allowing
                <b>FXitRight</b> to perform diagnostic, repair, or other services on your device, it is your responsibility to back-up the data, software, information or other files stored on your device’s memory if you so desire. You acknowledge and agree that
                <b>FXitRight</b> and/or its third-party service provider shall not be responsible
                under any circumstances for any loss, alteration, or corruption of any software, data or files.</p>

            <p>If you do not have a backup of your software and data, we can provide you with our
                data backup service at an additional cost. However,
                we cannot guarantee the integrity
                of the data when backing up.</p>

            <h3>Confidentiality</h3>
            <p>FXitRight agrees not to disclose any and all information or data files supplied with,
                stored on, or recovered from client's equipment except to employees or agents of FXitRight subject to confidentiality agreements or as required by law.</p>

            <h3>Terms</h3>
            <p>All work must be paid in full upon completion of service. If an amount remains
                delinquent 14 days after its issue date, an additional 5% penalty will be added for each
                week of delinquency or the maximum permitted by law. In case collection proves
                necessary, the client agrees to pay all fees incurred by that process.
                Limited Liability.</p>

            <p>FXitRight shall not be liable for any claims regarding the physical functioning of equipment/media or the condition or existence of data on storage media supplied before, during or after service.In no event will FXitRight be liable for any damage to the mobile for only 7 days. Once work commences, after a technician has evaluated the system, should it appear that the cost to repair is more than quoted, no work will commence without explicit client approval.</p>

            <h3>Legal Rights</h3>
            <p>The client is the legal owner or authorized representative of the legal owner of the
                property and all data and components contained there in sent to <b>FXitRight</b>. You must be
                the owner, or have the permission of the owner, for us to work on your equipment. We
                will only take instructions for work from the owner or their designated representative.
                If equipment is left with FXitRight and is not collected within sixty (60) days after we notify you that the requested service is complete, we will treat your equipment as abandoned and becomes the sole property of <b>FXitRight</b>. You agree to hold <b>FXitRight</b> harmless for any damage or claim for the abandoned property, which we may discard at our sole discretion. Any and all charges are still your responsibility.</p>

            <p>phone/tablet/computer/equipment, loss of data, loss of revenue or profits, or any special,incidental, contingent, or consequential damages, however caused, before, during or after service even if <b>FXitRight</b> has been advised of the possibility of damages or loss to persons or property. <b>FXitRight</b> liability of any kind with respect to the services, including any negligence on its part, shall be limited to the contract price for the services.
                The client and <b>FXitRight</b> agree that the sole and exclusive remedy for unsatisfactory work shall be, at FXitRight option, additional attempts by <b>FXitRight</b> must be allowed to complete the work in a satisfactory manner, or refund of the amount paid by the client. The parties acknowledge that the price of <b>FXitRight</b> services would be much greater if <b>FXitRight</b> undertook more extensive liability.</p>

            <p>The client is aware of the inherent risks of injury and property damage involved in
                mobile device repair, including without limitation, risks due to destruction or damage
                to the machine, media, or data and inability to repair the device or recover data,
                including those that may result from the negligence of <b>FXitRight</b>, and assumes any and all known risks of injury and property damage that may result.</p>

            <h3>Warranty Disclaimer</h3>

            <p>Thank you for your interest in the products and services of FXitRight.</p>

            <p>The limited warranty applies to physical goods, and only for physical goods, purchased from FXitRight(the "Physical Goods").</p>

            <h3>
                What does this limited Warranty cover?
            </h3>
            <p>
                The limited warranty covers any defects in material or workmanship under normal use during the Warranty Period.
            </p>

            <p>
                During the Warranty Period. FXitRight will repair or replace, at no charge, products ot parts of the product that proves defective because of improper material or workmanship, under normal use and maintaince.
            </p>

            <h3>
                What will we do to correct problems?
            </h3>

            <p>
                FXitRight will either repair the Product at no charge, using new or refurbished replacement parts.
            </p>

            <h3>How long does the coverage last?</h3>
            <p>The Warranty Period for Physical Goods purchased from FXitRight is 60 days from the date of purchase.<br/>
                A replacement Physical Good or part assumes the remaining warranty of the original Physical Good or 60 days from the date of replacement or repair, whichever is longer.
            </p>

            <h3>What does this limited warranty not cover?</h3>
            <ul>The Limited Warranty does not cover any problem that is caused by:
                <li>conditions, malfunctions or damage not reulting from defects in material or workmanship.</li>
            </ul>

            <h3>What do you have to do?</h3>
            <p>
                To obtain warranty service, you must first contact us to determine the problem and the most appropiate solution for you.
            </p>
        </div>
    </div>
    @if($device->status == 'processing')
        <footer>
            Repair is good for manufacturers, good for the economy and good for the rest of us.
        </footer>
    @else
        <footer>
            You have the right to local repair.
        </footer>
    @endif
    </main>
</div>
</body>
</html>
