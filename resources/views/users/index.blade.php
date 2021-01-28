@extends ('layout')

@section ('content')
    <h1 class="text-center p-5">List Users</h1>

    <table class="table table-striped">
        <thead class="bg-default text-white">
            <tr>
                <th scope="col">Pseudo</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Role</th>
                @if ($admin_users->count() < 5)
                    <th scope="col">Gestion</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->pseudo }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td></td>
                </tr>
            @empty
                <div>Aucun n'utilisateur n'existe</div>
            @endforelse
        </tbody>
    </table>
@endsection