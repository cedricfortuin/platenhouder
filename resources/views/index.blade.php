@extends('layouts.general_index')

@section('section_1')
    <div class="form">
        <form action="{{ route('record.add') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="artist" class="form-label" autofocus>Naam van artiest</label>
                    <input type="text" class="form-control @error('artist') is-invalid @enderror" id="artist"
                           name="artist" value="{{ old('artist') }}">
                    @error('artist')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Naam van plaat</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   aria-describedby="emailHelp" name="name" value="{{ old('name') }}"
                                   onkeyup="checkIfExists()">
                            <small class="text-info" id="showAlert">Check onderaan of de plaat al bestaat</small>
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
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                               aria-describedby="emailHelp" name="type" value="LP">
                        @error('type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="owner" class="form-label">Eigenaar</label>
                        <input type="text" class="form-control @error('owner') is-invalid @enderror" id="owner"
                               name="owner" value="{{ old('owner') }}">
                        @error('owner')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Hoeveel hebben we ervan?</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                               name="amount" value="{{ old('amount') }}" min="1">
                        @error('amount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success text-white col-md-3 ml-auto">Opslaan</button>
            </div>
        </form>
    </div>
    <script>
        function checkIfExists() {
            let filter = event.target.value.toUpperCase();
            let rows = document.querySelector("#recordTable tbody").rows;

            for (let i = 0; i < rows.length; i++) {
                let firstCol = rows[i].cells[1].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
@endsection

@section('section_2')
    <div class="row mt-5">
        <div class="col-md-6 text-start">
            <p>Zie hier alle ingevoerde platen</p>
        </div>
        <div class="col-md-6 text-end">
            <p>Totaal aantal platen: {{ $megaTotal }}</p>
        </div>
    </div>
    <div class="table-responsive col-md-10 mx-auto">
        <table id="recordTable" class="table table-sm">
            <tr>
                <td>#</td>
                <td>Naam van plaat</td>
                <td>Artiest</td>
                <td>Soort</td>
                <td>Hoeveel hebben we ervan?</td>
                <td></td>
            </tr>
            <tbody>
            @foreach($records as $key => $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->artist }}</td>
                    <td>{{ $record->type }}</td>
                    <td class="text-center">{{ $record->amount }}</td>
                    <td>
                        <button type="button" class="btn btn-success text-white btn-md" data-bs-toggle="modal"
                                data-bs-target="#openEditModal{{ $record->id }}">
                            <i class="far fa-edit"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('section_js')
@endsection
