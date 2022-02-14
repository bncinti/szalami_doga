<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController{

    public function index(){
        $product = Product::all();
        return $this->sendResponse(ProductResource::collection($product),"Termékek betöltve");
    }

    public function store(Request $request){
        $input = $request->all();
        
        $validator = Validator::make($input, [
            "name" => "required",
            "price" => "required",
            "raw_material" => "required",
            "production_time" => "required"
        ]);
    
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $product = Product::create($input);
        return $this->sendResponse(new ProductResource($product),"Sikeres termékfelvétel");
    }

    public function show($id){
        $product = Product::find($id);
        if( is_null($product)){
            return $this->sendError("Nem található");
        }
        return $this->sendResponse(new ProductResource($product), "Termék betöltve");
    }

    public function update(Request $request, Product $product ) {
        $input = $request->all();
        $validator = Validator::make($input, [
            "name" => "required",
            "price" => "required",
            "raw_material" => "required",
            "production_time" => "required"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $product->name = $input["name"];
        $product->price = $input["price"];
        $product->raw_material = $input["raw_material"];
        $product->production_time = $input["production_time"];
        $product->save();
        return $this->sendResponse(new ProductResource($product), "Termék adatai frissítve");
    }

    public function destroy($id){
        Product::destroy($id);
        return $this->sendResponse( [], "Törölve");
    }

    public function search($name){
        $product = Product::where("name", "like", "%".$name."%")->get();
        if(count($product)==0){
            return $this->sendError("Nincs találat");
        }
        return $this->sendResponse($product, "Sikeres találat");
    }

    public function filter($raw_material){
        $product = Product::where("raw_material", "=", $raw_material)->get();
        if(count($product)==0){
            return $this->sendError("Nincs ilyen alapanyag");
        }
        return $this->sendResponse($product, "Sikeres találat");
    }
}
