@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default"><div class="card-header">Opdrachten</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Bedrijfsnaam</th>
                                        <th scope="col">Opdracht</th>
                                        <th scope="col">Korte beschrijving</th>
                                        <th scope="col"></th>
                                        <th scope="col">Goedkeuring</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                @php($_Opdrachten = $foo)
                                    @foreach ($_Opdrachten as $p) 
                                    <tr><th scope="row">
                                    {{ $p->id }}
                                    </th><td>
                                    {{ $p->Bedrijf }}
                                    </td><td>
                                    {{ $p->Titel }}
                                    </td><td>
                                    {{ $p->ShortDesc }}
                                    </td><td>
                                    @if ($p->Goedkeuring == NULL)
                                        <td style="text-align:center;"> <i class="fas fa-spinner"/></td>
                                    @elseif ($p->Goedkeuring == 2)
                                        <td style="text-align:center;"> <i class="fas fa-thumbs-down"/></td>
                                    @elseif ($p->Goedkeuring == 1)
                                    <td style="text-align:center;"> <i class="fas fa-thumbs-up"/></td>
                                    @endif
                                    </td><td>
                                    <a href="/project/{{ $p->id }}">Meer info</a></td>
                                    </tr>
                                    @endforeach
                                    @if( auth()->user()->rank != "Student")
                                    <a href="/aanmaken">Nieuwe project indienen</a>
                                    @endif
                        </table>
                        {{ $foo->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
