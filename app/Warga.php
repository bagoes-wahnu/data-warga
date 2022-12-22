<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $guarded = [];
    public function getStatusLabelAttribute(){
        //ADAPUN VALUENYA AKAN MENCETAK HTML BERDASARKAN VALUE DARI FIELD STATUS
        if ($this->status == 0) {
            return '<span class="badge badge-secondary">Aktif</span>';
        }
        return '<span class="badge badge-success">Tidak Aktif</span>';
    }
}
