@extends('layout.v_adminpanel')
@section('content')
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>

                    <h3 class='box-title'>REPOSITORY</h3>
                    <div class='box box-primary'>
                        <form action="{{ url('/admin/editrepository/update') }}/{{ $repo->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <table class='table table-bordered'>
                                <tr>
                                    <td>tahun terbit </td>
                                    <td><input type="text" class="form-control" name="year" value="{{ $repo->year }}" />
                                    </td>

                                <tr>
                                    <td>Author </td>
                                    <td>
                                        <select name="author_id" id="author_id" class="form-control">
                                            @php
                                                $nama = explode('|', $repo->author_id);
                                            @endphp
                                            <option value="{{ $repo->author_id }}">{{ $nama['1'] }}</option>
                                            @foreach ($author as $data)
                                                @php
                                                    $nama = explode('|', $data->author_id);
                                                @endphp
                                                <option value="{{ $data->id }}">{{ $nama['1'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                <tr>
                                    <td>Type </td>

                                    <td>
                                        <select name="type_id" id="type_id" class="form-control">
                                            <option value="{{ $repo->type_id }}">{{ $repo->type->type }}</option>
                                            @foreach ($type as $data)
                                                <option value="{{ $data->id }}">{{ $data->type }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                    <td>Program Studi </td>
                                    <td><select name="prodi_id" id="prodi_id" class="form-control">
                                            <option value="{{ $repo->prodi_id }}">{{ $repo->prodi->prodi }}</option>
                                            @foreach ($prodi as $data)
                                                <option value="{{ $data->id }}">{{ $data->prodi }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                <tr>
                                    <td>Title </td>
                                    <td><input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                            value="{{ $repo->title }}" required>
                                    </td>
                                <tr>
                                    <td>Description </td>
                                    <td><textarea class="form-control" rows="8" name="descs" id="description"
                                            placeholder="Description" value="">{{ $repo->descs }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>File ( .pdf/.doc )</td>
                                    <td>

                                        <input type="file" class="form-control" name="file" />
                                        <p>* Lewati ini bila tidak ingin mengubah thumbnail sebelumnya</p>
                                    </td>
                                <tr>
                                    <td>Thumbnail ( .jpg/.png ) </td>
                                    <td><input type="file" class="form-control" name="thumbnail" />
                                        <p>* Lewati ini bila tidak ingin mengubah thumbnail sebelumnya</p>
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
