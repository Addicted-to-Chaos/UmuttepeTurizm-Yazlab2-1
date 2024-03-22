<?php  namespace App\Models;
use CodeIgniter\Model;

class UserModelSeferler extends Model{
    protected $table='seferler';
     protected $allowedFields=['Sefer_id','Kalkis_sehir','Varis_sehir','Tarih','Kalkis_saat','Varis_saat','Peron_no','Plaka','Kapasite','Dolu_koltuk','Bos_koltuk','Fiyat']; 
}
?>