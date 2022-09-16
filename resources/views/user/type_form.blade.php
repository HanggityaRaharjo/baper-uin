@extends('layout.v_userpanel')
@section('content')
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box'>
                    <div class='box-header'>

                        <h3 class='box-title'>TYPE</h3>
                        <div class='box box-primary'>
                            <form action="{{ url('/user/tambahtype/create') }}" method="post">
                                @csrf
                                <table class='table table-bordered'>
                                    <tr>
                                        <td>TYPE</td>
                                        <td><input type="text" class="form-control" name="type" id="type" placeholder="type"
                                                value="" />
                                        </td>
                                        <input type="hidden" name="id" value="" />
                                    <tr>
                                        <td colspan='2'><button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ url('user/type') }}" class="btn btn-default">Cancel</a>
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
