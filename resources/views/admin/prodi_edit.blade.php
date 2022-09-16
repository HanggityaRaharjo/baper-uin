@extends('layout.v_adminpanel')
@section('content')
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box'>
                    <div class='box-header'>

                        <h3 class='box-title'>PROGRAM STUDI</h3>
                        <div class='box box-primary'>
                            <form action="{{ url('/admin/editprodi/update') }}/{{ $prodi->id }}" method="post">
                                @csrf
                                <table class='table table-bordered'>
                                    <tr>
                                        <td>PROGRAM STUDI </td>
                                        <td><input type="text" class="form-control" name="prodi" id="prodi"
                                                placeholder="prodi" value="{{ $prodi->prodi }}" />
                                        </td>
                                        <input type="hidden" name="id" value="" />
                                    <tr>
                                        <td colspan='2'><button type="submit" class="btn btn-primary">submit</button>
                                            <a href="{{ url('admin/prodi') }}" class="btn btn-default">Cancel</a>
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
