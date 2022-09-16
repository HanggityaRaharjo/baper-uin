@extends('layout.v_userpanel')
@section('content')
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>

                    <h3 class='box-title'>REPOSITORY</h3>
                    <div class='box box-primary'>
                        <form action=" {{ url('/user/tambahrepository/create') }}" method="post"
                            enctype="multipart/form-data">

                            @csrf
                            <table class='table table-bordered'>
                                <tr>
                                    <td>tahun terbit </td>
                                    <td><input type="text" class="form-control" name="year" />
                                    </td>

                                <tr>
                                    <td>Author </td>
                                    <td>
                                        <select name="author_id" id="author_id" class="form-control">
                                            @if ($me->get('level') == 'mahasiswa')
                                                <option value="{{ $me->get('nim') }}|{{ $me->get('name') }}">
                                                    {{ $me->get('name') }}</option>
                                            @elseif ($me->get('level') == 'dosen')
                                                <option value="{{ $me->get('nip') }}|{{ $me->get('name') }}">
                                                    {{ $me->get('name') }}</option>
                                            @endif
                                        </select>
                                    </td>

                                <tr>
                                    <td>Scope </td>

                                    <td>
                                        <select name="type_id" id="type_id" class="form-control">
                                            <option value>Pilih scope</option>
                                            @foreach ($type as $data)
                                                <option value="{{ $data->id }}">{{ $data->type }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                    <td>Program Studi </td>
                                    <td><select name="prodi_id" id="prodi_id" class="form-control">
                                            <option value>Pilih prodi</option>
                                            @foreach ($prodi as $data)
                                                <option value="{{ $data->id }}">{{ $data->prodi }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                    <td>Title </td>
                                    <td><input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                            required>
                                    </td>
                                <tr>
                                    <td>Description </td>
                                    <td><textarea class="form-control" rows="8" name="descs" id="description"
                                            placeholder="Description"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>File ( .pdf/.doc )</td>
                                    <td>

                                        <input type="file" class="form-control" name="file" />
                                    </td>
                                <tr>
                                    <td>Thumbnail ( .jpg/.png ) </td>
                                    <td><input type="file" class="form-control" name="thumbnail" />
                                    </td>
                                <tr>
                                    <td><button type="submit" class="btn btn-primary">Save</button>
                                        <a href="" class="btn btn-default">Cancel</a>
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    @endsection
