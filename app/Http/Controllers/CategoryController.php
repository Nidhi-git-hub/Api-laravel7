<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Category;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
    	$validator=Validator::make($request->all(),[
    		'name'=>'required',
    		'category'=>'required',
    		'brand'=>'required',
    		'desc'=>'required',
    		'image'=>'required|image',
    		'price'=>'required',
    	]);
        
    	if($validator->fails())
    	{
    		return response()->json(['error'=>$validator->errors()->all()], 409);
    	}
    	else{
    		$p = new Category();
        $p->name = $request->name;	
        $p->category = $request->category;
        $p->brand = $request->brand;
        $p->desc = $request->desc;
        $p->price = $request->price;
        $p->save();
        // php artisan storage:link 
        //config=>filesystem.php(local, public)
        //storing image

        $url="http://127.0.0.1:8000/storage/";
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        // dd($extension);
        // exit;
        $path=$request->file('image')->storeAs('proimages', $p->id.'.'.$extension);
        // dd($extension);
        // exit;    
        $p->image=$path;
        $p->imgpath=$url.$path;
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
         $user=Category::get();
        
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
    public function show($id){ //obj model ka Curd

        $user =Category::find($id);
           
        //dd($curd);
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
     public function update(Request $request){
         //print_r($request->File("image"));
         //die();
        if($request->hasFile('image'))
        {
        $p =Category::find($request->id);
        $p->name = $request->name;  
        $p->category = $request->category;
        $p->brand = $request->brand;
        $p->desc = $request->desc;
        $p->price = $request->price;
        $p->save();
        $url="http://127.0.0.1:8000/storage/";
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
          // dd($extension);
          //exit;
        $path=$request->file('image')->storeAs('proimages', $p->id.'.'.$extension);
        $p->image=$path;
          $p->imgpath=$url.$path;
          $p->save();
          
          if($p->count()){
            return response()->json($data = [
            'status' => 200,
            'msg'=>'Success',
            'p' => $p
            ]);
        }
        else{
            return response()->json($data = [
            'status' => 201,
            'msg' => 'Data Not Found'
            ]);
        }

    }
        else{
        
          
        $p =Category::find($request->id);
        $p->name = $request->name;  
        $p->category = $request->category;
        $p->brand = $request->brand;
        $p->desc = $request->desc;
        $p->price = $request->price;
        $p->save();
        //print_r($data);
         //die();
        if($p->count()){
            return response()->json($data = [
            'status' => 200,
            'msg'=>'Success',
            'p' => $p
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
 public function delete(Request $request ,$id){
        $p=Category::find($request->id)->delete();

        return response()->json(['message'=>"Product Successfully deleted"]);
        
    }
}
