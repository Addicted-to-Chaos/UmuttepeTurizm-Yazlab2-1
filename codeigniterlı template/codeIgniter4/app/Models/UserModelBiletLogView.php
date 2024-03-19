<?php  namespace App\Models;
use CodeIgniter\Model;
class UserModelBiletLogView extends Model{
    protected $table='bilet_log_view';
    protected $allowedFields=['Bilet_id','PNR_kodu','Kalkis_Sehir','Varis_Sehir','Sefer_Tarihi', 'Kalkis_Saat', 'Peron_No', 'Koltuk_no', 'Durum', 'Islem_tarihi'];
}
?>