<div>
    <div class="text-center" style="margin-top: 5%; margin-bottom: 2%">
        <form class="row g-3 justify-content-sm-center" method="GET" action="/pokedex/name">
            <div class="col-10 col-6 col-3">
                <h3>
                    <label class="form-label text-white">{{trans('pokedex.form.label')}}</label>
                </h3>
                <input type="text" class="form-control" name="pokemonName" id="pokemonName" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">{{trans('pokedex.buttons.label.search')}}</button>
            </div>
        </form>
        <div class="col-12" style="margin-bottom: 2%; margin-top: 2%">
            <a href="/pokedex" class="btn btn-secondary" role="button" data-bs-toggle="button">
                @if(isset($pokemons['type']))
                    {{trans('pokedex.buttons.label.home')}}
                @else
                    {{trans('pokedex.buttons.label.refresh')}}
                @endif
            </a>
        </div>
    </div>
</div>
