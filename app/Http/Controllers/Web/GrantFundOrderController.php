<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GrantFundOrder;
use App\Http\Requests\StoreGrantFundOrderRequest;
use App\Http\Requests\UpdateGrantFundOrderRequest;
use App\Services\GrantFundOrderService;
use Illuminate\Http\RedirectResponse;

class GrantFundOrderController extends Controller
{
    /**
     * @var GrantFundOrderService
     */
    private $grantFundOrderService;

    public function __construct(GrantFundOrderService $grantFundOrderService)
    {
        $this->grantFundOrderService = $grantFundOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return view('grant-fund-orders.index', [
            'orders' => $this->grantFundOrderService->fetchWithPagination()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        return view('grant-fund-orders.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGrantFundOrderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGrantFundOrderRequest $request): RedirectResponse
    {
        $this->grantFundOrderService->create($request->validated());

        return redirect()->route('grant_fund_order.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GrantFundOrder $grantFundOrder
     * @return string
     */
    public function edit(GrantFundOrder $grantFundOrder): string
    {
        return view('grant-fund-orders.edit', [
            'order' => $grantFundOrder
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGrantFundOrderRequest $request
     * @param GrantFundOrder $grantFundOrder
     * @return RedirectResponse
     */
    public function update(UpdateGrantFundOrderRequest $request, GrantFundOrder $grantFundOrder): RedirectResponse
    {
        $this->grantFundOrderService->update($grantFundOrder, $request->validated());

        return redirect()->route('grant_fund_order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GrantFundOrder $grantFundOrder
     * @return RedirectResponse
     */
    public function destroy(GrantFundOrder $grantFundOrder): RedirectResponse
    {
        $this->grantFundOrderService->delete($grantFundOrder);

        return redirect()->route('grant_fund_order.index');
    }
}