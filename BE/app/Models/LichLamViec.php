<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LichLamViec extends Model
{
    protected $table = 'lich_lam_viecs';

    protected $fillable = [
        'id_bac_si',
        'ngay_lam_viec',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
    ];

    protected $casts = [
        'ngay_lam_viec' => 'date:Y-m-d',
    ];

    public function bacSi(): BelongsTo
    {
        return $this->belongsTo(BacSi::class, 'id_bac_si');
    }

    public function scopeOfDoctor(Builder $query, int $doctorId): Builder
    {
        return $query->where('id_bac_si', $doctorId);
    }

    public function scopeFromDate(Builder $query, string $fromDate): Builder
    {
        return $query->whereDate('ngay_lam_viec', '>=', $fromDate);
    }

    public function scopeToDate(Builder $query, string $toDate): Builder
    {
        return $query->whereDate('ngay_lam_viec', '<=', $toDate);
    }

    public function scopeOrderDefault(Builder $query): Builder
    {
        return $query
            ->orderBy('ngay_lam_viec')
            ->orderBy('thoi_gian_bat_dau');
    }

    /**
     * Kiểm tra có ca làm việc bị chồng thời gian hay không
     * Quy tắc overlap chuẩn: start1 < end2 AND end1 > start2
     */
    public function scopeOverlapping(
        Builder $query,
        int $doctorId,
        string $workDate,
        string $startTime,
        string $endTime,
        ?int $ignoreId = null
    ): Builder {
        return $query
            ->where('id_bac_si', $doctorId)
            ->whereDate('ngay_lam_viec', $workDate)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('thoi_gian_bat_dau', '<', $endTime)
                  ->where('thoi_gian_ket_thuc', '>', $startTime);
            });
    }
}
