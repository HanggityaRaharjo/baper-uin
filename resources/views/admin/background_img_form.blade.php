@extends('layout.v_adminpanel')
<!-- /.content -->
@section('content')
    <a href="{{ url('admin/dashboard') }}" class="btn btn-danger" style="margin-top: 10px;">Back</a>
    <h1>
        Background Image
    </h1>
    <!-- Image File -->
    <div class="row justify-content-center" style="margin-bottom:10px;">
        <!-- Form -->
        <form action="{{ url('admin/background-image/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="col-md-6">
                <div style="margin:0 10px 0 10px;">
                    <label for="formFileLg" class="form-label">Large file input example</label>
                    <input class="form-control  form-control-lg" name="file" id="formFileLg" type="file">
                </div>
                <div style="margin-top:10px;" align="center">
                    <button type="submit" class="btn btn-primary" style="width:100px;">Change</button>
                    <button class="btn btn-danger" style="width:100px;">Delete</button>
                </div>
            </div>
        </form>
        <!-- End Form -->
        <div class="col-md-6">
            <img src="{{ asset('storage/background-image/') }}" style="width: 600px;" alt="">    
        </div>
    </div>
@endsection
