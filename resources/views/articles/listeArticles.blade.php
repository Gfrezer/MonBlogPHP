@extends('../layouts/articlesTemplate')

@section('header')
@unless(Auth::user()->admin)
@if(Auth::check())
<div class="btn-group pull-right">
    {!! link_to_route('article.create', 'Créer un article', [], ['class' => 'btn btn-info']) !!}

    <div class="btn btn-warning" aria-labelledby="navbarDropdown">
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Déconnection') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>
@else
{!! link_to('login', 'Se connecter', ['class' => 'btn btn-info pull-right']) !!}
@endif

@endunless


<a href="javascript:history.back()" class="btn btn-primary">
    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
</a>

@endsection

@section('contenu')
@if(isset($info))
<div class="row alert alert-info">{{ $info }}</div>
@endif
{!! $links !!}

@foreach($articles as $article)
<article class="row bg-primary">
    <div class="col-md-12">
        <header>
            <h1>{{ $article->titre }}</h1>
        </header>
        <hr>
        <section>

            <p>{{ $article->contenu }}</p>
            @if(Auth::check() and Auth::user()->admin)
            {!! Form::open(['method' => 'DELETE', 'route' => ['article.destroy', $article->id]]) !!}
            {!! Form::submit('Supprimer cet article', ['class' => 'btn btn-danger btn-xs ', 'onclick' => 'return
            confirm(\'Vraiment supprimer cet article ?\')']) !!}
            {!! Form::close() !!}
            @endif
            <em class="pull-right">
                <span class="glyphicon glyphicon-pencil"></span> {{ $article->user->name }} le {!!
                $article->created_at->format('d-m-Y') !!}
            </em>
        </section>
    </div>
</article>
<br>

@endforeach
{!! $links !!}
@endsection