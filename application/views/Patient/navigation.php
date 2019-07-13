
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom: 30px;">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PatientController/bookAnAppointment'); ?>">Book An Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PatientController/myAppointments'); ?>">My Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PatientController/myDiagnosis'); ?>">My All Diagnosis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PatientController/myAccount'); ?>"> My Account</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('PatientController/myScans'); ?>"> My Scans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-right" href="<?php echo base_url('LoginController/logout'); ?>">Logout!</a>
            </li>
        </ul>
    </div>
</nav>