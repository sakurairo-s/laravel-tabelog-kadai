<!-- 追加する：Bladeファイルの最初に貼る -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-size: 1.3rem;
    }

    h1, h2, h3 {
        font-weight: 600;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h1 class="mb-4 text-center">会社概要</h1>    

            <div class="d-flex justify-content-end align-items-end mb-3">                    
                <a href="{{ route('company.edit', $company) }}" class="btn btn-primary">編集</a>
            </div>                 

            @if (session('flash_message'))
                <div class="alert alert-info" role="alert">
                    <p class="mb-0">{{ session('flash_message') }}</p>
                </div>
            @endif                 

            <div class="border rounded p-4 bg-white shadow-sm">
                @php
                    $rows = [
                        '会社名' => $company->name,
                        '所在地' => '〒' . substr($company->postal_code, 0, 3) . '-' . substr($company->postal_code, 3) . ' ' . $company->address,
                        '代表者' => $company->representative,
                        '設立' => $company->establishment_date,
                        '資本金' => $company->capital,
                        '事業内容' => $company->business,
                        '従業員数' => $company->number_of_employees,
                    ];
                @endphp

                @foreach($rows as $label => $value)
                    <div class="row py-2 border-bottom">
                        <div class="col-3 fw-bold">{{ $label }}</div>
                        <div class="col-9">{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
