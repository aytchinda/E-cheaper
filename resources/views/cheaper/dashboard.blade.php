@extends('base')

@section('title')
    Dashboard | Cheaper
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('dashboard.address') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-map-marker-alt"></i> My Addresses
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user"></i> Account Details

                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <h4 class="mb-4">Mes addresses</h4>
                <a href="{{ route('dashboard.address.add') }}" class="btn btn-primary mb-4">
                    Ajouter Address <i class="fas fa-plus"></i>
                </a>

                @if (@isset($action) && Str::startsWith($action, 'address.'))
                    @include('addresses/addressFormFront')
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Postal Code</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                                <tr>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->street }}</td>
                                    <td>{{ $address->city }}</td>
                                    <td>{{ $address->state }}</td>
                                    <td>{{ $address->codePostal }}</td>
                                    <td>{{ $address->addressType }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('dashboard.address.edit', ['id' => $address->id]) }}"
                                                class="btn btn-primary btn-sm me-2">
                                                Edit
                                            </a>
                                            <form action="{{ route('dashboard.address.delete', ['id' => $address->id]) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Amélioration du style pour les boutons et espacement */
        .table th,
        .table td {
            vertical-align: middle;
        }

        .d-flex .btn {
            margin-right: 5px;
            /* Crée un espacement plus net entre les boutons */
        }

        /* Ajout d'une marge dans le tableau pour plus d'aération */
        .table {
            margin-top: 20px;
        }

        /* Stylisation générale pour améliorer la lisibilité */
        h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Optionnel: stylisation des actions dans le tableau */
        .btn-primary,
        .btn-danger {
            min-width: 70px;
            text-align: center;
        }
    </style>
@endsection
