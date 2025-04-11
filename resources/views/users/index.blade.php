<x-layout>

    <div class="container">
        <h1>Llista d'Usuaris</h1>

        <form method="GET" action="{{ route('users.index') }}" class="search-form mb-3">
            <div class="search-bar">
                <input type="text" name="search" class="search-input" placeholder="Cerca un usuari..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <div class="user-list">
            @foreach($users as $user)
                <div class="user-card">
                    <div class="user-avatar">
                        @if($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}'s photo" class="avatar-img">
                        @else
                            <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h5 class="user-name">{{ $user->name }}</h5>
                        <p class="user-email">{{ $user->email }}</p>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Veure Detall</a>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $users->links() }}
    </div>

</x-layout>
<!-- Estils CSS -->
<style>
    .container {
        padding: 50px;
        background-color: #f9f9f9;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        max-width: 1100px;
        margin: auto;
    }

    h1 {
        font-family: 'Georgia', serif;
        font-size: 28px;
        font-weight: 800;
        color: #4a2c2a;
        margin-bottom: 24px;
        text-align: center;
    }

    .search-form {
        max-width: 600px;
        margin: 0 auto 30px;
    }

    .search-bar {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        border-radius: 24px;
        background-color: #f1f1f1;
    }

    .search-input {
        width: 100%;
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        background-color: transparent;
        border-radius: 24px;
        outline: none;
    }

    .search-btn {
        position: absolute;
        right: 10px;
        background: transparent;
        border: none;
        color: #333;
        font-size: 22px;
        cursor: pointer;
    }

    .search-btn:hover {
        color: #007bff;
    }

    .user-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .user-card {
        background-color: white;
        border-radius: 14px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
        padding: 20px;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .user-card:hover {
        transform: translateY(-5px);
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 20px;
        position: relative;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background-color: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: white;
        font-weight: bold;
    }

    .user-info {
        flex-grow: 1;
    }

    .user-name {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
    }

    .user-email {
        font-size: 14px;
        color: #666;
        margin-bottom: 12px;
    }

    .btn-info {
        background-color: #007bff;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-info:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
    }

    .fa-search {
        font-size: 20px;
    }

    /* Responsivitat */
    @media (max-width: 768px) {
        .user-card {
            flex-direction: column;
            text-align: center;
        }

        .user-avatar {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .search-bar {
            width: 100%;
        }

        .btn-info {
            width: 100%;
            font-size: 13px;
        }
    }
</style>

