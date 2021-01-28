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
                <th scope="col" class="text-right">Gestion</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->pseudo }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td class="text-right text-nowrap">
                        @if (Auth::user()->pseudo != $user->pseudo)
                            <form action="{{ route('users.update', $user->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <input name="role" value="{{ $user->is_admin ? 'STUD': 'ADMI' }}" hidden />
                                @if ($user->is_admin)
                                    <input type="submit" class="btn btn-primary btn-sm" value="Destituer" />
                                @elseif ($admin_users->count() <= 5)
                                    <input type="submit" class="btn btn-primary btn-sm" value="Nommer admin" />
                                @endif
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <div>Aucun n'utilisateur n'existe</div>
            @endforelse
        </tbody>
    </table>
@endsection