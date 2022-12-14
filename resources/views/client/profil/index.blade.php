@extends('layouts.main')
@section('content')

<div id="profile-page">
    <div class="topElements">
        @if(!is_null($data->medias))
            <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/' . $data->medias->url) }}"  alt="photodeprofilde{{ str_replace(' ', '', strtolower($data->name)) }}"
            width="100px" height="100px" class="userLogo"></a>
        @else
        <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/default.png') }}"  alt="photodeprofilde{{ str_replace(' ', '', strtolower($data->name)) }}"
            width="100px" height="100px" class="userLogo"></a>
        @endif
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
                @auth
                    @if ($data->id == auth()->user()->id)
                        <a href="{{ route('client.dashboard') }}" class="btn" style="text-decoration:none">
                            <i class="fa fa-laptop"></i>
                            Accéder au tableau de bord
                        </a>
                    @else
                        @if ($data->role == "Entreprise")
                        <a class="btn" style="text-decoration:none" id="followThisEnterprise">
                            <i class="fa fa-plus"></i>
                            Suivre
                        </a>
                        @endif
                        <a href="{{ route('conversations.create', $data->id) }}" class="btn" style="text-decoration:none">
                            <i class="fa fa-envelope"></i>
                            Contacter
                        </a>
                    @endif
                @endauth
                @guest
                    @if ($data->role == "Entreprise")
                    <a href="{{ route('conversations.create', $data->id) }}" class="btn" style="text-decoration:none" id="followThisEnterprise">
                        <i class="fa fa-plus"></i>
                        Suivre
                    </a>
                    @endif
                    <a href="{{ route('conversations.create', $data->id) }}" class="btn" style="text-decoration:none">
                        <i class="fa fa-envelope"></i>
                        Contacter
                    </a>
                @endguest
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
                <p class="enterprise_description">{{ $data->enterprise_description }}</p>
                <hr>
                <div id="userStatistic">
                    <ul>
                        <li class="title">Nb. de projets</li>
                        <li>{{ count($data->projects) }}</li>
                    </ul>
                    <ul>
                        <li class="title">Abonnés</li>
                        <li>250</li>
                    </ul>
                </div>
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
                <hr>
                <div id="userStatistic">
                    <ul>
                        <li class="title">Nb. de projets soutenu</li>
                        <li>{{ count($projects_liked) }}</li>
                    </ul>
                    <ul>
                        <li class="title">Suivi(e)s</li>
                        <li>250</li>
                    </ul>
                </div>
            </div>
            <div class="userProjectsLiked">
                <h2 style="margin-top: 20px">Projet(s) soutenu par {{ $data->investor_username }}</h2>
                <hr>
                @forelse ($projects_liked as $project)
                    @include('client.profil.components.project')
                @empty
                    <p class="projectsNotFound">Aucun projet soutenu.</p>
                @endforelse
            </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Like Functionnality
    $('.likeProject').on('click', function(){
        $(this).toggleClass('projectIsLiked')
        $.ajax({
            url: "{{ route('client.project.like') }}",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'project_id': $(this).attr('id'),
                'is_active': $(this).hasClass('projectIsLiked') ? true : false
            },
            success: function(data){
                console.log(data);
            },
            error: function(error){
                if(error.statusText == "Unauthorized")
                {
                    $('#successNotifBlock').hide()
                    $('#errorNotifBlock').css({
                        'transform': 'translateX(0px)',
                        'color': 'white'
                        })
                        // Fill content
                        $('#error_message_title').html('<strong>Non autorisé :</strong>');
                        $('#error_message_content').html("<p>Vous devez vous connectez avant d'effectuer cette action.");

                        // Hide block after 3 seconds
                        setTimeout(() => {
                            $('#errorNotifBlock').css({
                                'transform': 'translateX(500px)'
                            })
                        }, 3000);
                }
                console.log(error.statusText);
            }
        })
    })

    // Follow User Functionnality
    $('#followThisEnterprise').on('click', function($query){
        // Chnage icon dynamically
        const icon = $(this).find('i');
        // Store actual btn to get it after
        const followBtn = $(this);

        icon.toggleClass('fa-plus');
        icon.toggleClass('fa-check');
        // Change Text
        if(icon.hasClass('fa-check')) {
            $(this).css({
                'background-color' : '#088dcd',
                'border-color' : '#088dcd',
                'filter' : 'grayscale(0%)'
            });
            $(this).html('<i class="fa fa-check"></i>  Suivi');
        }
        else {
            $(this).css({
                'background-color' : 'rgba(8,141,205,.6)',
                'border-color' : '#088dcd'
            });
            // Add plus icon
            $(this).html('<i class="fa fa-plus"></i>  Suivre');
        }

        $.ajax({
            url : "{{ route('userLikeThisEntreprise') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "followThisEnterprise" : icon.hasClass('fa-check') ? true : false,
                "userConcernedId" : "{{ $data->id }}"
            },
            success: function(data) {
                if(data.message !== "errorIsDetected") {
                    $('#successNotifBlock').css({
                    'transform': 'translateX(0px)',
                    'color': 'white'
                    })
                    // Fill content
                    $('#notif_message_title').html('<strong>Abonnement :</strong>');
                    $('#notif_message_content').html(data.message);

                    // Hide block after 3 seconds
                    setTimeout(() => {
                        $('#successNotifBlock').css({
                            'transform': 'translateX(470px)'
                        })
                    }, 3000);
                }

                console.log(data);
            },
            error: function(error) {
                if(error.statusText == "Unauthorized")
                {
                    $('#successNotifBlock').hide()
                    $('#errorNotifBlock').css({
                        'transform': 'translateX(0px)',
                        'color': 'white'
                        })
                        // Fill content
                        $('#error_message_title').html('<strong>Non autorisé :</strong>');
                        $('#error_message_content').html("<p>Vous devez vous connectez avant d'effectuer cette action.");

                        // Hide block after 3 seconds
                        setTimeout(() => {
                            $('#errorNotifBlock').css({
                                'transform': 'translateX(500px)'
                            })
                        }, 3000);
                }
                console.log(error);
            }
        })
    })
</script>
@endsection