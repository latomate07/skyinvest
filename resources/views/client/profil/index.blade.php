@extends('layouts.main')
@section('content')

<div id="profile-page">
    <div class="topElements">
        <img src="{{ asset('assets/client/logos/default.png') }}" alt="photodeprofilde{{ str_replace(' ', '', strtolower($data->name)) }}" class="userLogo" width="100px" height="100px">
        <div class="userShortInfos">
            @if ($data->role == "Entreprise")
                <h3 class="userName">{{ $data->enterprise_name }}</h3>
            @endif
            <h3 class="userName">{{ $data->investor_username }}</h3>
            <span>
                <i class="fa fa-globe" style="color: #2f2f2f"></i>
                {{ $data->city .", ". $data->country  }}
            </span>
            <div class="actionBtns">
                @if ($data->role == "Entreprise")
                    <a href="" class="btn" style="text-decoration:none">
                        <i class="fa fa-plus"></i>
                        Suivre
                    </a>
                @endif
                <a href="" class="btn" style="text-decoration:none">
                    <i class="fa fa-envelope"></i>
                    Contacter
                </a>
            </div>
        </div>
    </div>

    <div class="bottomElements">
        @if ($data->role == "Entreprise")
            <div class="aboutUser">
                <h3 class="title">À propos de {{ $data->enterprise_name }}</h3>
                <span>
                    <i class="fa fa-globe" style="color: #2f2f2f"></i>
                    {{ $data->city .", ". $data->country  }}
                </span>
                <span>
                    <i class="fa fa-calendar" style="color: #2f2f2f"></i>
                    {{ "Inscrit depuis le : " . \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')  }}
                </span>
                <span>
                    <i class="fa fa-user-tie" style="color: #2f2f2f"></i>
                    {{ "Gérant : " . $data->name }}
                </span>
                <hr>
                <span>
                    <i class="fa fa-gavel" style="color: #2f2f2f"></i>
                    {{ "Statut Juridique : " . "Non défini" }}
                </span>
                <span>
                    <i class="fa fa-users" style="color: #2f2f2f"></i>
                    {{ "Nombre salariés : " . "Non défini" }}
                </span>
                <hr>
                <h3>Valeurs</h3>
                <p>{{ $data->enterprise_description }}</p>
            </div>
            <div class="userProjects">
                <h2 style="margin-top: 20px">Projet(s) de {{ $data->enterprise_name }}</h2>
                <hr>
                @forelse ($data->projects as $project)
                    @include('client.profil.components.project')
                @empty
                    <p class="projectsNotFound">Aucun projet publié.</p>
                @endforelse
            </div>
        @else
            <div class="aboutUser" id="aboutInvestor">
                <h3 class="title">À propos de {{ $data->investor_username }}</h3>
                <span>
                    <i class="fa fa-globe" style="color: #2f2f2f"></i>
                    {{ $data->city .", ". $data->country  }}
                </span>
                <span>
                    <i class="fa fa-calendar" style="color: #2f2f2f"></i>
                    {{ "Inscrit depuis le : " . \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')  }}
                </span>
                <hr>
                <span>
                    <i class="fa fa-gavel" style="color: #2f2f2f"></i>
                    {{ "Statut Juridique : " . "Non défini" }}
                </span>
            </div>
            <div class="userProjectsLiked">
                <h2 style="margin-top: 20px">Projet(s) soutenu par {{ $data->investor_username }}</h2>
                <hr>
                @forelse ($data->project_liked as $project)
                    @include('client.profil.components.project')
                @empty
                    <p class="projectsNotFound">Aucun projet soutenu.</p>
                @endforelse
            </div>
        @endif
    </div>
</div>

@endsection