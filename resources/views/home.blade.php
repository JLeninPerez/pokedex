@extends('app')
@section('title', trans('pokedex.title'))
@section('content')
        @include('cards.grid')
@endsection

@if(isset($alert))
    <div id="characterAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{trans('pokedex.alert.main')}}</strong>{{trans('pokedex.alert.secondary')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"  onclick="closeAlert()"></button>
    </div>
    @push('scripts')
        <script>
            var myAlert = document.getElementById('characterAlert')
            var bsAlert = new bootstrap.Alert(myAlert)
            function closeAlert() {
                document.getElementById('myAlert').remove();
            }
        </script>
    @endpush
@endif
