<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMolecule extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // Foreign key of DraftProduct
        'molecule_id' // Foreign key of Molecule
    ];

    public function draftProduct()
    {
        return $this->belongsTo(DraftProduct::class);
    }

    public function molecule()
    {
        return $this->belongsTo(Molecule::class);
    }
}
