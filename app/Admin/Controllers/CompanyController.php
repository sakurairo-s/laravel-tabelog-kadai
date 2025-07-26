<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    protected $title = '会社概要';

    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('id', 'ID');
        $grid->column('name', '会社名');
        $grid->column('postal_code', '郵便番号');
        $grid->column('address', '住所');
        $grid->column('representative', '代表者');
        $grid->column('establishment_date', '設立日');
        $grid->column('capital', '資本金');
        $grid->column('business', '事業内容');
        $grid->column('number_of_employees', '従業員数');
        $grid->column('created_at', '作成日');
        $grid->column('updated_at', '更新日');

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Company::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', '会社名');
        $show->field('postal_code', '郵便番号');
        $show->field('address', '住所');
        $show->field('representative', '代表者');
        $show->field('establishment_date', '設立日');
        $show->field('capital', '資本金');
        $show->field('business', '事業内容');
        $show->field('number_of_employees', '従業員数');
        $show->field('created_at', '作成日');
        $show->field('updated_at', '更新日');

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Company());

        $form->text('name', '会社名');
        $form->text('postal_code', '郵便番号');
        $form->text('address', '住所');
        $form->text('representative', '代表者');
        $form->text('establishment_date', '設立日');
        $form->text('capital', '資本金');
        $form->text('business', '事業内容');
        $form->text('number_of_employees', '従業員数');

        return $form;
    }
}
