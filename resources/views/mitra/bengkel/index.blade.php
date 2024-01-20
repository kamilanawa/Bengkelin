@extends('mitra.layouts.app')

@section('title', 'Bengkel | Mitra')

@section('content')
    <div class="row m-4">
        <div class="card p-3">
            <h2 class="m-3">Daftar Bengkel</h2>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal"
                style="background-color:#537FE7;">Add Bengkel</button>

            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Bengkel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('bengkel.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="bengkel_name" name="bengkel_name">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="bengkel_description"
                                        name="bengkel_description">
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="bengkel_address" name="bengkel_address">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Link Address</label>
                                    <input type="text" class="form-control" id="link_bengkel_address"
                                        name="link_bengkel_address">
                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped" id="table-bengkel">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Link Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bengkels as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}"
                                        width="100">
                                @endif
                            </td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->link_alamat }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}"
                                    style="background-color:#537FE7; color:#ffffff;">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        <!-- Modal Update -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModal{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Bengkel</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('bengkel.update', $item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="bengkel_name"
                                                    name="bengkel_name" value="{{ $item->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image">
                                                @if ($item->image)
                                                    <img src="{{ asset('images/' . $item->image) }}"
                                                        class="d-block mx-auto" alt="{{ $item->name }}"
                                                        width="150">
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Description</label>
                                                <input type="text" class="form-control" id="bengkel_description"
                                                    name="bengkel_description" value="{{ $item->description }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="bengkel_address"
                                                    name="bengkel_address" value="{{ $item->alamat }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Link Address</label>
                                                <input type="text" class="form-control" id="link_bengkel_address"
                                                    name="link_bengkel_address" value="{{ $item->link_alamat }}">
                                            </div>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModal{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal{{ $item->id }}Label">Delete Bengkel
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bener nih mau dihapus "{{ $item->name }}"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('bengkel.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
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
