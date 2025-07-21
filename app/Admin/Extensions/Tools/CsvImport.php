<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;

class CsvImport extends AbstractTool
{
   protected function script()
   {
       return <<< SCRIPT

        $('.csv-import').click(function () {
        var input = document.getElementById('files');
        input.click();
        input.addEventListener('change', function () {
        var formdata = new FormData();
        formdata.append("file", input.files[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "shops/import",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                $.pjax.reload("#pjax-container");
                toastr.success('CSVのアップロードが成功しました');
            },
            error: function (xhr) {
                toastr.error('CSVアップロードに失敗しました');
                console.error(xhr.responseText);
            }
        });
        }, { once: true });  // 複数回clickされてもイベントが多重登録されないようにする
        });


       SCRIPT;
   }

   public function render()
   {
       Admin::script($this->script());
       return view('csv_upload');
   }
}