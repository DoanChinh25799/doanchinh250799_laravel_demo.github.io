<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Models\Order;
use App\Models\Models\Product;
use App\Models\Models\Transaction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user:id,name')->orderBy('id','DESC')->paginate(10);
        $viewData = [
            'transactions'=>$transactions
        ];
        return view('admin::transaction.index', $viewData);
    }

    public function viewOrder(Request $request, $id){
        if($request->ajax()){
            $orders = Order::with('product')->where('or_transaction_id',$id)->get();
            $html = view('admin::components.order',compact('orders'))->render();
            return \response()->json($html);
        }
    }

    //Xử lý trạng thái đơn hàng
    public function actionTransaction($id){
        $transaction = Transaction::find($id);
        $orders = Order::where('or_transaction_id',$id)->get();
        if($orders){
            foreach ($orders as $order){
                $product = Product::find($order->or_product_id);
                // Cập nhật lại số lượng của sản phẩm
                $product->p_amount = $product->p_amount - $order->or_qty;
                // Cập nhật số lần được mua của sản phẩm
                $product->p_pay ++;

                $product->save();
            }
        }

        // Cập nhật tổng tiền đã mua của tài khoản người dùng
        DB::table('users')->where('id',$transaction->tr_user_id)->increment('total_pay');

        // Cập nhật lại trạng thái đơn hàng

        $transaction->tr_status = Transaction::STATUS_DONE;
        $transaction->save();
        Session::flash('success','Đơn hàng đã được xử lý.');

        return redirect()->back();
    }

    public function action($action, $id){
        if($action){
            $transaction = Transaction::find($id);
            switch ($action){
                case 'delete':
                    $transaction->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
            }
        }
        return redirect()->back();
    }
}
