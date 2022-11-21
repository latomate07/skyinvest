<div class="project" id="latestProjects">
    <div class="topContent">
        <div class="left">
            @if(!is_null($project->user->medias))
            <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/' . $project->user->medias->url) }}" alt="photo de profil"
                    width="50px" height="50px" class="userLogo"></a>
            @else
            <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/default.png') }}" alt="photo de profil"
                    width="50px" height="50px" class="userLogo"></a>
            @endif
            <div class="usersInformation">
                <h3 class="username">
                    {{ $latest_project->user->enterprise_name }}
                </h3>
                <p class="publishdate">Publié le :
                    {{ \Carbon\Carbon::parse($latest_project->created_at)->format('d/m/Y') }}
                </p>
            </div>
        </div>
        <div class="right">
            <h5 class="viewProfil"><a class="btn" href="{{ route('client.show.user', $project->user->id) }}">Voir le profil</a></h5>
        </div>
    </div>
    <div class="projectContent">
        <div class="left oncomputer">
            <h3 class="title">
                {{ $latest_project->name }}
            </h3>
            <p class="content">
                {{ $latest_project->description }}
            </p>
            <div class="progress">
                <div class="bar">
                    <div class="progressBar"></div>
                </div>
                <h6 class="stats" style="margin-top:5px;">70% de l'objectif atteint</h6>
            </div>
        </div>
        <div class="right">
            <div class="right">
                @forelse ($latest_project->medias as $image)
                    <img class="projectImage" src="{{ asset('assets/client/images') . "/" . $image->url }}">
                @empty
                    <img class="projectImage" src="{{ asset('assets/images/defaultProjectImage.jpeg') }}" alt="">
                @endforelse
            </div>
        </div>

        <div class="left onmobile" style="display:none">
            <h3 class="title">
                {{ $latest_project->name }}
            </h3>
            <p class="content">
                {{ $latest_project->description }}
            </p>
            <div class="progress">
                <div class="bar">
                    <div class="progressBar"></div>
                </div>
                <h6 class="stats" style="margin-top:5px;">70% de l'objectif atteint</h6>
            </div>
        </div>
    </div>
    <hr> <!-- Separateur -->
    <div class="projectInfo">
        <div class="item">
            <h5 class="item-info">Montant Souhaité :
                {{ $latest_project->amount }} <span class="currency">€</span>
            </h5>
        </div>
        <div class="item">
            <h5 class="item-info">Intérêt :
                {{ $latest_project->profits_percentage }} %
            </h5>
        </div>
        <div class="item">
            <h5 class="item-info">Versement du ROI par :
                {{ $latest_project->type_return_on_investissment }}
            </h5>
        </div>
    </div>
    <div class="reaction">
        <div class="like">
            <p><a id="{{ $latest_project->id }}" class="reactionBtn likeProject"><i class="fa fa-thumbs-up" style="margin-right:5px"></i>J'aime</a></p>
        </div>
        <div class="investir">
            <p><a class="reactionBtn" href="{{ route('client.project.show', $latest_project->id) }}"><i class="fa fa-chart-pie"
                        style="margin-right:5px"></i>Voir plus</a></p>
        </div>
        <div class="discuss">
            <p><a class="reactionBtn" href="#"><i class="fa fa-comments-dollar"
                        style="margin-right:5px;"></i>Contacter</a></p>
        </div>
    </div>
</div>