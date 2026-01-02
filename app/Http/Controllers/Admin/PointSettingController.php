<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PointSettingController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'points_per_rm' => 'required|numeric|min:0',
            'rm_per_point' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $pointSetting = PointSetting::first();
            if ($pointSetting) {
                $pointSetting->update([
                    'points_per_rm' => $request->points_per_rm,
                    'rm_per_point' => $request->rm_per_point,
                ]);
            } else {
                PointSetting::create([
                    'points_per_rm' => $request->points_per_rm,
                    'rm_per_point' => $request->rm_per_point,
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Point settings updated successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error updating settings: ' . $e->getMessage()], 500);
        }
    }
}
