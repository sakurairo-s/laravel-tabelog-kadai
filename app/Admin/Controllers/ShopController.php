<?php

namespace App\Admin\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\CsvImport;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;


class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'));
        $grid->column('name', '店舗名');
        $grid->column('description', __('Description'));
        $grid->column('category.name', __('Category Name'));
        $grid->column('image', __('Image'))->image();        
        $grid->column('price_min', __('Price min'));
        $grid->column('price_max', __('Price max'));
        $grid->column('business_hour_start', __('Business hour start'));
        $grid->column('business_hour_end', __('Business hour end'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('registered_at', __('Registered at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        
        $grid->tools(function ($tools) {
            $tools->append(new CsvImport());
        });

        $grid->filter(function($filter){
 
        $filter->like('name', '店舗名');

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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('category.name', __('Category Name'));
        $show->field('image', __('Image'))->image();
        $show->field('price_min', __('Price min'));
        $show->field('price_max', __('Price max'));
        $show->field('business_hour_start', __('Business hour start'));
        $show->field('business_hour_end', __('Business hour end'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('holiday', __('Holiday'));
        $show->field('registered_at', __('Registered at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Shop());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->number('price_min', __('Price min'));
        $form->number('price_max', __('Price max'));
        $form->time('business_hour_start', __('Business hour start'))->default(date('H:i:s'));
        $form->time('business_hour_end', __('Business hour end'))->default(date('H:i:s'));
        $form->text('address', __('Address'));
        $form->text('phone_number', __('Phone number'));
        $form->text('holiday', __('Holiday'));
        $form->date('registered_at', __('Registered at'))->default(date('Y-m-d'));
        $form->image('image', __('Image'));

        return $form;
    }


    public function csvImport(Request $request)
    {
        $file = $request->file('file');
        
        if (!$file) {
            return response()->json(['error' => 'ファイルがアップロードされていません'], 400);
        }

        $path = $file->getRealPath();

        $lexer_config = new LexerConfig();
        $lexer = new Lexer($lexer_config);

        $interpreter = new Interpreter();
        $interpreter->unstrict();

        $rows = [];
        $interpreter->addObserver(function (array $row) use (&$rows) {
            $rows[] = $row;
        });

        $lexer->parse($path, $interpreter);
        foreach ($rows as $key => $value) {

            if (count($value) == 12) {
                Shop::create([
                    'name' => $value[0],
                    'description' => $value[1],
                    'category_id' => $value[2],
                    'price_min' => $value[3],
                    'price_max' => $value[4],
                    'business_hour_start' => $value[5],
                    'business_hour_end' => $value[6],
                    'address' => $value[7],
                    'phone_number' => $value[8],
                    'holiday' => $value[9],
                    'registered_at' => $value[10],
                    'image' => $value[11],

                ]);
            }
        }

        return response()->json(
            ['data' => '成功'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
    
}
