<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\Slug;
use Session;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\Contact;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use App\Client;
use Log;
use DB;
use Hash;

class PageController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
        /*$total_new = Product::where( 'new' , 1 )->get();
    	$new_product = Product::where( 'new' , 1 )->paginate(8);*/
        $types = ProductType::all();
        $khuyenmai = Product::where('promotion_price', '<>',0)->paginate(8);
    	$khuyenmai_total = Product::where('promotion_price', '<>',0)->get();
    	return view('page.trangchu',compact('slide','types','khuyenmai_total','khuyenmai'));
    }
    // public function getLoaiSp($type){
    //     $sp_theoloai = Product::where('id_type', $type)->get();
    //     $sp_khac = Product::where('id_type','<>', $type)->paginate(8);
    //     $loai = ProductType::all();
    //     return view('page.loaisanpham', compact('sp_theoloai','sp_khac','loai'));
    // }
    public function getContent($slug){
        $model = Slug::where('slug',$slug)->first();
        if(!$model){
            return '403 not-found';
        }
        switch ($model->entity_type) {
            case ENTITY_TYPE_TYPE:
                $loai = ProductType::all();
                $type = ProductType::find($model->entity_id);
                $product = Product::where('id_type',$model->entity_id)->paginate(6);
                $other = Product::where('id_type','<>', $model->entity_id)->paginate(6);
                return view('page.loaisanpham', compact('loai','type', 'product','other'));

                case ENTITY_TYPE_PRODUCT:
                $product = Product::find($model->entity_id);
                $same = Product::where('id_type',$product->id_type)->paginate(3);
                return view('page.chitietsp', compact('product','same'));
            
            default:
                # code...
                break;
        }
    }
    // public function getChitiet(Request $req){
    //     $sanpham = Product::where('id', $req->id)->first();
    //     $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
    //     return view('page.chitietsp', compact('sanpham','sp_tuongtu'));
    // }
    public function getLienhe(){
        return view('page.lienhe');
    }
    public function getGioithieu(){
    	return view('page.gioithieu');
    }
    public function getAddtoCart(Request $rq, $id){
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $rq->session()->put('cart', $cart);
        return redirect()->back();

    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->item) > 0)
        {
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        
        return redirect()->back();
    }
    public function getCheckout(){
        return view('page.dathang');
    }
    public function postCheckout(Request $rq){
        $cart = Session::get('cart');
        $customer = new Customer();
        $customer->name = $rq->name;
        $customer->gender = $rq->gender;
        $customer->email = $rq->email;
        $customer->address = $rq->address;
        $customer->phone_number = $rq->phone;
        $customer->note = $rq->notes;
        $customer->save();
        
        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $rq->payment_method;
        $bill->note = $rq->notes;
        $bill->save();

        foreach ($cart['items'] as $key => $value) {
            // dd($value-);
            $billdetail = new BillDetail();
            $billdetail->id_bill = $bill->id;
            $billdetail->id_product = $key;
            $billdetail->quantity = $value['qty'];
            $billdetail->unit_price = $value['price']/$value['qty'];
            $billdetail->save();

        }

        Session::forget('cart');
        
        return redirect()->route('send.mail', ['customer'=>$customer, 'bill'=>$bill]);
    }
    public function Signup(SignupRequest $rq){
        Log::info('BEGIN ' 
            . get_class() . ' => ' . __FUNCTION__ . '()');
        DB::beginTransaction();
        try{
            $client = new Client();
            $client->fill($rq->all());
            $client->password = Hash::make($rq->password);
            $client->save();
            DB::commit();
            Log::info('END ' 
                . get_class() . ' => ' . __FUNCTION__ . '()');
            return redirect(route('login'));
        }catch(\Exception $ex){
            Log::error('END ' 
            . get_class() . ' => ' . __FUNCTION__ . '() - ' . $ex->getMessage());
            DB::rollback();
            return false;
        }

    }
    public function Search(Request $rq){
        $keyword = $rq->key;
        $product = Product::where('name','like', "%$keyword%")->orWhere('unit_price',$keyword)->get();
        return view('page.search',compact('product','keyword')); 
    }
    public function Contact(Request $rq){
        $model = new Contact();
        $model->name = $rq->name;
        $model->email = $rq->email;
        $model->subject = $rq->subject;
        $model->message = $rq->message;
        $model->save();
        return view('page.success');


    }
}
