<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Notifications\OrderNotify;
use Illuminate\Support\Facades\Notification;

class EsewaController extends Controller
{
    
    public function esewaSuccess(Request $request){
        $data=$request->all();
        $order=Order::where('order_id',$data['oid'])->first();
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
            'amt'=> $order->total,
            'rid'=> $data['refId'],
            'pid'=>$data['oid'],
            'scd'=> 'EPAYTEST'
        ];
        
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
           
            curl_close($curl);
            if(str_contains($response,'Success')){
                $order->online_res=$response;
                $order->save();
                $cart=session()->get('cart',[]);
                
                foreach($cart as $item){
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
                
                $data['name']=$order->name;
                $data['email']=$order->email;
                $data['phone']=$order->phone;
                $data['address']=$order->address;
                $data['pincode']=$order->pincode;
                $data['payment_mode']=$order->payment_mode;
                Notification::route('mail', 'admin@gmail.com')->notify(new OrderNotify($data));
                Notification::send( User::where('id',10)->first(), new OrderPlacedNotify());

                return redirect()->route('thankyou')->with('message','Your Order successfully Placed ');
            }else{
              
                $orderItem =OrderItem::where('order_id',$order->id)->first();
                if($orderItem){
                    $orderItem->delete();
                }
                $order->delete();
                return redirect()->back()->with('message','Something Going Wrong!,');
            }
        
    }
    public function esewaFailure(Request $request,$orderId){
      $order=Order::find($orderId);
      if($order){
        $order->delete();
          return redirect()->back()->with('message','Something Going Wrong!, Try Agan');
        }
      
    }
  
}
