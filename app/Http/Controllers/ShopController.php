<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
    $keyword = $request->input('keyword');       // 店舗名キーワード
    $category_id = $request->input('category');  // カテゴリID
    $budget = $request->input('budget');

    $query = Shop::with('category');
    $category = null;

    // 店舗名での検索
    if (!empty($keyword)) {
        $query->where('name', 'like', '%' . $keyword . '%');
    }

    // カテゴリIDでの絞り込み
    if (!empty($category_id)) {
        $query->where('category_id', $category_id);
        $category = Category::find($category_id); // タイトルに表示用
    }
    
    // 予算での検索
    if (!empty($budget)) {
        if (str_contains($budget, '-')) {
            [$min, $max] = explode('-', $budget);
            $min = (int)$min;
            $max = $max !== '' ? (int)$max : null;
            if ($max !== null) {
                $query->whereBetween('price_min', [$min, $max]);
            } else {
                $query->where('price_min', '>=', $min);
            }
        }
    }

    $shops = $query->sortable()->paginate(4);
    $total_count = $shops->total();

    $categories = Category::all();

    return view('shops.index', compact(
        'shops',
        'category',
        'categories',
        'total_count',
        'keyword',
        'budget'
    ));
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = Category::all();
 
        return view('shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->price_min = $request->input('price_min');
        $shop->price_max = $request->input('price_max');
        $shop->business_hour_start = $request->input('business_hour_start');
        $shop->business_hour_end = $request->input('business_hour_end');
        $shop->postal_code = $request->input('postal_code');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->holiday = $request->input('holiday');
        $shop->registered_at = now()->toDateString();
        $shop->category_id = $request->input('category_id');
        $shop->save();

        return to_route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();
        return view('shops.show', compact('shop', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $categories = Category::all();
 
        return view('shops.edit', compact('shop', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->price_min = $request->input('price_min');
        $shop->price_max = $request->input('price_max');
        $shop->business_hour_start = $request->input('business_hour_start');
        $shop->business_hour_end = $request->input('business_hour_end');
        $shop->postal_code = $request->input('postal_code');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->holiday = $request->input('holiday');
        $shop->registered_at = $request->input('registered_at');
        $shop->category_id = $request->input('category_id');
        $shop->save();

        return to_route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return to_route('shops.index');
    }
}
