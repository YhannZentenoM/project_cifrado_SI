@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Datos generales') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('diagnosis.store') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Selecciona paciente</label>
                            <select name="patient" id="" class="form-control">
                                <option value="">-- Selecciona --</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Diagnóstico</label>
                            <textarea class="form-control" name="diagnosis" rows="5" cols=""></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Receta</label>
                            <textarea class="form-control" name="prescription" rows="7" cols=""></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Pacientes atendidos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
