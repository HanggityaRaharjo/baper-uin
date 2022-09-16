@extends('layout.v_userpanel')
@section('content')
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <h3 class='box-title'>SCOPE LIST <br><br>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($type as $a)


                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $a->type }}</td>

                                    <td style="text-align:center" width="140px">
                                        <a href="{{ url('user/singleType') }}/{{ $a->id }}" title="read"
                                            class="btn btn-danger btn-sm">lihat <i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script src="{{ asset('assets') }}/js/jquery-1.11.2.min.js"></script>
                    <script src="{{ asset('assets') }}/datatables/jquery.dataTables.js"></script>
                    <script src="{{ asset('assets') }}/datatables/dataTables.bootstrap.js"></script>
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
