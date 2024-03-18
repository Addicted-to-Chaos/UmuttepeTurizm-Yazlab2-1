<?php  namespace App\Models;
use CodeIgniter\Model;
class UserModelBiletler extends Model{
    protected $table='biletler';
     protected $allowedFields=['Bilet_id','PNR_kodu','Yolcu_id','Sefer_id','Koltuk_id']; 
}
?>