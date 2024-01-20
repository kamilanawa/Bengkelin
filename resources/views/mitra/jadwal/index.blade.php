@extends('mitra.layouts.app')

@section('title', 'Jadwal | Mitra')

@section('content')
    <div class="row m-4">
        <div class="card p-3">
            <h2 class="m-3">Daftar Jadwal</h2>
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal" style="background-color:#537FE7;">Add Jadwal</button>
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="name" class="form-label">Senin</label>
                                    <input type="text" class="form-control" id="jadwal_senin" name="jadwal_senin">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Selasa</label>
                                    <input type="text" class="form-control" id="jadwal_selasa" name="jadwal_selasa">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Rabu</label>
                                    <input type="text" class="form-control" id="jadwal_rabu" name="jadwal_rabu">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Kamis</label>
                                    <input type="text" class="form-control" id="jadwal_kamis" name="jadwal_kamis">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Jumat</label>
                                    <input type="text" class="form-control" id="jadwal_jumat" name="jadwal_jumat">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Sabtu</label>
                                    <input type="text" class="form-control" id="jadwal_sabtu" name="jadwal_sabtu">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Minggu</label>
                                    <input type="text" class="form-control" id="jadwal_minggu" name="jadwal_minggu">
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
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jumat</th>
                        <th>Sabtu</th>
                        <th>Minggu</th>
                        <th>Bengkel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $item)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $item->senin }}</td>
                        <td>{{ $item->selasa }}</td>
                        <td>{{ $item->rabu }}</td>
                        <td>{{ $item->kamis }}</td>
                        <td>{{ $item->jumat }}</td>
                        <td>{{ $item->sabtu }}</td>
                        <td>{{ $item->minggu }}</td>
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
                                    <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jadwal.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="name" class="form-label">Senin</label>
                                            <input type="text" class="form-control" id="jadwal_senin" name="jadwal_senin" value="{{ $item->senin }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Selasa</label>
                                            <input type="text" class="form-control" id="jadwal_selasa" name="jadwal_selasa" value="{{ $item->selasa }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Rabu</label>
                                            <input type="text" class="form-control" id="jadwal_rabu" name="jadwal_rabu" value="{{ $item->rabu }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Kamis</label>
                                            <input type="text" class="form-control" id="jadwal_kamis" name="jadwal_kamis" value="{{ $item->kamis }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Jumat</label>
                                            <input type="text" class="form-control" id="jadwal_jumat" name="jadwal_jumat" value="{{ $item->jumat }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Sabtu</label>
                                            <input type="text" class="form-control" id="jadwal_sabtu" name="jadwal_sabtu" value="{{ $item->sabtu }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Minggu</label>
                                            <input type="text" class="form-control" id="jadwal_minggu" name="jadwal_minggu" value="{{ $item->minggu }}">
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
                                    <p>Bener nih mau dihapus "{{ $item->id }}"?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST">
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
