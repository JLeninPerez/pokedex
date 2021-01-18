<div>
    @include('forms.search')
</div>
<div>
    <div class="row card border-primary" style="max-width: 50%; width: auto; margin: auto auto;">
        <div class="row g-0">
            <div class="col-md-6 bg-secondary">
                <img src="{{ $pokemons['image'] }}" class="card-img" >
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h4 class="card-title">{{ $pokemons['name'] }}</h4>

                    <p class="card-text">
                        <h5>{{ trans('pokedex.info.type') }}</h5>
                        <ul class="list-group list-group-horizontal">
                            @foreach($pokemons['type'] as $type)
                                <li class="list-group-item list-group-item-light">{{ ucwords($type['type']['name']) }}</li>
                            @endforeach
                        </ul>
                    </p>
                    <p class="card-text"><b>{{trans('pokedex.info.id')}} {{ $pokemons['id'] }}</b></p>
                    <p class="card-text">{{trans('pokedex.info.exp')}} {{ $pokemons['experience'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
