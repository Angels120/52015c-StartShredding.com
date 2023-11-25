<?php

namespace App\Http\Controllers;

use App\OrderTemplateItem;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Redirect;

class OrderTemplateItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        OrderTemplateItem::whereOrderTemplateId($data['template_id'])->each(function ($templateItem, $key) {
            $templateItem->delete();
        });



        if(!empty($data['item'])){
            foreach ($data['item'] as $item){
                $item['order_template_id'] = $data['template_id'];
                OrderTemplateItem::create($item);
            }
        }
        if(!empty($data['existingitem'])){
            foreach ($data['existingitem'] as $item){
                $item['order_template_id'] = $data['template_id'];
                OrderTemplateItem::create($item);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderTemplateItem  $orderTemplateItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTemplateItem $orderTemplateItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderTemplateItem  $orderTemplateItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTemplateItem $orderTemplateItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderTemplateItem  $orderTemplateItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderTemplateItem $orderTemplateItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderTemplateItem  $orderTemplateItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTemplateItem $orderTemplateItem)
    {
        //
    }

    public function getProductPrice(Request $request){
        $product = Product::whereId($request->id)->first();
        return json_encode($product);
    }
}
