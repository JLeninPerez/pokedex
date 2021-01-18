<div>
    @include('forms.search')
</div>
<div>
    <div class="row cards" style="width: auto; margin: auto auto;">
    @foreach($pokemons as $pokemon)
        <div class="col-sm-3" style="width: auto; margin: 2% auto">
            <div class="card text-center border-primary" style="width: 18rem;">
                <img src="{{ $pokemon['image'] }}" class="card-img-top bg-secondary">
                <div class="card-body bg-light">
                    <h5 class="card-title">{{ ucwords($pokemon['name']) }}</h5>
                    <h5 class="card-title">{{trans('pokedex.info.id')}} {{ $pokemon['id'] }}</h5>
                    <a href="{{ $pokemon['url'] }} " class="btn btn-primary">{{trans('pokedex.buttons.label.info')}}</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

