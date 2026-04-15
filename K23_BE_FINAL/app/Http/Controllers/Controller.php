<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\ChucVu;
use App\Models\ChiTietChucVu;
use App\Models\PhanQuyen;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function isAdmin()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user instanceof \App\Models\Admin) {
            return $user;
        }
        return false;
    }
    public function isBacSi()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user instanceof \App\Models\BacSi) {
            return $user;
        }
        return false;
    }
    public function isBenhNhan()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user instanceof \App\Models\BenhNhan) {
            return $user;
        }
        return false;
    }
    public function checkQuyen($id_chuc_nang)
    {
        $user = $this->isAdmin();
        if ($user) {
            if ($user->is_master == 1) {
                return true;
            }

            if ($user->id_chuc_vu) {
                $check = PhanQuyen::where('id_chuc_vu', $user->id_chuc_vu)
                    ->where('id_chuc_nang', $id_chuc_nang)
                    ->first();
                if ($check) {
                    return true;
                }

                return false;
            }
        }

        return false;
    }
}
