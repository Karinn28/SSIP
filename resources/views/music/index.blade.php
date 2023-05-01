@extends('layout.template')
        <!-- START DATA -->
@section('conten')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="{{ url('music') }}" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Input the title here.." aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Search</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <a href='{{ url('music/create')}}' class="btn btn-primary">+ Add song</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Title</th>
                            <th class="col-md-4">Album</th>
                            <th class="col-md-2">Artist</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstitem() ?>
                        @foreach ($data as $item)
                    
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->album }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href='{{ url('music/'.$item->title.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Are you sure to delete this song?')" class="d-inline" action="{{ url('music/'.$item->title) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->withQueryString()->links() }}
               
          </div>
          <!-- AKHIR DATA -->
@endsection