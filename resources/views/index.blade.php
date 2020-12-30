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
    <hr class="mt-5">
    <div class="row">
        <div class="col-md-3 text-start">
            <p>Zie hier alle ingevoerde platen</p>
        </div>
        <div class="col-md-3 text-center">
            <a class="btn btn-outline-success btn-md" onclick="pickRandomSong()">Random nummer kiezen</a>
            <p id="randomNumber"></p>
        </div>
        <div class="col-md-3 text-end">
            <p>Totaal aantal ingevoerd: {{ $total }}</p>
        </div>
        <div class="col-md-3 text-end">
            <p>Totaal aantal platen: {{ $megaTotal }}</p>
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
                <th @if($pagination[0] == '0') style="width:14.3%" @endif></th>
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
                    <td class="text-center">{{ $record->amount }}</td>
                    <td class="text-end">
                        <a type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $record->id }}"
                                            href="" {{ Popper::position('left')->pop($record->name . ' bewerken') }}>
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                </tr>

{{--                Modal to edit the record--}}
                <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/updateRecord/{{ $record->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="form-group col-md-6">
                                            <label for="name">Naam plaat</label>
                                            <input type="text" class="form-control" id="name" required name="name" value="{{ $record->name }}" onblur="checkIfEmpty('name')">
                                            <small class="text-danger" id="nameAlert"></small>
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="artist">Naam artiest</label>
                                            <input type="text" class="form-control" id="artist" required name="artist" value="{{ $record->artist }}" onblur="checkIfEmpty('artist')">
                                            <small class="text-danger" id="artistAlert"></small>
                                            @error('artist')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="form-group col-md-6">
                                            <label for="amount">Hoeveelheid</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="{{ $record->amount }}">
                                            <small class="text-danger" id="amountAlert"></small>
                                            @error('amount')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="owner">Eigenaar</label>
                                            <input type="text" class="form-control ckeditor" id="owner" name="owner" value="{{ $record->owner }}">
                                            <small class="text-danger" id="ownerAlert"></small>
                                            @error('owner')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary btn-sm" data-dismiss="modal">Annuleren</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="button_save">Opslaan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
