<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_barcode">Mã vạch</label>
                <input type="text" name="p_barcode" class="form-control" placeholder="mã vạch"
                       value="{{old('p_barcode', isset($product->p_barcode)?$product->p_barcode:'')}}">
                @error('p_barcode')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p_name">Tên sản phẩm</label>
                <input type="text" name="p_name" class="form-control" placeholder="tên sản phẩm"
                       value="{{old('p_name', isset($product->p_name)?$product->p_name:'')}}">
                @error('p_name')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p_description">Giới thiệu</label>
                <textarea name="p_description" class="form-control" placeholder="giới thiệu ngắn về sản phẩm" cols="30"
                          rows="3">{{old('p_description', isset($product->p_description)?$product->p_description:'')}}</textarea>
            </div>
            <div class="form-group">
                <label for="p_content">Nội dung sản phẩm</label>
                <textarea id="p_content" name="p_content" class="form-control" placeholder="mô tả sản phẩm" cols="30"
                          rows="5" >{{old('p_content', isset($product->p_content)?$product->p_content:'')}}</textarea>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="p_meta_title">Meta Title</label>--}}
{{--                <input type="text" name="p_meta_title" class="form-control" placeholder="meta title"--}}
{{--                       value="{{old('p_meta_title', isset($product->p_title_seo)?$product->p_title_seo:'')}}">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="p_meta_description">Meta Description</label>--}}
{{--                <input type="text" name="p_meta_description" class="form-control" placeholder="meta description"--}}
{{--                       value="{{old('p_meta_description', isset($product->p_description_seo)?$product->p_description_seo:'')}}">--}}
{{--            </div>--}}
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_category_id">Loại sản phẩm</label>
                <select name="p_category_id" id="" class="form-control">
                    <option value="">---Chọn loại sản phẩm---</option>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}"{{old('p_categories_id', (isset($product->p_category_id)?$product->p_category_id:'') == $category->id ? "selected = 'selected'":"")}}>
                                {{$category->c_name}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('p_category_id')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm">
                        <label for="color_id">Màu sắc</label>
                        <select name="color_id" id="" class="form-control">
                            <option value="">---Chọn màu sắc---</option>
                            @if(isset($colors))
                                @foreach($colors as $color)
                                    <option
                                        value="{{$color->id}}"{{old('color_id', (isset($product->color_id)?$product->color_id:'') == $color->id ? "selected = 'selected'":"")}}>
                                        {{$color->color_name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('color_id')
                        <hr>
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm">
                        <label for="size_id">Kích thước</label>
                        <select name="size_id" id="" class="form-control">
                            <option value="">---Chọn kích thước---</option>
                            @if(isset($sizes))
                                @foreach($sizes as $size)
                                    <option
                                        value="{{$size->id}}"{{old('size_id', (isset($product->size_id)?$product->size_id:'') == $size->id ? "selected = 'selected'":"")}}>
                                        {{$size->size_name}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('size_id')
                        <hr>
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="p_parent">Sản phẩm cha</label>
                <select name="p_parent" id="" class="form-control">
                    <option value="">---Chọn sản phẩm cha---</option>
                    @if(isset($products))
                        @foreach($products as $pro_parent)
                            <option
                                value="{{$pro_parent->id}}"{{old('p_parent', (isset($product->p_parent)?$product->p_parent:-1) == $pro_parent->id ? "selected = 'selected'":"")}}>
                                {{$pro_parent->p_name}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="p_img">Ảnh minh họa</label>
                <input id="input_img" type="file" name="p_img" class="form-control" placeholder="ảnh minh họa" onchange="readURL(this)" value="{{old('p_img',isset($product->p_img)?get_image($product->p_img):'')}}">
            </div>
            <div class="form-group">
                @if(isset($product->p_img))
                <img id="output_img" src="{{pare_url_file($product->p_img)}}" alt="" style="width: 200px; height: 100%">
                @else
                    <img id="output_img" src="{{asset('images/img-default.jpg')}}" alt="" style="width: 200px; height: 100%">
                @endif
            </div>
            <div class="form-group">
                <label for="p_purchase_price">Giá nhập</label>
                <input type="number" name="p_purchase_price" class="form-control" placeholder="giá nhập" value="{{old('p_purchase_price', isset($product->p_purchase_price)?$product->p_purchase_price:'')}}">
                @error('p_purchase_price')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p_sale_price">Giá bán</label>
                <input type="number" name="p_sale_price" class="form-control" placeholder="giá bán" value="{{old('p_sale_price', isset($product->p_sale_price)?$product->p_sale_price:'')}}">
                @error('p_sale_price')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p_promotion">Khuyến mại(%)</label>
                <input type="number" name="p_promotion" class="form-control" placeholder="khuyến mãi" value="{{old('p_promotion', isset($product->p_promotion)?$product->p_promotion:0)}}">
            </div>
            <div class="form-group">
                <label for="p_amount">Số lượng</label>
                <input type="number" name="p_amount" class="form-control" placeholder="số lượng" value="{{old('p_amount', isset($product->p_amount)?$product->p_amount:'')}}">
            </div>

        </div>
    </div>

    <button type="submit" class="btn btn-primary" style="float: right">Cập nhật thông tin</button>
</form>

@section('ckeditor')
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('p_content',{
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });
    </script>
@stop
