<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;

class ProductController extends Controller
{
    public function add(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'name'=>'required',
    		'category'=>'required',
    		'brand'=>'required',
    		'desc'=>'required',
    		// 'image'=>'required|image',
    		'price'=>'required',
    	]);
        
    	if($validator->fails())
    	{
    		return response()->json(['error'=>$validator->errors()->all()], 409);
    	}
    	else{
    		$p = new product();
        $p->name = $request->name;	
        $p->category = $request->category;
        $p->brand = $request->brand;
        $p->desc = $request->desc;
        $p->price = $request->price;
        $p->save();

        if($p){
                return response()->json($data=[
                'status'=>200,
                'msg'=>'User Registration Successfull',
                
            ]);
        }
        else{
                return response()->json($data=[
                'status'=>203,
                'msg'=>'something went wrong'
               ]);
            } 
        


    	}
    }
     public function allData(Request $req)
    {
         $user=product::get();
        
        if($user->count()){
            return response()->json($data = [
            'status' => 200,
            'msg'=>'Success',
            'product' => $user
            ]);
        }
        else{
            return response()->json($data = [
            'status' => 201,
            'msg' => 'Data Not Found'
            ]);
        }
    }
}
