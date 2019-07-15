<?php


class BackupModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function addBackup($backupAddress, $userId, $userType){
        $backupData = array("backup_date" => date('Y-m-d'), "backup_address" => $backupAddress, "user_id" => $userId, "user_type" => $userType );
        if ($this->db->insert('backups', $backupData)){
            return true;
        }else{
            return false;
        }
    }

    function gotBackupForLastTwoWeeks($userId, $userType){
        $now = time();
        $last_backup_date = $this->getLastBackupDateFor($userId, $userType);

        if ($last_backup_date == null){
            return false;
        }

        $datediff = $now - $last_backup_date;

        $difference_in_days = round($datediff / (60 * 60 * 24));
        if ($difference_in_days >= 14){
            return true;
        }else{
            return false;
        }
    }

    function getLastBackupDateFor($userId, $userType){
        $this->db->where("user_id", $userId);
        $this->db->where("user_type", $userType);
        $this->db->select("backup_date");
        $this->db->from('backups');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->row()->backup_date;
        }
    }

}