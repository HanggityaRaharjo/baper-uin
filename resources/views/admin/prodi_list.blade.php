@extends('layout.v_adminpanel')
@section('content')
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <h3 class='box-title'>PRODI LIST <br><br><a href="{{ url('admin/tambahprodi') }}"
                            class="btn btn-danger">create</a>
                    </h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Program Studi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($prodi as $a)


                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $a->prodi }}</td>
                                    <td style="text-align:center" width="140px">
                                        <a href="{{ url('admin/editprodi/edit') }}/{{ $a->id }}" title="edit"
                                            class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ url('admin/deleteprodi/delete') }}/{{ $a->id }}" title="delete"
                                            class="btn btn-danger btn-sm"
                                            onclick="javasciprt: return confirm('Are You Sure ?')"><i
                                                class="fa fa-trash-o"></i></a>
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
