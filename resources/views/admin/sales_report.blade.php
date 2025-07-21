<div class="card p-3">
    <form method="GET">
        <div class="row mb-3">
            <div class="col-md-3">
                <label>開始日</label>
                <input type="date" name="start_date" value="{{ $start }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label>終了日</label>
                <input type="date" name="end_date" value="{{ $end }}" class="form-control">
            </div>
            <div class="col-md-3 mt-4">
                <button class="btn btn-primary mt-2">検索</button>
            </div>
        </div>
    </form>

    <h5>合計売上：¥{{ number_format($total) }}</h5>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>顧客名</th>
                <th>金額</th>
                <th>支払い日時</th>
                <th>ステータス</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice['顧客名'] }}</td>
                    <td>{{ $invoice['金額'] }}</td>
                    <td>{{ $invoice['支払い日時'] }}</td>
                    <td>{{ $invoice['ステータス'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
