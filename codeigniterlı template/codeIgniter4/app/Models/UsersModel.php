<?php  namespace App\Models;
use CodeIgniter\Model;

class UsersModel  extends Model{

    protected $table='yolcular';
   // protected $primaryKey='Yolcu_id';
    protected $allowedFields=['Email','Sifre','Ad','Soyad','Telefon','Tc','Yas','Cinsiyet'];
}
?>