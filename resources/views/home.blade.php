@extends('layouts.main')

{{-- @dd($latest_projects) --}}
@section('content')
<div class="main">
    <div class="left">
        @include('components.home.left-aside')
    </div>
    <div class="middle-block">
        @include('components.home.navTab')
        <div id="allProjectsDiv">
            @forelse ($projects as $project)
                @include('components.project.item')
            @empty
                <div id="allProjectsNotFound">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_awc77jfz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin: 0 auto;"  loop  autoplay></lottie-player>    
                    <p style="text-align: center; margin-top: 50px">Oups ! Aucun projet n'a été trouvé.</p>    
                </div>
            @endforelse
        </div>
        <div id="projectsLikedDiv">
            @forelse ($projects_liked as $project_liked)
                @include('components.project.likedItem')
            @empty
                <div id="projectsLikedNotFound">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_awc77jfz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin: 0 auto;"  loop  autoplay></lottie-player>    
                    <p style="text-align: center; margin-top: 50px">Oups ! Aucun projet n'a été trouvé.</p>
                </div>
            @endforelse
        </div>
        <div id="latestProjectsDiv">
            @forelse ($latest_projects as $latest_project)
                @include('components.project.latestItem')
            @empty
                <div id="latestProjectsNotFound">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_awc77jfz.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px; margin: 0 auto;"  loop  autoplay></lottie-player>    
                    <p style="text-align: center; margin-top: 50px">Oups ! Aucun projet n'a été trouvé.</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="right">
        @include('components.home.right-aside')
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Hide Other projects section
    $('#latestProjectsDiv').hide()
    $('#projectsLikedDiv').hide()

    // Like Functionnality
    $('.likeProject').on('click', function(){
        $.ajax({
            url: "{{ route('client.project.like') }}",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                'project_id': $(this).attr('id'),
                'is_active': $(this).hasClass('projectIsLiked') ? true : false
            },
            success: function(data){
                $(this).toggleClass('projectIsLiked')
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
                console.log(error);
            }
        })
    })

    // Switch Projects
    let viewProjectsTabs = {
        'home': $('#allProjectsNav'),
        'latest': $('#latestProjectsNav'),
        'liked': $('#projectsLikedNav')
    }

    viewProjectsTabs.home.on('click', function(){
        // Show right section
        $('#allProjectsDiv').show()

        if(!$(this).hasClass('active')){
            $(this).addClass('active')
            // Disable active class on another link tab
            viewProjectsTabs.latest.removeClass('active')
            viewProjectsTabs.liked.removeClass('active')

            // Hide Other projects
            $('#latestProjectsDiv').hide()
            $('#projectsLikedDiv').hide()

            $.ajax({
                url: "{{ route('client.project.wished') }}",
                type: "GET",
                data:{
                    'needAllProject': true  
                },
                success: function(data){
                    $.each(data, function(index, element){
                        let content = $( "div.project" ).html();
                        console.log(element);
                    })
                },
                error: function(error){
                    console.log(error);
                }
            })
        }
    })

    viewProjectsTabs.latest.on('click', function(){
        // Show right section
        $('#latestProjectsDiv').show()

        if(!$(this).hasClass('active')){
            $(this).addClass('active')
            // Disable active class on another link tab
            viewProjectsTabs.home.removeClass('active')
            viewProjectsTabs.liked.removeClass('active')
            // Hide Other projects
            $('#allProjectsDiv').hide()
            $('#projectsLikedDiv').hide()

            $.ajax({
                url: "{{ route('client.project.wished') }}",
                type: "GET",
                data:{
                    'needLatestProjects': true  
                },
                success: function(data){
                    $.each(data, function(index, value){
                        let content = $( "div.project" );
                        content.find($('.title')).each(function(index, element){
                            element.value = "haha"
                        })
                        console.log();
                    })
                },
                error: function(error){
                    console.log(error);
                }
            })
        }
    })

    viewProjectsTabs.liked.on('click', function(){
         // Show right section
         $('#projectsLikedDiv').show()

        if(!$(this).hasClass('active')){
            $(this).addClass('active')
            // Disable active class on another link tab
            viewProjectsTabs.home.removeClass('active')
            viewProjectsTabs.latest.removeClass('active')
            // Hide Other projects
            $('#allProjectsDiv').hide()
            $('#latestProjectsDiv').hide()

            $.ajax({
                url: "{{ route('client.project.wished') }}",
                type: "GET",
                data:{
                    'needProjectsLiked': true  
                },
                success: function(data){
                    $.each(data, function(index, element){
                        let content = $( "div.project" ).html();
                        // console.log(content.find('h3'));
                    })
                },
                error: function(error){
                    console.log(error);
                }
            })
        }
    })
</script>
@endsection