@extends('layout.v_userpanel')
@section('content')
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box'>
                    <div class='box-header'>

                        <h3 class='box-title'>AUTHORS</h3>
                        <div class='box box-primary'>
                            <form action="{{ url('/user/tambahauthor/create') }}" method="post">
                                @csrf
                                <table class='table table-bordered'>
                                    <tr>
                                        <td>Author </td>
                                        <td><input type="text" class="form-control" name="author" id="author"
                                                placeholder="Author" value="" />
                                        </td>
                                        <input type="hidden" name="id" value="" />
                                    <tr>
                                        <td colspan='2'><button type="submit" class="btn btn-primary">submit</button>
                                            <a href="{{ url('user/author') }}" class="btn btn-default">Cancel</a>
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
