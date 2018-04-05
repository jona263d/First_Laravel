@extends('layouts.app')

@section('content')
<div class="container">
    <form method="get">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">GebruikersInfo</div>

                    <div class="card-body">
                            Welkom {{ auth::user()->name }}.
                            <br/>
                            Uw email adres is: {{ auth::user()->email }}
                            <br/>
                            Uw rang is: {{ auth::user()->rank }}
                            <br/>
                            <?php 
                            $id = auth()->user()->BedrijfsID;
                            $bedrijf = DB::table('bedrijven')->where('id', $id);
                            $bed = $bedrijf->first();
                            ?>
                                @if(auth::user()->rank == 'Bedrijf')
                                        Het naam van uw bedrijf is: 
                                        {{ $bed->naam }}
                                        <br/>Uw contact adres is: <br/>
                                        {{ $bed->adres }}
                                    <br/>Uw tlf nr is: 
                                    {{ $bed->telefoonnr }}
                                @endif
                    </div>
                </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default"><div class="card-header">Opdrachten</div>
            @csrf
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
                            
                                    @foreach ($content as $p) 
                                    <tr><td>
                                    {{ $p->id }}
                                    </td><td>
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
                        {{ $content->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</form>
</div>

@endsection
