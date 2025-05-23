<x-layout>

    <div class="container">
        <h1>Editar Usuari</h1>

        <form action="{{ route('users.manage.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control input-edit" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control input-edit" value="{{ $user->email }}" required>
            </div>

            <x-button variant="editar" type="submit" class="btn-update">
                Actualitzar
            </x-button>
        </form>
    </div>

</x-layout>
<!-- Estils CSS -->
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

    .form-group label {
        font-size: 16px;
        color: #555;
    }



    /* Estil per als inputs */
    .form-group {
        margin-bottom: 20px;
    }

    .alert-danger {
        font-size: 14px;
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

