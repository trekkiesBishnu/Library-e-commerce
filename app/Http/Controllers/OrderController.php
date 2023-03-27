<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Status;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Notifications\OrderNotify;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderFormRequest;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\OrderPlacedNotify;

class OrderController extends Controller
{
    public function checkout(){
        $totalPrice=0;
        $cart=session()->get('cart',[]);
        foreach($cart as $id=> $item){
            $totalPrice +=$item['quantity']*$item['price'];
        }
        return view('frontend.checkout',compact('totalPrice'));
    }
    public function orderAdded(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'phone'=>'required|integer',
            'address'=>'required',
            'pincode'=>'required|integer',
            'payment_mode'=>'required',
            'order_id'=>'nullable',
            'total'=>'nullable',
            'online_res'=>'nullable'

        ]);
        $cart=session()->get('cart',[]);

        $totalOI=0;
        foreach($cart as $cartItem){
            $totalOI +=$cartItem['price']*$cartItem['quantity'];
        }
       
        $order=Order::create([
            'user_id'=>Auth::user()->id,
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'phone'=>$data['phone'],
            'address'=>$data['address'],
            'pincode'=>$data['pincode'],
            'status_message'=>'in progress',
            'payment_mode'=>$data['payment_mode'],
            'order_id'=>random_int(1000000000,9999999999999),
            'total'=>$totalOI,
        ]);
       
        if($data['payment_mode']=='COD'){
            foreach($cart as  $item){
                $orderItem=OrderItem::create([
                    'order_id'=>$order->id,
                    'book_id'=>$item['id'],
                    'quantity'=>$item['quantity'],
                    'price'=>$item['price'],
                    
                ]);
                    $book=Book::find($item['id']);
                    $book->quantity -=$item['quantity'];
                    $book->save();
                    session()->forget('cart');
                }
                $test['order_id']=$order->id;
                $test['title']="Order Placed";
                $test['name']=Auth::user()->name;
                $test['email']=Auth::user()->email;
                $test['phone']=$data['phone'];
                $test['address']=$data['address'];
                $test['pincode']=$data['pincode'];
                $test['status_message']='in progress';
                $test['payment_mode']=$data['payment_mode'];
                $test ['total']=$totalOI;

                Notification::route('mail', 'admin@gmail.com')->notify(new OrderNotify($data));
                Notification::send( User::where('id',10)->first(), new OrderPlacedNotify($test));
        
            }
        
       
        
        if($data['payment_mode']=='ESEWA'){
            $total=$order->total;
            $orderId=$order->id;
            $pid=$order->order_id;
            
 
            return view('frontend.esewa.redirect',compact('total','pid','orderId'));
        }
        return redirect()->route('thankyou')->with('message','Your Order successfully Placed ');
    }
    public function thankyou(){
        return view ('frontend.thankyou');
    }
    public function orderList(){
        $status=Status::all();
        $order=Order::all();
       
        return view('frontend.order.order',compact('order','status'));
    }
    public function orderItemList(){
        $order=OrderItem::all();
        return view('frontend.order.orderItem',compact('order'));
    }
    // public function orderviewDelete($id){
    //     $order=Order::find($id);
    // }
    public function orderview($id){
        // $order=Order::find($id);
        $orders=Order::where('id',$id)->first();
        return view('frontend.order.orderItem',compact('orders'));

    }
    public function deleteOrderItem($id){
        $order=OrderItem::find($id);
       if($order){
           $order->delete();
           return redirect()->back()-with('message','OrderItem deleted successfully');
       }
    }
    public function statusChangeOrder(Request $request, $id){
        $order=Order::find($id);
        $order->status_message=$request->status_message;
        $order->save();
        return redirect()->back();

    }

    protected function validate_data($data , $rules){
        $common_ctrl = new CommonController();
        return $common_ctrl->validator($data,$rules);

    }
    public function filter_order(Request $request){
        $status=Status::all();
        $todayDate=Carbon::now()->format('Y-m-d');
        $order=Order::when($request->date!=null,function ($q) use($request) {
            return $q->whereDate('created_at',$request->date);
        })->when($request->status !=null,function ($q) use($request){
            return $q->where('status_message',$request->status);
        })->get();
        return view('frontend.order.order',compact('order','status'));
    }
}
