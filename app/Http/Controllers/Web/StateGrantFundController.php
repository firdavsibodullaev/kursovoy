<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateGrantFundRequest;
use App\Models\StateGrantFund;
use App\Services\StateGrantFundService;
use Illuminate\Http\RedirectResponse;

class StateGrantFundController extends Controller
{

    /**
     * @var StateGrantFundService
     */
    private $fundService;

    public function __construct(StateGrantFundService $fundService)
    {
        $this->fundService = $fundService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('state-grant-fund.index', [
            'orders' => $this->fundService->fetchWithPagination()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('state-grant-fund.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StateGrantFundRequest $StateGrantFundRequest
     * @return RedirectResponse
     */
    public function store(StateGrantFundRequest $StateGrantFundRequest): RedirectResponse
    {
        $this->fundService->create($StateGrantFundRequest->validated());

        return redirect()->route('state_grant_fund.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StateGrantFund $stateGrantFund
     * @return string
     */
    public function edit(StateGrantFund $stateGrantFund): string
    {
        return view('state-grant-fund.edit', [
            'order' => $stateGrantFund
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StateGrantFundRequest $StateGrantFundRequest
     * @param StateGrantFund $stateGrantFund
     * @return RedirectResponse
     */
    public function update(StateGrantFundRequest $StateGrantFundRequest, StateGrantFund $stateGrantFund): RedirectResponse
    {
        $this->fundService->update($stateGrantFund, $StateGrantFundRequest->validated());

        return redirect()->route('state_grant_fund.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StateGrantFund $stateGrantFund
     * @return RedirectResponse
     */
    public function destroy(StateGrantFund $stateGrantFund): RedirectResponse
    {
        $this->fundService->delete($stateGrantFund);

        return redirect()->route('state_grant_fund.index');
    }
}
