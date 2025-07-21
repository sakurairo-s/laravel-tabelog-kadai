<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Invoice;
use Carbon\Carbon;

class SalesReportController extends AdminController
{
    public function index(Content $content)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $start = request()->input('start_date');
        $end = request()->input('end_date');

        $params = ['limit' => 100];
        if ($start && $end) {
            $params['created'] = [
                'gte' => Carbon::parse($start)->timestamp,
                'lte' => Carbon::parse($end)->timestamp,
            ];
        }

        $invoices = Invoice::all($params);

        //dd($invoices->data);

        $data = [];
        $total = 0;

foreach ($invoices->data as $invoice) {
    \Log::info('invoice status', [
        'id' => $invoice->id,
        'amount_paid' => $invoice->amount_paid,
        'paid' => $invoice->paid,
        'status' => $invoice->status,
        'customer_email' => $invoice->customer_email,
    ]);

    $data[] = [
        '顧客名' => $invoice->customer_email ?? '不明',
        '金額' => '¥' . number_format($invoice->amount_paid),
        '支払い日時' => \Carbon\Carbon::createFromTimestamp($invoice->created)->toDateTimeString(),
        'ステータス' => $invoice->status,
    ];
    $total += $invoice->amount_paid;
}
        

        return $content
            ->title('売上一覧（リアルタイム）')
            ->body(view('admin.sales_report', [
                'invoices' => $data,
                'total' => $total,
                'start' => $start,
                'end' => $end,
            ]));
    }
}
