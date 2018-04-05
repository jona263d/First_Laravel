@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Nieuwe project</div>
                    <div class="card-body">
                        <?php
                        if (!empty($_POST))
                        {
                            $Bedrijfsnaam = $_POST['Bedrijfsnaam'];
                            $Titel = $_POST['Titel'];
                            $ShortDesc = $_POST['ShortDesc'];
                            $LongDesc = $_POST['LongDesc'];
                            $BedrijfsID = auth()->user()->BedrijfsID;
                            if($BedrijfsID == NULL)
                            {
                                $BedrijfsID = 0;
                            }
                            $cid = DB::table('content')
                            ->insertGetId(
                            array('Titel' => $Titel, 'ShortDesc' => $ShortDesc, 'LongDesc' => $LongDesc, 'Bedrijf' => $Bedrijfsnaam, 'BedrijfsID' => $BedrijfsID));
                            if (!empty($_POST['TelefoonNr']))
                            {
                                $EmailAdres = $_POST['EmailAdres'];
                                $Adres = $_POST['Adres'];
                                $PCode = $_POST['Postcode'];
                                $Telefoonnr = $_POST['TelefoonNr'];
                                    $bid = DB::table('bedrijven')
                                    ->insertGetId(
                                    array('email' => $EmailAdres, 'naam' => $Bedrijfsnaam, 'telefoonnr' => $Telefoonnr, 'adres' => $Adres,
                                        'postcode' => $PCode));
                                    DB::table('content')->where('id', $cid)->update(
                                        ['BedrijfsID' => $bid]
                                    );
                            }
                            $projectURL = "'/project/". $cid ."'";
                            echo '<div class="alert alert-success">Wijziging gelukt</div>';
                            echo '<body onload="ReloadNewProject('. $projectURL .')">';
                        }
                        ?>
                        <form method="post" action="{{ route('aanmaken') }}">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="input-group mb-3">
                                        @php ($id = auth()->user()->BedrijfsID)
                                        @if($id == NULL)   
                                            <input type="text" placeholder="Bedrijfsnaam" value="" name="Bedrijfsnaam" id="Bedrijfsnaam" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></input>
                                        @else
                                            @php ($bed = DB::table('bedrijven')->where('id', $id)->first())
                                            <input type="text" value="{{ $bed->naam }}" name="Bedrijfsnaam" id="Bedrijfsnaam" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" Readonly></input>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">  
                                            @if(auth()->user()->rank=='Admin' || auth()->user()->rank=='Assessor')
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Emailadres" name="EmailAdres" id="EmailAdres" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
                                            @endif
                                </div>
                                <div class="row">
                                            @if(auth()->user()->rank=='Admin' || auth()->user()->rank=='Assessor')   
                                                <div class="input-group mb-3">
                                                <input type="text" placeholder="Telefoon nummer" name="TelefoonNr" id="TelefoonNr" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
                                            @endif
                                </div>
                                <div class="row">
                                            @if(auth()->user()->rank=='Admin' || auth()->user()->rank=='Assessor')   
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Contact adres" name="Adres" id="Adres" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                            @endif
                                </div>
                                <div class="row">
                                            @if(auth()->user()->rank=='Admin' || auth()->user()->rank=='Assessor')   
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Postcode" name="Postcode" id="Postcode" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                            @endif
                                </div>
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <input type="text" placeholder="Titel van opdracht"  name="Titel" id="Titel" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <input type="text" placeholder="Korte beschrijving van opdracht"  name="ShortDesc" id="ShortDesc" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-3">
                                        <textarea rows="20" placeholder="Uitgebreide bescrijving van opdracht" class="form-control" id="LongDesc" name="LongDesc" aria-label="With textarea"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="varname" value="var_value">
                                    <button style="margin-left: 40%; width:100px;" class="btn btn-primary" type="submit">
                                        <i class="fas fa-paper-plane fa-3x"></i>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection