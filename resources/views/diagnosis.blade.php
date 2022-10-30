@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pacientes atendidos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Diagnostico</th>
                                <th>Receta</th>
                                <th>Llave privada</th>
                                <th>Llave pública</th>
                                <th>Cifrado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosis as $item)
                                <tr>
                                    <td>{{ $item['id_patient'] }}</td>
                                    <td>{{ $item['diagnosis'] }}</td>
                                    <td>{{ $item['prescription'] }}</td>
                                    <td><button class="btn btn-info btn-xs btn-private" onclick="viewKeys({{ $item['id'] }}, 1)">Ver llave</button></td>
                                    <td><button class="btn btn-primary btn-xs btn-public" onclick="viewKeys({{ $item['id'] }}, 2)">Ver llave</button></td>
                                    <td><button class="btn btn-success btn-xs btn-encrypt" onclick="viewKeys({{ $item['id'] }}, 3)">Ver cifrado</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalKeys" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <textarea class="form-control" id="txt-info-db" rows="10" readonly></textarea>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function viewKeys(id, type){
        fetch('{{route("diagnosis.show", " ")}}'+id)
        .then(res => res.json())
        .then(response => {
            $('#modalKeys').modal('show')
            switch (type) {
                case 1:
                    $('#txt-info-db').text(atob(response.private_key))        
                    break;
                case 2:
                    $('#txt-info-db').text(atob(response.public_key))        
                    break;
                case 3:
                    $('#txt-info-db').text(atob(response.diagnosis))        
                    break;
            }
        })
    }
</script>
@endsection