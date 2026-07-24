<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'response',
        'status',
        'confirmed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Daftar status yang valid, urut sesuai alur.
     * pending -> in_progress -> resolved -> closed
     */
    public const STATUSES = ['pending', 'in_progress', 'resolved', 'closed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Label rapi untuk ditampilkan di badge, mis. "in_progress" -> "In Progress" */
   public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'Menunggu',
            'in_progress' => 'Sedang Diproses',
            'resolved'    => 'Selesai',
            'closed'      => 'Ditutup',
            default       => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    /** Warna badge tailwind per status, dipakai bareng di view admin/dokter/pasien */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'bg-amber-100 text-amber-700',
            'in_progress' => 'bg-blue-100 text-blue-700',
            'resolved'    => 'bg-emerald-100 text-emerald-700',
            'closed'      => 'bg-slate-200 text-slate-600',
            default       => 'bg-slate-100 text-slate-500',
        };
    }
}
