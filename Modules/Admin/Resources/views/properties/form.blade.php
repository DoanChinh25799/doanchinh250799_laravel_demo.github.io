<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-8 offset-2">
            <div class="form-group">
                <label for="p_barcode">Tên thuộc tính</label>
                <input type="text" name="pro_name" class="form-control" placeholder="tên thuộc tính"
                       value="{{old('pro_name', isset($property->pro_name)?$property->pro_name:'')}}">
                @error('pro_name')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p_name">Ghi chú</label>
                <input type="text" name="pro_note" class="form-control" placeholder="tên sản phẩm"
                       value="{{old('pro_note', isset($property->pro_note)?$property->pro_note:'')}}">
                @error('pro_note')
                <hr>
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="float: right; margin-right: 200px">Cập nhật thông tin</button>
</form>

