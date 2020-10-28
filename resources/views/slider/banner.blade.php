@extends('layouts.back')

@section('title')
Banner Slider
@endsection

@section('page_title')
Banner Slider
@endsection

@section('css_plugins')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('top_btn')
<a href="#" class="btn btn-primary float-right" style="line-height: 22px; margin-right: 5px;">Add New Slide</a>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Posted by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Posted by</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div style="width: 150px;">
                                            <a href="#">The Most Advance Business Plan</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 200px;">
                                            <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis laboriosam deserunt ea minus eaque impedit!</span>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="{{ url('front/images/blog.jpg') }}" alt="Blog image" style="max-width: 200px; ">
                                    </td>
                                    
                                    <td>
                                         <div style="width: 100px; text-align: center;">
                                            <span class="badge badge-success">Published</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 120px; text-align: center;">
                                            <span>1 day ago</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 120px; text-align: center;">
                                            <span>1 day ago</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width:150px;">
                                            <a href="#">System Architect</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-btn d-flex">
                                            <a href="javascript:void(0);" class="waves-effect waves-float btn-sm waves-green text-black mr-2"><i class="zmdi zmdi-edit" style="line-height: 1.8;"></i></a>
                                            <form class="d-inline">
                                                <button class="waves-effect waves-float btn-sm waves-red text-black border-0"><i class="zmdi zmdi-delete" style="line-height: 1.8;"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_plugins')
<!-- Jquery DataTable Plugin Js --> 
<script src="{{ asset('back/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('back/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
@endsection

@section('custom_js')
<script src="{{ asset('back/js/pages/tables/jquery-datatable.js') }}"></script>
@endsection
