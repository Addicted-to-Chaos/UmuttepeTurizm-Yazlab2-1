<?php  namespace App\Models;
use CodeIgniter\Model;

class UserModelBiletLog extends Model{
    protected $table='bilet_log';
     protected $allowedFields=['Log_id','Bilet_id','Durum','Islem_tarihi']; 
}
?>