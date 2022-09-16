@extends('layout.v_adminpanel')
@section('content')
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box'>
                    <div class='box-header'>

                        <h3 class='box-title'>UBAH PASSWORD</h3>
                        <div class='box box-primary'>
                            <form action="{{ route('updatepassword') }}" method="post">
                                @csrf
                                <table class='table table-bordered'>
                                    <tr>
                                        <td>current password </td>
                                        <td><input type="password" class="form-control" name="current_password"
                                                placeholder="current_password" />
                                            @error('current_password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>


                                    <tr>
                                    <tr>
                                        <td>new Password </td>
                                        <td><input type="password" class="form-control" name="password"
                                                placeholder="password" />
                                            @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>


                                    <tr>
                                    <tr>
                                        <td>confirm Password </td>
                                        <td><input type="password" class="form-control" name="password_confirmation"
                                                placeholder="password" />
                                            @error('password_confirmation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>


                                    <tr>
                                        <td colspan='2'><button type="submit" class="btn btn-primary">submit</button>
                                            <a href="" class="btn btn-default">Cancel</a>
                                        </td>
                                    </tr>

                                </table>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
