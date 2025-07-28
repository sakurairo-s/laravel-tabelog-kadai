<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;

class ReservationController extends Controller
{
    public function index() {
        $reservations = Auth::user()->reservations()->orderBy('reserved_datetime', 'desc')->paginate(15);

        return view('reservations.index', compact('reservations'));
    }

    public function create(Shop $shop) {
        return view('reservations.create', compact('shop'));
    }

    public function store(Request $request, Shop $shop) {
        $request->validate([
            'reservation_date' => 'required|date_format:Y-m-d',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|numeric|between:1,50',
        ]);

        // バリデーション通過後に日時を結合
        $datetime = \Carbon\Carbon::parse($request->reservation_date . ' ' . $request->reservation_time);

        // 今より前の日時を選んでいたらリダイレクト＋エラー
        if ($datetime->lt(now())) {
            return back()
                ->withErrors(['reservation_time' => '過去の日時は選択できません。'])
                ->withInput();
        }

        $reservation = new Reservation();
        $reservation->reserved_datetime = $request->input('reservation_date') . ' ' . $request->input('reservation_time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->shop_id = $shop->id;
        $reservation->user_id = $request->user()->id;
        $reservation->save();

        return redirect()->route('reservations.index')->with('flash_message', '予約が完了しました。');
    }

    public function destroy(Reservation $reservation) {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('reservations.index')->with('error_message', '不正なアクセスです。');
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('flash_message', '予約をキャンセルしました。');
    }
}
