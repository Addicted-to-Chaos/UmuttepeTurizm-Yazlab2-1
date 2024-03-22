<?php  namespace App\Models;
use CodeIgniter\Model;

class UsersModel  extends Model{

    protected $table='yolcular';
    protected $allowedFields=['Yolcu_id','Email','Sifre','Ad','Soyad','Telefon','Tc','Yas','Cinsiyet','Bakiye'];
}



?>