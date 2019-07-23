<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom: 30px;">
    <a class="navbar-brand" href="<?php echo base_url('PatientController'); ?>">PACS</a>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "bookAnAppointment"){echo 'active';}?>" href="<?php echo base_url('PatientController/bookAnAppointment'); ?>">Book An Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myAppointments"){echo 'active';}?>" href="<?php echo base_url('PatientController/myAppointments'); ?>">My Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myDiagnosis"){echo 'active';}?>" href="<?php echo base_url('PatientController/myDiagnosis'); ?>">My All Diagnosis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myAccount"){echo 'active';}?>" href="<?php echo base_url('PatientController/myAccount'); ?>"> My Account</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myScans"){echo 'active';}?>" href="<?php echo base_url('PatientController/myScans'); ?>"> My Scans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "chatPage"){echo 'active';}?>" href="<?php echo base_url('PatientController/chatPage'); ?>"> Chat With Doctors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-right" href="<?php echo base_url('LoginController/logout'); ?>">Logout!</a>
            </li>
        </ul>
    </div>
</nav>