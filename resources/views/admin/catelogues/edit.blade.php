@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục
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
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới danh mục</h4>
                </div><!-- end card header -->
                <form action="{{route('admin.catelogues.update',$model->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" id="basiInput" name="name" value="{{$model->name}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Ảnh danh mục</label>
                                        <input type="file" class="form-control" id="basiInput" name="cover">
                                        <img class="img-thumbnail" alt="200x200" width="200" src="{{\Storage::url($model->cover)}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <!-- Custom Outline Checkboxes -->
                                        <div class="form-check form-check-outline form-check-primary mb-3">
                                            <input class="form-check-input" type="checkbox" id="formCheck13" name="is_active" value="1" @if($model->is_active) checked @endif>
                                            <label class="form-check-label" for="formCheck13">
                                                Muốn kích hoạt
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <a class="btn btn-secondary mb-3" href="{{route('admin.catelogues.index')}}">Quay lại</a>
                                    <button type="submit" class="btn btn-primary  mb-3 ms-2">Cập nhật</button>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
