@extends('layouts.general_index')

@section('section_1')
    <div class="form">
        <form action="{{ route('add_record') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="artist" class="form-label">Naam van artiest</label>
                    <input type="text" class="form-control @error('artist') is-invalid @enderror" id="artist" name="artist" value="{{ old('artist') }}">
                    @error('artist')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Naam van plaat</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" aria-describedby="emailHelp" name="type" value="LP">
                        @error('type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="owner" class="form-label">Eigenaar</label>
                        <input type="text" class="form-control @error('owner') is-invalid @enderror" id="owner" name="owner" value="{{ old('owner') }}">
                        @error('owner')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Hoeveel hebben we ervan?</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" min="1">
                        @error('amount')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
@endsection

@section('section_2')
    <hr class="mt-5">
    <div class="row">
        <div class="col-md-6 text-start">
            <p>Zie hier alle ingevoerde platen</p>
        </div>
        <div class="col-md-6 text-end">
            <p>Totaal aantal: {{ $total }}</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="recordTable">
            <thead>
            <tr class="header">
                <th>#</th>
                <th>Naam</th>
                <th>Artiest</th>
                <th>Type</th>
                <th>Eigenaar</th>
                <th>Hoeveelheid</th>
                <th>Ingevoerd op</th>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $key => $record)
                <tr id="searchRow">
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->artist }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->owner }}</td>
                    <td>{{ $record->amount }}</td>
                    <td>{{ date('d-m-Y', strtotime($record->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $records->links() !!}
        </div>
    </div>
@endsection
