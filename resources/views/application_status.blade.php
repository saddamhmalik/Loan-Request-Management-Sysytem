@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-white text-black">
                        <h3 class="card-title">
                            <i class="fas fa-search"></i> Check Application Status
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{route('your_application_status')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="applicationNumber">Application Number</label>
                                <input type="text" class="form-control" id="applicationNumber" name="application_number" placeholder="Enter your application number" required>
                                @error('application_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mt-3">
                                <i class="fas fa-check"></i> Check Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
