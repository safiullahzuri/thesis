
<nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-static-top" style="margin-bottom: 30px;">
    <a class="navbar-brand" href="<?php echo base_url('AdminController'); ?>">PACS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "managePatients"){echo 'active';}?>" href="<?php echo base_url('AdminController/managePatients'); ?>">All Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "manageDoctors"){echo 'active';}?>" href="<?php echo base_url('AdminController/manageDoctors'); ?>">All Doctors</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "manageAppointments"){echo 'active';}?>" href="<?php echo base_url('AdminController/manageAppointments'); ?>">All Appointments</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "manageDiagnosis"){echo 'active';}?>" href="<?php echo base_url('AdminController/manageDiagnosis'); ?>">Manage All Diagnosis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myAccount"){echo 'active';}?>" href="<?php echo base_url('AdminController/myAccount'); ?>">My Account</a>
            </li>
            <li class="nav-item">
                <a class="btn nav-link pull-right" href="<?php echo base_url('LoginController/logout'); ?>">Logout!</a>
            </li>
        </ul>
    </div>
</nav>