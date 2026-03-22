@extends('admin.layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Novo Testemunho</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.testimonials.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label>Título</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Conteúdo</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
