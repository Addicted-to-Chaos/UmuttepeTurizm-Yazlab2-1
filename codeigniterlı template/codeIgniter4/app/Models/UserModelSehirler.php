<?php  namespace App\Models;
use CodeIgniter\Model;



class UserModelSehirler extends Model{
    protected $table='sehirler';
     protected $allowedFields=['Sehir_adi',' Plaka_kodu']; 
}







?>