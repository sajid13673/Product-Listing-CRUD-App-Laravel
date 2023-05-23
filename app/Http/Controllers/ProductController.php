<?php

namespace App\Http\Controllers;
use App\Models\Product;
use domain\Facades\ProductFacade;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $item;
    public function __construct(){
        $this->item = new Product();
    }
    public function index(){
        $response['items'] = ProductFacade::all();
        return view('pages.product.index')->with($response);
    }
    public function store(Request $request){
        ProductFacade::store($request);
        return redirect()->back();
    }
    public function delete($item_id){
        ProductFacade::delete($item_id);
        return redirect()->back();

    }
    public function edit(Request $request){
        $response['item'] = ProductFacade::get($request['item_id']);
        return view('pages.product.edit')->with($response);
    }
    public function update(Request $request, $item_id){
        ProductFacade::update($request->all(), $item_id);
        return redirect()->back();
    }
    public function status($item_id){
        ProductFacade::status($item_id);
        return redirect()->back();
    }
}
 