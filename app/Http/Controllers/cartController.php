<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\cart;
use App\catagory;
use DB;
use App\User;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singlecart($id,request $request)
    {
                $user_id=Auth::id();
                if($user_id==null){
                    return view("auth.login");
                }
         //jodi ei product age ekber add kora takhe tahole update korbe
              $cart_cheke=cart::where('p_id',$id)->where('user_id',$user_id)->count();

        if($cart_cheke){
                cart::where('p_id',$id)->where('user_id',Auth::id())->increment('quantity',1); 
                return redirect()->back()->with('success','data insert successfully');           
        }
        //naile insert korbe
        else{
          cart::insert([
                'p_id'=>$id,
                'user_id'=>$user_id,
                'quantity'=> 1,
        ]);
        }
        return back()->with("");
    }




    public function viewcart($code=''){

               $catagories=catagory::all();
        $total=0;
        $dis_amount=0;
        $dis_total=0;
                 $user_id=Auth::id();
                if($user_id==null){
                    return view("auth.login");
                }


         $user_info= DB::table('users')->where('id', $user_id)->select('role')->pluck('role')->first();
               

        if($user_info=='Dealer'){

                     if($code==''){

                    $v =cart::where('user_id',Auth::id())->get();
        
            foreach ($v as $value) {
                $total += $value->product->d_price*$value->quantity;
                

        }
             $view=DB::table('carts')
              ->join('products','carts.p_id','products.id')
              ->where('user_id',Auth::id())
                ->select('carts.*','products.p_name','products.p_image','products.d_price')
              ->get();

              $busket=DB::table('carts')
                    ->join('products','carts.p_id','products.id')
                    ->where('user_id',Auth::id())
                    ->select('carts.*','products.p_name','products.p_image','products.d_price')
                    ->get();
            

                $dis_total=$total;
        session(['dis_amount' => $dis_amount , 'total' => $total,'discount_total' => $dis_total]);

        return view('cart.viewcartforDealer',compact('viewcart','view','v','coupon','total','dis_amount','dis_total','catagories','busket'));
        }

        else{

        return view('cart.viewcartforDealer',compact('catagories'));

        }

        }




        if($user_info=='shopper'){


                     if($code==''){

                    $v =cart::where('user_id',Auth::id())->get();
        
            foreach ($v as $value) {
                $total += $value->product->s_price*$value->quantity;
                

        }
             $view=DB::table('carts')
              ->join('products','carts.p_id','products.id')
              ->where('user_id',Auth::id())
                ->select('carts.*','products.p_name','products.p_image','products.s_price')
              ->get();

              $busket=DB::table('carts')
                    ->join('products','carts.p_id','products.id')
                    ->where('user_id',Auth::id())
                    ->select('carts.*','products.p_name','products.p_image','products.s_price')
                    ->get();
            

                $dis_total=$total;
        session(['dis_amount' => $dis_amount , 'total' => $total,'discount_total' => $dis_total]);

        return view('cart.viewcartforshopper',compact('viewcart','view','v','coupon','total','dis_amount','dis_total','catagories','busket'));
        }

        else{

        return view('cart.viewcartforshopper',compact('catagories'));

        }



        }







        if($user_info=='shopper'){


                     if($code==''){

                    $v =cart::where('user_id',Auth::id())->get();
        
            foreach ($v as $value) {
                $total += $value->product->s_price*$value->quantity;
                

        }
             $view=DB::table('carts')
              ->join('products','carts.p_id','products.id')
              ->where('user_id',Auth::id())
                ->select('carts.*','products.p_name','products.p_image','products.s_price')
              ->get();

              $busket=DB::table('carts')
                    ->join('products','carts.p_id','products.id')
                    ->where('user_id',Auth::id())
                    ->select('carts.*','products.p_name','products.p_image','products.s_price')
                    ->get();
            

                $dis_total=$total;
        session(['dis_amount' => $dis_amount , 'total' => $total,'discount_total' => $dis_total]);

        return view('cart.viewcartforshopper',compact('viewcart','view','v','coupon','total','dis_amount','dis_total','catagories','busket'));
        }

        else{

        return view('cart.viewcartforshopper',compact('catagories'));

        }



        }






        if($user_info=='whole'){


                     if($code==''){

                    $v =cart::where('user_id',Auth::id())->get();
        
            foreach ($v as $value) {
                $total += $value->product->w_price*$value->quantity;
                 }

             $view=DB::table('carts')
              ->join('products','carts.p_id','products.id')
              ->where('user_id',Auth::id())
                ->select('carts.*','products.p_name','products.p_image','products.w_price')
              ->get();

              $busket=DB::table('carts')
                    ->join('products','carts.p_id','products.id')
                    ->where('user_id',Auth::id())
                    ->select('carts.*','products.p_name','products.p_image','products.w_price')
                    ->get();
            

                $dis_total=$total;
        session(['dis_amount' => $dis_amount , 'total' => $total,'discount_total' => $dis_total]);

        return view('cart.viewcartforwhole',compact('viewcart','view','v','coupon','total','dis_amount','dis_total','catagories','busket'));
        }

        else{

        return view('cart.viewcartforwhole',compact('catagories'));

        }



        }
















     }       




      public function updatecart(Request $request)
  {
        foreach ($request->id as $key => $value) {
               cart::findOrFail($value)->update([
                
                    'quantity' => $request->quantity[$key]
                ]);

               }
               return back();  
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
