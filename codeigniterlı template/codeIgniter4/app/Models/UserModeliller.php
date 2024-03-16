<?php  namespace App\Models;
use CodeIgniter\Model;

class UserModeliller extends Model{
    protected $table='sehirler';
     protected $allowedFields=['Plaka_kodu',' Sehir_adi']; 
}
?>