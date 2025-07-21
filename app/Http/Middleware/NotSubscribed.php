<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class NotSubscribed
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $user = $request->user();

        // サブスク加入済ユーザーは subscription.create や subscription にアクセスすべきではない
        if ($user && $user->subscribed('premium_plan')) {
            // subscription.create や subscription に来たら edit にリダイレクト
            if ($request->routeIs('subscription') || $request->routeIs('subscription.create')) {
                return redirect()->route('subscription.edit');
            }
        }

        // まだ未加入なら通す
        return $next($request);
    }
}
