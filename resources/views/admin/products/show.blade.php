@extends('admin.layouts.master')

@section('title')
    Chi tiết sản phẩm
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
                    <h4 class="card-title mb-0 flex-grow-1">Chi tiết danh mục</h4>
                </div><!-- end card header -->
                <table class="table">
                    <tr>
                        <th>Trường</th>
                        <th>Dữ liệu</th>
                    </tr>
                    @foreach($dataProduct->toArray() as $key => $value)
                        <tr>
                            <td>{{$key}}</td>
                            <td>
                                @if($key == "is_active")
                                    @if($value == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                @elseif($key == "img_thumbnail")
                                    @if(! \Str::contains($key == "img_thumbnail",'http') && \Str::contains($key == "img_thumbnail",'https'))
                                        <img class="img-thumbnail" alt="200x200" width="150"  src="{{\Storage::url($value)}}">
                                       @else
                                        <img class="img-thumbnail" alt="200x200" width="150"  src="{{$value}}">
                                    @endif
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 300px;overflow: scroll">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                </div><!-- end card header -->
                <table class="table" >
                    <tr>
                        <th>ID</th>
                        <th>ID sản phẩm</th>
                        <th>ID màu</th>
                        <th>ID size</th>
                        <th>Số lượng</th>
                        <th>Ảnh</th>
                    </tr>
                    @foreach($dataProductVariant->toArray() as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['product_id']}}</td>
                                <td>{{$item['product_color_id']}}</td>
                                <td>{{$item['product_size_id']}}</td>
                                <td>{{$item['quantity']}}</td>
                                <td> @if(! \Str::contains($item['image'],'http') && \Str::contains($item['image'],'https'))
                                        <img class="img-thumbnail" alt="200x200" width="50"  src="{{\Storage::url($item['image'])}}">
                                    @else
                                        <img class="img-thumbnail" alt="200x200" width="50"  src="{{$item['image']}}">
                                    @endif</td>
                            </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 300px;overflow: scroll">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thư viện ảnh</h4>
                </div><!-- end card header -->
                <table class="table" >
                    <tr>
                        <th>ID</th>
                        <th>ID sản phẩm</th>
                        <th>Ảnh</th>
                    </tr>
                    @foreach($dataProductGalleries->toArray() as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td>{{$item['product_id']}}</td>
                            <td> @if(! \Str::contains($item['image'],'http') && \Str::contains($item['image'],'https'))
                                    <img class="img-thumbnail" alt="200x200" width="50"  src="{{\Storage::url($item['image'])}}">
                                @else
                                    <img class="img-thumbnail" alt="200x200" width="50"  src="{{$item['image']}}">
                                @endif</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thẻ</h4>
                </div><!-- end card header -->
                <div class="d-flex mb-3 mt-3">
                    @foreach($dataProductTag as $item)
                            <div class="ms-4">
                                <span class="badge bg-primary" style="font-size: 20px">{{$item['tags'][0]['name']}}</span>
                            </div>
                    @endforeach
            </div >
            </div>
        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="{{route('admin.products.index')}}">Quay lại</a>

@endsection


