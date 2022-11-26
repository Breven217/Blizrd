<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHistoryData(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $installations =  Installation::query()
            ->whereBetween('installed_on', [$request->input('start_date'), $request->input('end_date')])
            ->with('location', 'chainActions')
            ->get();

        $installations = $installations->map(function ($i) {
            return [
                'installed_on' => date("Y/m/d", strtotime($i->installed_on)),
                'location' => $i->location->name,
                'action_count' => $i->chainActions->count('id'),
                'paid' => $i->paid,
                'paid_on' => $i->paid_on,
                'total_charge' => $i->chainActions->count('id') * config('app.chain_rate')
            ];
        });

        $totals = [
            'total_installations' => $installations->count(),
            'total_paid' => $installations->where('paid',true)->sum('total_charge'),
            'total_charge' => $installations->sum('total_charge')
        ];

        $installations = collect([
            'totals' => $totals,
            'installations' => $installations
        ]);

        return $installations;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return Illuminate\Support\Collection
     */
    public function getPerformanceData(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);
    }
}
