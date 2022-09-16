@extends('layout.v_adminpanel')
@section('content')
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>

                </div><!-- /.box-header -->
                <div class='box-body'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($repo as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    @php
                                        $author = explode('|', $d->author_id);
                                    @endphp
                                    <td>{{ $author['1'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <script src="assets/js/jquery-1.11.2.min.js"></script>
                    <script src="assets/datatables/jquery.dataTables.js"></script>
                    <script src="assets/datatables/dataTables.bootstrap.js"></script>
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
