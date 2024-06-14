@extends('admin.layouts.master')

@section('title')
    Cập nhật sản phẩm
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin sản phẩm</h4>
                </div><!-- end card header -->
                <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="basiInput" name="name" value="{{$model->name}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Danh mục</label>
                                        <select type="text" class="form-control" id="basiInput" name="catelogue_id">
                                            <option value="" disabled selected>-Chọn danh mục-</option>
                                            @foreach($catelogues as $id=>$name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" id="basiInput" name="sku" value="{{$model->sku}}">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3">
                                    <div>
                                        <label for="basiInput" class="form-label">Ảnh sản phẩm</label>
                                        <input type="file" class="form-control" id="basiInput" name="img_thumbnail">
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-md-3">
                                    @if(! \Str::contains($model->img_thumbnail,'http') && !\Str::contains($model->img_thumbnail,'https'))
                                        <img class="img-thumbnail" alt="200x200" width="50"  src="{{\Storage::url($model->img_thumbnail)}}">
                                    @else
                                        <img class="img-thumbnail" alt="200x200" width="50"  src="{{$model->img_thumbnail}}">
                                    @endif
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Giá sản phẩm</label>
                                        <input type="number" class="form-control" id="basiInput" name="price" value="{{$model->price}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Giá giảm sản phẩm</label>
                                        <input type="number" class="form-control" id="basiInput" name="sale_price" value="{{$model->sale_price}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Mô tả</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="3">{{$model->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Chất liệu</label>
                                        <textarea name="material" class="form-control" id="" cols="30" rows="3">{{$model->material}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Hướng dẫn sử dụng</label>
                                        <textarea name="user_manual" class="form-control" id="" cols="30" rows="3">{{$model->user_manual}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Nội dung</label>
                                        <textarea name="content" id="editor" rows="10" cols="80">{{$model->content}}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <!-- Custom Outline Checkboxes -->
                                            <div class="form-check form-check-outline form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck13" name="is_active" value="1" @php if($model->is_active == 1 ){ echo "checked" }else{echo ""} @endphp>
                                                <label class="form-check-label" for="formCheck13">
                                                    Is active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <!-- Custom Outline Checkboxes -->
                                            <div class="form-check form-check-outline form-check-info mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck13" name="is_hot_deal" value="1" @if {{$model->is_active ? 1 : "checked"}}  @endif>
                                                <label class="form-check-label" for="formCheck13">
                                                    Is hot deal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <!-- Custom Outline Checkboxes -->
                                            <div class="form-check form-check-outline form-check-warning mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck13" name="is_good_deal" value="1" @if {{$model->is_active ? 1 : "checked"}}  @endif>
                                                <label class="form-check-label" for="formCheck13">
                                                    Is good deal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <!-- Custom Outline Checkboxes -->
                                            <div class="form-check form-check-outline form-check-success mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck13" name="is_new" value="1" @if {{$model->is_active ? 1 : "checked"}}  @endif>
                                                <label class="form-check-label" for="formCheck13">
                                                    Is new
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-md-2">
                                        <div>
                                            <!-- Custom Outline Checkboxes -->
                                            <div class="form-check form-check-outline form-check-danger mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck13" name="is_show_home" value="1" @if {{$model->is_active ? 1 : "checked"}}  @endif>
                                                <label class="form-check-label" for="formCheck1 3">
                                                    Is show home
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                </div><!-- end card header -->
                <div class="card-body" style="height: 300px;overflow: scroll">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <table class="table">
                                <tr>
                                    <th>Cỡ</th>
                                    <th>Màu</th>
                                    <th>Số lượng</th>
                                    <th>Ảnh</th>
                                </tr>
                                @foreach($sizes as $sizeId=>$sizeName)
                                    @foreach($colors as $colorId=>$colorName)
                                        <tr>
                                            <td>
                                                {{$sizeName}}
                                            </td>
                                            <td>
                                                <div style="height: 50px;width: 50px;background-color: {{$colorName}};border-radius: 5px;box-shadow: #051b11 0 0 5px"></div>
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" value="100" name="product_variant[{{$sizeId."-".$colorId}}][quantity]">
                                            </td>
                                            <td>
                                                <input class="form-control" type="file" name="product_variant[{{$sizeId."-".$colorId}}][image]">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thư viện ảnh</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Ảnh 1</label>
                                    <input type="file" class="form-control" id="basiInput" name="product_galleries[]">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Ảnh 2</label>
                                    <input type="file" class="form-control" id="basiInput" name="product_galleries[]">
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thẻ</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="basiInput" class="form-label">Chọn thẻ</label>
                                    <select class="form-control" id="basiInput" name="tags[]" multiple>

                                        @foreach($tags as $id=>$name)
                                            <option value="{{$id}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-secondary mb-3" href="{{route('admin.catelogues.index')}}">Quay lại</a>
                            <button type="submit" class="btn btn-primary  mb-3 ms-2">Tạo</button>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor');
    </script>
@endsection

