<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminUserController extends AdminController
{
 protected function grid()
    {
        $grid = new Grid(new Admin());

        $grid->column('id', 'ID')->sortable();
        $grid->column('email', 'メールアドレス');
        $grid->column('created_at', '作成日');
        $grid->column('updated_at', '更新日');

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Admin::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('email', 'メールアドレス');
        $show->field('created_at', '作成日');
        $show->field('updated_at', '更新日');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Admin());

        $form->email('email')->rules('required|email|unique:admins,email,{{id}}');
        $form->password('password')->rules('required')->default(function () {
            return '';
        });

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password !== $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        return $form;
    }
}
