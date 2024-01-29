@extends('layo.layouts')
@section('content')
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Transaksi</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                                            <li class="breadcrumb-item active">Transaksi</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h4 class="card-title">Data Transaksi</h4>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Transaksi</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable" class="datatable table table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Transaksi</th>
                                                        <th>Nominal</th>
                                                        <th>Kategori</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach($dataTransaksi as $item)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->nama_transaksi }}</td>
                                                        <td>{{ $item->nominal }}</td>
                                                        <td>{{ $item->kategori }}</td>
                                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">edit</button>
                                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">hapus</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Add Modal -->
                <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Modal Tambah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('transaksi-store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Transaksi</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="nama_transaksi" type="text">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Nominal</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="nominal" type="number">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="kategori" aria-label="Default select example">
                                                <option hidden>Pilih Kategori</option>
                                                <option value="pemasukan">Pemasukan</option>
                                                <option value="pengeluaran">Pengeluaran</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- edit Modal -->
                @foreach($dataTransaksi as $item)
                <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Modal Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('transaksi-update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Transaksi</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="nama_transaksi" value="{{ $item->nama_transaksi }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Nominal</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="nominal" value="{{ $item->nominal }}" type="number">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="kategori" aria-label="Default select example">
                                                <option hidden>Pilih Kategori</option>
                                                <option value="pemasukan" {{ $item->kategori == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                                <option value="pengeluaran" {{ $item->kategori == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @endforeach

                <!-- Delete Modal -->
                @foreach($dataTransaksi as $item)
                <div id="deleteModal{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Modal Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('transaksi-delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @endforeach
                

                {{-- Footer --}}
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Upcube.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->
@endsection