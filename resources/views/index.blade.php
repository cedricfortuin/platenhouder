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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" name="name" value="{{ old('name') }}" onkeyup="checkIfExists()">
                            <p class="text-warning" id="showAlert"></p>
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
    <script>
        function checkIfExists()
        {
            let filter = event.target.value.toUpperCase();
            let rows = document.querySelector("#recordTable tbody").rows;
            let alert = document.getElementById('showAlert');

            for (let i = 0; i < rows.length; i++) {
                let firstCol = rows[i].cells[1].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    alert.innerText = "Let op, deze plaat bestaat al in de database.";
                } else {
                    rows[i].style.display = "none";
                    alert.innerText = "";
                }
            }
        }
    </script>
@endsection

@section('section_2')
    <hr class="mt-5">
    <div class="row">
        <div class="col-md-4 text-start">
            <p>Zie hier alle ingevoerde platen</p>
        </div>
        <div class="col-md-4 text-center">
            @if($pagination[0] == '1')
                <p>Pagination is <span class="text-success">ingeschakeld.</span></p>
            @elseif($pagination[0] == '0')
                <p>Pagination is <span class="text-warning">uitgeschakeld.</span></p>
            @endif
        </div>
        <div class="col-md-4 text-end">
            <p>Totaal aantal: {{ $total }}</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="recordTable">
            <thead>
            <tr class="header">
                <th @if($pagination[0] == '0') style="width:5%" @endif>#</th>
                <th @if($pagination[0] == '0') style="width:30%" @endif>Naam</th>
                <th @if($pagination[0] == '0') style="width:30%" @endif>Artiest</th>
                <th @if($pagination[0] == '0') style="width:5%" @endif>Type</th>
                <th @if($pagination[0] == '0') style="width:5%" @endif>Eigenaar</th>
                <th @if($pagination[0] == '0') style="width:5%" @endif>Hoeveelheid</th>
                <th @if($pagination[0] == '0') style="width:14.3%" @endif>Ingevoerd op</th>
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
        @if($pagination[0] == '1')
            <div class="d-flex justify-content-center">
                {!! $records->links() !!}
            </div>
        @endif
    </div>
@endsection
