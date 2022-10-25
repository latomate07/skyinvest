<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Le premier réseau social dédié à l'investissement. Faites fructifier votre argent rapidement et éfficacement.">
    <title>SkyInvest</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1ba83f2b65.js" crossorigin="anonymous"></script> 
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    @auth
    <script>sessionStorage.setItem('user_id', {{ auth()->user()->id }})</script>
    @endauth
</head>
<body>
    <div class="container">
        @include('partials.header')
        @yield('content')
        @include('partials.footer')
    </div>
    {{-- Notifications blocks --}}
    @include('components.global.success')
</body>
@yield('scripts')
{{-- Live Search  --}}
<script>
    // Hide Result List Block
    $('.resultOfLiveSearch').hide()

    $('#searchBar').on('submit', function(event){
            event.preventDefault();
    })
    $('#searchInput').on('keyup', function(){
            $('.resultOfLiveSearch').show()
            $.ajax({
                    url: "{{ route('ajax.search') }}",
                    type: "POST",
                    data: {
                            '_token': '{{ csrf_token() }}',
                            'wishResultTerm': $(this).val()
                    },
                    success: function(data){
                            $.each(data, function(index, value){
                                    if($('#element-'+index).length !== 1){
                                            let project_url = "{{ route('client.project.show', ':id') }}";
                                            project_url = project_url.replace(':id', value.id)
                                            $('.resultOfLiveSearch').append('<li class="resultList" id="'+'element-'+index+'"><a class="resultOfLiveSearchItem" href='+project_url+'>'+ value.name +'</a></li>')
                                    } 
                                    if($('#element-'+index).length == 0){
                                            $('#element-'+index).hide()
                                    }
                                    // console.log(value.name);
                                    $('.resultOfLiveSearch').show()
                            })
                            if(data == "")
                            {
                                    $('.resultList').hide()
                                    if($('#resultListNoFound').length > 0)
                                    {
                                            $('.resultOfLiveSearch').append('<p id="resultListNoFound" style="text-align:center">Aucun résultat trouvé.</p>')
                                    }
                            } 
                            else
                            {
                                    $('.resultList').show()
                                    $('#resultListNoFound').hide()
                            }
                    },
                    error: function(error){
                            console.log(error);
                    }
            })
    })
    $('#searchInput').on('click', function(){
            $('.resultOfLiveSearch').show()
    })
    $('#overlay').on('click', function(){
            // Hide Result List Block
            $('.resultOfLiveSearch').hide()
    })
</script>
</html>