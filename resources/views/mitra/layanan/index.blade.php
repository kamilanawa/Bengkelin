@extends('mitra.layouts.app')

@section('title', 'Layanan | Mitra')

@section('content')
    <div class="row m-4">
        <div class="card p-3">
            <h2 class="m-3">Daftar Layanan</h2>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal" style="background-color:#537FE7;">Add
                Layanan</button>
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Layanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bengkel_id" class="form-label">Bengkel</label>
                                    <select class="form-control" id="bengkel_id" name="bengkel_id">
                                        <option value="">Pilih Bengkel</option>
                                        @foreach($bengkels as $bengkel)
                                            <option value="{{ $bengkel->id }}">{{ $bengkel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Layanan</label>
                                    <input type="text" class="form-control" id="layanan_name" name="layanan_name">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="layanan_price" name="layanan_price">
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Bengkel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($layanans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->bengkel->name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                style="background-color:#537FE7; color:#ffffff;">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                        </td>
                    </tr>
                    <!-- Modal Update -->
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModal{{ $item->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('layanan.update', $item->id) }}}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="bengkel_id" class="form-label">Bengkel</label>
                                            <select class="form-control" id="bengkel_id" name="bengkel_id">
                                                <option value="">Pilih Bengkel</option>
                                                @foreach($bengkels as $bengkel)
                                                    <option value="{{ $bengkel->id }}" {{ $item->bengkel_id == $bengkel->id ? 'selected' : '' }}>{{ $bengkel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Layanan</label>
                                            <input type="text" class="form-control" id="layanan_name" name="layanan_name" value="{{ $item->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Price</label>
                                            <input type="text" class="form-control" id="layanan_price" name="layanan_price" value="{{ $item->price }}">
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{ $item->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModal{{ $item->id }}Label">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Bener nih mau dihapus "{{ $item->name }}"?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('layanan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection