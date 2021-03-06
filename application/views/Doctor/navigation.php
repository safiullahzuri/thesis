
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom: 30px;">
    <a class="navbar-brand" href="<?php echo base_url('DoctorController'); ?>">PACS</a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myAppointments"){echo 'active';}?>" href="<?php echo base_url('DoctorController/myAppointments'); ?>">My Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myDiagnosis"){echo 'active';}?>" href="<?php echo base_url('DoctorController/myDiagnosis'); ?>">My Diagnosis</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "mySchedule"){echo 'active';}?>" href="<?php echo base_url('DoctorController/mySchedule'); ?>">My Schedule</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "sendReports"){echo 'active';}?>" href="<?php echo base_url('DoctorController/sendReports'); ?>"> Reports</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myScans"){echo 'active';}?>" href="<?php echo base_url('DoctorController/myScans'); ?>"> Scans</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "myAccount"){echo 'active';}?>" href="<?php echo base_url('DoctorController/myAccount'); ?>">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "openDiscussions"){echo 'active';}?>" href="<?php echo base_url('DiscussionController/openDiscussions'); ?>">Open Discussions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if($this->uri->segment(2) == "chatPage"){echo 'active';}?>" href="<?php echo base_url('DoctorController/chatPage'); ?>">Chat Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pull-right" href="<?php echo base_url('LoginController/logout'); ?>">Logout!</a>
            </li>
        </ul>
    </div>
</nav>