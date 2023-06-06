<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class databaseModel extends Model
{
    protected $table = 'kategori_makanan';
    protected $fillable = [
        'Id', 'Kode', 'Nama', 'Energi', 'Protein', 'Lemak', 'Karbohidrat', 'Natrium', 'Kategori', 'Berat'
    ];
}
