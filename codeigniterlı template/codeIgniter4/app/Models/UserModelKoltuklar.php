<?php  namespace App\Models;
use CodeIgniter\Model;

class UserModelKoltuklar extends Model{
    protected $table='koltuklar';
     protected $allowedFields=['Koltuk_id','Koltuk_no','Sefer_id','Yolcu_id','Durum']; 
}
?>