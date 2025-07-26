<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;

class HomeController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->title('ダッシュボード')
            ->description('Laravel-Admin 管理画面へようこそ')
            ->body('<h3>ようこそ！</h3>');
    }
}
