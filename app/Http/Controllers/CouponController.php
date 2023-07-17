<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    /**
     * Display a listing of coupons.
     *
     * @return View
     */
    public function index()
    {
        $coupons = Coupon::query()->paginate(config('common.backend.pagination'));
        return view('backend.coupon.index')->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return View
     */
    public function create()
    {
        $allStatus = config('common.coupon.status');
        $allType = config('common.coupon.type');
        return view('backend.coupon.create')
            ->with('allStatus', $allStatus)
            ->with('allType', $allType)
        ;
    }

    /**
     * Store a new coupon.
     *
     * @param CouponStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CouponStoreRequest $request)
    {
        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'You have successfully created a new coupon');
    }

    /**
     * Show the form for editing the coupon.
     *
     * @param Coupon $coupon
     * @return View
     */
    public function edit(Coupon $coupon)
    {
        $allStatus = config('common.coupon.status');
        $allType = config('common.coupon.type');
        return view('backend.coupon.edit')
            ->with('coupon', $coupon)
            ->with('allStatus', $allStatus)
            ->with('allType', $allType)
            ;
    }

    /**
     * Update the coupon.
     *
     * @param CouponUpdateRequest $request
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'You have successfully updated a coupon');
    }

    /**
     * Delete a coupon.
     *
     * @param Coupon $coupon
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success', 'You have successfully deleted the coupon');
    }
}