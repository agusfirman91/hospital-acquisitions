@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">


        <!-- FORM UNTUK MENG-UPLOAD FILE -->
        <div class="col-md-8">
            <form action="{{ route('drug.import') }}" enctype="multipart/form-data" method="post">
                @csrf
                ​
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                ​
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="form-group row">
                    <label class="col-md-2">Type Master</label>
                    <div class="col-md-8">
                        <select name="type_id" id="" class="form-control select2" required>
                            <option value="">Please Choose</option>
                            <option value="drug">Drug</option>
                            <option value="stock">Stock</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">File</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept=".csv" id="inputFile" name="file"
                                    class="form-control {{ $errors->has('file') ? 'is-invalid':'' }}" required>
                                <label class="custom-file-label" for="inputFile">Choose file</label>
                            </div>
                            <div class="input-group-append"> <a class="btn btn-secondary"
                                    href="{{ route('drug.download')}}">
                                    <i class="fas fa-download" data-feather="download"></i> Format CSV</a>
                            </div>


                            <p class="text-danger">{{ $errors->first('file') }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-8 offset-md-2 px-2">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fas fa-send" data-feather="send"></i> Submit</button>

                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@push('scripts')

<script>
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
@endpush