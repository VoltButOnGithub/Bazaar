<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ContractController extends Controller
{
    public function index(): View
    {
        $contracts = Contract::paginate(5);
        return view('contract.index', ['contracts' => $contracts]);
    }

    public function create(): View
    {
        return view('contract.create');
    }

    public function store(StoreContractRequest $request): RedirectResponse
    {
        $request->validated();
        Contract::create([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect(route('contract.index'))->with('success', __('global.contract_created'));
    }

    public function show(int $id): Response
    {
        $contract = Contract::find($id);
        $pdf = PDF::loadView('contract.PDF', [
            'title' => $contract->title,
            'text' => $contract->text,
        ]);

        return $pdf->download('contract.pdf');
    }

    public function destroy(int $id): RedirectResponse
    {
        Contract::find($id)->delete();
        return redirect()->back()->with('success', __('global.contract_destroyed'));
    }
}
