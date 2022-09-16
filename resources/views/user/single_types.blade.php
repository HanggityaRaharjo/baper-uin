@extends('layout.v_userpanel')
@section('content')
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box'>
                    <div class='box-header'>
                        <h3 class='box-title'> TYPE : {{ $type->type }}<br><br>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class='box-body'>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($repo as $a)
                                    <tr>
                                        <td>{{ $a->created_at }}</td>
                                        <td>{{ $a->title }}</td>
                                        <td style="text-align:center" width="140px">
                                            <a href="{{ url('user/single') }}/{{ $a->id }}" title="read"
                                                class="btn btn-danger btn-sm">lihat <i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <script src="{{ asset('assets') }}/js/jquery-1.11.2.min.js">
                        </script>
                        <script src="{{ asset('assets') }}/datatables/jquery.dataTables.js">
                        </script>
                        <script src="{{ asset('assets') }}/datatables/dataTables.bootstrap.js">
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#mytable").dataTable();
                            });

                        </script>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    @endsection
