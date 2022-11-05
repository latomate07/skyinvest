<div class="project" id="projectsLiked">
    <div class="topContent">
        <div class="left">
            @if($medias !== null)
            <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/' . auth()->user()->logo) }}" alt="photo de profil"
                    width="50px" height="50px" class="userLogo"></a>
            @else
            <a href="#" class="userLink"><img src="{{ asset('assets/client/logos/default.png') }}" alt="photo de profil"
                    width="50px" height="50px" class="userLogo"></a>
            @endif
            <div class="usersInformation">
                <h3 class="username">
                    {{ $project_liked->user->enterprise_name }}
                </h3>
                <p class="publishdate">Publié le :
                    {{ \Carbon\Carbon::parse($project_liked->created_at)->format('d/m/Y') }}
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
                {{ $project_liked->name }}
            </h3>
            <p class="content">
                {{ $project_liked->description }}
            </p>
            <div class="progress">
                <div class="bar">
                    <div class="progressBar"></div>
                </div>
                <h6 class="stats" style="margin-top:5px;">70% de l'objectif atteint</h6>
            </div>
        </div>
        <div class="right">
            @forelse ($project_liked->medias as $image)
                <img class="projectImage" src="{{ asset('assets/client/images') . "/" . $image->url }}">
            @empty
                <img class="projectImage" src="{{ asset('assets/images/defaultProjectImage.jpeg') }}" alt="">
            @endforelse
        </div>

        <div class="left onmobile" style="display:none">
            <h3 class="title">
                {{ $project_liked->name }}
            </h3>
            <p class="content">
                {{ $project_liked->description }}
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
                {{ $project_liked->amount }} <span class="currency">€</span>
            </h5>
        </div>
        <div class="item">
            <h5 class="item-info">Intérêt :
                {{ $project_liked->profits_percentage }} %
            </h5>
        </div>
        <div class="item">
            <h5 class="item-info">Versement du ROI par :
                {{ $project_liked->type_return_on_investissment }}
            </h5>
        </div>
    </div>
    <div class="reaction">
        <div class="like">
            <p><a id="{{ $project_liked->id }}" class="reactionBtn likeProject"><i class="fa fa-thumbs-up" style="margin-right:5px"></i>J'aime</a></p>
        </div>
        <div class="investir">
            <p><a class="reactionBtn" href="{{ route('client.project.show', $project_liked->id) }}"><i class="fa fa-chart-pie"
                        style="margin-right:5px"></i>Voir plus</a></p>
        </div>
        <div class="discuss">
            <p><a class="reactionBtn" href="#"><i class="fa fa-comments-dollar"
                        style="margin-right:5px;"></i>Contacter</a></p>
        </div>
    </div>
</div>