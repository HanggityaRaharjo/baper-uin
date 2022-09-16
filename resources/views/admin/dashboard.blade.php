@extends('layout.v_adminpanel')
<!-- /.content -->
@section('content')
    <h1>
        Dashboard
    </h1>
    <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-person-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Authors</span>

                    <span class="info-box-number">{{ $author }}</span>


                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion icon ion-ios-book-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data Repository</span>
                    <span class="info-box-number">{{ $repo }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Data program studi</span>
                    <span class="info-box-number">{{ $prodi }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </div>
    <!-- Background Image -->
    <h1>
        Background Image
    </h1>
    <!-- Image File -->
    <div class="row justify-content-center" style="padding-bottom:10px;">
        <!-- If No Image -->
        @if(empty($background_image))
        <h1 class="text-center">No Image</h1>

        <!-- Create Form -->
        <form action="{{ url('admin/background-image/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="col-md-12">
                <div style="margin:0 10px 0 10px;">
                    <label for="formFileLg" class="form-label">File</label>
                    <input class="form-control  form-control-lg" name="file" id="formFileLg" type="file" required>
                </div>
                <div style="margin-top:10px;" align="center">
                    <button type="submit" class="btn btn-primary" style="width:100px;">Add Image</button>
                </div>
            </div>
        </form>
        <!-- End Create Form -->

        <!-- If No Image -->
        @else
            <div class="col-md-6">
                <!-- Delete -->
                <div align="right">
                    <form action="{{ url('admin/background-image/delete/'.$background_image->id) }}"  method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <button class="btn btn-danger">Delete this image</button>
                    </form>
                </div>
                <!-- End Delete -->
                <img src="{{ asset('storage/background-image/'.$background_image->file) }}" style="width:100%;" alt="">   
            </div>
            <!-- Form -->
            <form action="{{ url('admin/background-image/update/'.$background_image->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="col-md-6">
                    <div style="margin:0 10px 0 10px;">
                        <label for="formFileLg" class="form-label">File</label>
                        <input class="form-control  form-control-lg" name="file" id="formFileLg" type="file">
                    </div>
                    <div style="margin-top:10px;" align="center">
                        <button type="submit" class="btn btn-primary" style="width:150px;">Change Image</button>
                    </div>
                </div>
                        
            </form>
            <!-- End Form -->
        @endif

    </div>
    <!-- End Image File -->
    <!-- End Background Image -->

@endsection
