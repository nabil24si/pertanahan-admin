<?php
namespace App\Models;

use App\Models\JenisPenggunaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persil extends Model
{
    use HasFactory;

    protected $table      = 'persil';
    protected $primaryKey = 'persil_id';
    protected $fillable   = [
        'kode_persil',
        'pemilik_warga_id',
        'luas_m2',
        'penggunaan_id',
        'alamat_lahan',
        'rt',
        'rw',
    ];

    /**
     * Relasi ke model Warga.
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'pemilik_warga_id', 'warga_id');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisPenggunaan::class, 'penggunaan_id', 'jenis_id');
    }

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
    public function attachments()
    {
        return $this->hasMany(Media::class, 'ref_id', 'persil_id')
                    ->where('ref_table', 'persil')
                    ->orderBy('sort_order', 'asc');
    }
}
