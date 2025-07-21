<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Shop;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'));
        $grid->column('shop.name', '店舗名');
        $grid->column('user_id', __('User id'));
        $grid->column('user.email', 'メールアドレス');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('hidden', 'レビュー非公開')->bool();
        $grid->column('title', __('Title'));
        $grid->column('score', __('Score'));

        $grid->filter(function($filter){
 
        $filter->like('shop.name', '店舗名');
        $filter->like('user.email', 'メールアドレス');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('shop.name',  '店舗名');
        $show->field('user_id', __('User id'));
        $show->field('user.email', 'Email');
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('hidden', __('Hidden'));
        $show->field('title', __('Title'));
        $show->field('score', __('Score'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Review());

        $form->textarea('content', __('Content'));
        $form->select('shop_id', '店舗名')->options(Shop::all()->pluck('name', 'id'));
        $form->number('user_id', __('User id'));
        $form->text('title', __('Title'));
        $form->number('score', __('Score'));
        $form->switch('hidden', __('Hidden'));

        return $form;
    }


}
