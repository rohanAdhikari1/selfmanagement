<?php

namespace App\Http\Controllers;

use App\Models\Inspectionreport;
use Illuminate\Support\Str;

class InspectionController extends Controller
{
    public function drafts()
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json([
                'status' => false,
                'error' => 'User Not Found.'
            ], 404);
        }
        $draftInspections = Inspectionreport::where('is_draft', true)->where('is_active', true)->where('created_by', $userId)->get();
        $final = $draftInspections->map(function ($ins) {
            return [
                'id' => $ins->id,
                'title' => $ins->title,
                'site_name' => $ins->site?->name,
                'frequency' => $ins->frequency,
                'date' => $ins->created_at,
            ];
        });
        return response()->json([
            'status' => true,
            'result' => $final,
        ]);
    }
}
