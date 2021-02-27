@if($orders)
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>STT</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Giảm giá</th>
            <th>Thành tiền</th>
{{--            <th>Thao tác</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key => $order)
            <tr>
                <td>#{{$key+1}}</td>
                <td>
                    <img style="width: 100px; height: 80px" src="{{isset($order->product->p_img)?pare_url_file($order->product->p_img):''}}">
                </td>
                <td><a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($order->product->p_name), $order->or_product_id])}}" target="_blank">{{isset($order->product->p_name)?$order->product->p_name:''}}</a></td>
                <td>{{$order->or_qty}}</td>
                <td>{{number_format($order->or_price,0,',','.')}}đ</td>
                <td>{{$order->or_sale}}%</td>
                <td>{{number_format($order->or_price*(1-$order->or_sale/100)*$order->or_qty,0,',','.')}}đ</td>
{{--                <td>--}}
{{--                    <div class="edit-delete">--}}
{{--                        <a href="">  <i class="fas fa-trash"></i>  Xóa</a>--}}
{{--                    </div>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
