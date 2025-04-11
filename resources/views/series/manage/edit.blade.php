<x-layout>
    <div class="container">
        <h1>Editar Sèrie: {{ $serie->title }}</h1>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('series.manage.update', $serie) }}" method="POST" enctype="multipart/form-data" data-qa="edit-series-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $serie->title) }}" required data-qa="input-title">
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea name="description" class="form-control" required data-qa="input-description">{{ old('description', $serie->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Imatge (Opcional)</label>
                <input type="file" name="image" class="form-control" data-qa="input-image">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-create-series">Actualizar Sèrie</button>
            </div>
        </form>
    </div>

</x-layout>

<style>
    .container {
        padding: 40px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    h1 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .alert {
        font-size: 14px;
        padding: 12px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        border: 1px solid #f5c6cb;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .form-control {
        font-size: 14px;
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 100%;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .btn-create-series {
        background-color: #007bff;
        color: white;
        font-size: 16px;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-create-series:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 20px;
        }

        .form-control {
            font-size: 12px;
        }

        .btn-create-series {
            font-size: 14px;
            padding: 10px 15px;
        }
    }
</style>
