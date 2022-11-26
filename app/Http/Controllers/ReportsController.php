<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Installation;
use App\Models\User;
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPerformanceData(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $employees = User::query()
            ->with('chainActions.installation', function ($query) use ($request) {
                $query->whereBetween('installed_on', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->get();

        // $employees = $employees->map(function ($e) {
        //     return [
        //         'name' => $e->name,
        //         'installs' => $e->chainActions->where('install_chain',true)->count('id'),
        //         'removals' => $e->chainActions->where('install_chain',false)->count('id'),
        //         'income' => $e->chainActions->count('id') * config('app.chain_rate'),
        //         'portion' => $e->chainActions->count('id') * config('app.employee_rate'),
        //         'profit' => $e->chainActions->count('id') * config('app.chain_rate') - 
        //                     $e->chainActions->count('id') * config('app.employee_rate')
        //     ];
        // });

        return $employees;
    }
}
