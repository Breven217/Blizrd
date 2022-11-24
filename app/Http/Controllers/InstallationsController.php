<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstallationRequest;
use App\Models\ChainAction;
use App\Models\Installation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class InstallationsController extends Controller
{
    /**
     * returns all installations that are yet to be paid with associated chain actions
     *
     * @return \Illuminate\Support\Collection
     */
    public function getOutstandingInstallations()
    {
        return Installation::where('paid',false)->with('chainActions');
    }

    /**
     * marks the given installation as paid
     *
     * @param Request $request
     * @return Installation
     */
    public function markPaid(Request $request)
    {
        $request->validate([
            'installation_id' => 'required|integer|exists:installation,id'
        ]);

        return Installation::find($request->input('installation_id'))->update(['paid' => true, 'paid_on' => Carbon::now()]);
    }

    /**
     * creates a new installation entry and adds all chain actions entries associated
     *
     * @param CreateInstallationRequest
     * @return void
     */
    public function createInstallation(CreateInstallationRequest $request)
    {
        DB::beginTransaction();

        try {
            $installation = Installation::create([
                'installed_on' => Carbon::now(),
                'location_id' => $request->input('location_id')
            ]);
            foreach ($request->actions as $action) {
                ChainAction::create([
                    'installation_id' => $installation->id,
                    'vehicle_id' => $action->vehicle_id,
                    'user_id' => $action->user_id,
                    'install_chain' => $action->installed
                ]);
            }   
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
