@extends('admin.layouts.master')

@section('title')
    Chi tiết danh mục
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
                    @foreach($data->toArray() as $key => $value)
                        <tr>
                            <td>{{$key}}</td>
                            <td>
                                @if($key == "is_active")
                                    @if($value == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                @elseif($key == "cover")
                                    <img src="{{ \Storage::url($value) }}" width="100" alt="">
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
    <a class="btn btn-secondary" href="{{route('admin.catelogues.index')}}">Quay lại</a>

@endsection

