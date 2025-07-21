<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create() {
        $user = Auth::user();
        $intent = Auth::user()->createSetupIntent();

        return view('subscription.create', compact('user', 'intent'));
    }

    public function store(Request $request) {
    $priceId = config('services.stripe.premium_price_id');

    $request->user()
        ->newSubscription('premium_plan', $priceId)
        ->create($request->paymentMethodId);

            $request->user()->refresh();
            return redirect()->route('shops.index')->with('flash_message', '有料プランへの登録が完了しました。');
    }

    public function edit() {
        $user = Auth::user();
        $intent = $user->createSetupIntent();

        return view('subscription.edit', compact('user', 'intent'));
    }

    public function update(Request $request) {
        $request->user()->updateDefaultPaymentMethod($request->paymentMethodId);

        return redirect()->route('shops.index')->with('flash_message', 'お支払い方法を変更しました。');
    }

    public function cancel() {
        return view('subscription.cancel');
    }

    public function destroy(Request $request) {
        $request->user()->subscription('premium_plan')->cancelNow();

        return redirect()->route('shops.index')->with('flash_message', '有料プランを解約しました。');
    }
}
