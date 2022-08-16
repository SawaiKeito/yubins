<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yubin extends Model
{
    use HasFactory;
   
    protected $table = 'yubins';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'name',
        'post7',
        'address',
        'tell',
        'phone',
        'email',
        'created_at',
        'updated_at'
    ];
    public function findAllYubis()
    {
        return Yubin::all();
    }
    
    /**
     * 更新処理
     */
    public function updateYubin($request, $yubins)
    {
        $result = $yubins->fill([
            'name' => $request->name,
            'post7' => $request->post7,
            'address' => $request->address,
            'tell' => $request->tell,
            'phone' => $request->phone,
            'email' => $request->email
            
        ])->save();

        return $result;
    }
     /**
     * 削除処理
     */
    public function deleteYubinsById($id)
    {
        return $this->destroy($id);
    }
    
}
