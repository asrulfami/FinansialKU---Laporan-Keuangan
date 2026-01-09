@extends('layouts.bootstrap')

@section('title', 'Edit Transaksi')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">Edit Transaksi</h4>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success mb-3">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('transactions.update', $transaction) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="description" class="form-label text-muted">Deskripsi</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $transaction->description) }}">
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label text-muted">Jumlah</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control" required value="{{ old('amount', $transaction->amount) }}">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label text-muted">Kategori</label>
                                <input type="text" name="category" id="category" class="form-control" required value="{{ old('category', $transaction->category) }}">
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label text-muted">Tipe</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="in" {{ old('type', $transaction->type) == 'in' ? 'selected' : '' }}>Masuk</option>
                                    <option value="out" {{ old('type', $transaction->type) == 'out' ? 'selected' : '' }}>Keluar</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="date" class="form-label text-muted">Tanggal</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', optional($transaction->date)->format('Y-m-d')) }}">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
