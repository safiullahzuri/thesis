
<nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-static-top" style="margin-bottom: 30px;">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AdminController/managePatients'); ?>"><i class="fab pati"></i>All Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AdminController/manageDoctors'); ?>">All Doctors</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AdminController/manageAppointments'); ?>">All Appointments</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AdminController/manageDiagnosis'); ?>">Manage All Diagnosis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('AdminController/myAccount'); ?>">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-right" href="<?php echo base_url('LoginController/logout'); ?>">Logout!</a>
            </li>
        </ul>
    </div>
</nav>