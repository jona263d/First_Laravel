@extends('layouts.app')

@section('content')
<script>
        function Reload()
        {
            //reloading page
            window.setTimeout(function(){

            // Move to a new location or you can do something else
            window.location.href = "/settings";

            }, 500);
        };
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Instellingen</div>
                    <div class="card-body">
                        <form method="POST" action="/settings">
                            @csrf
                            <div class="container">
                                            <?php
                                            if (!empty($_POST)){
                                                echo '<body onLoad="ReloadSet();">';
                                                $name = $_POST['Name'];
                                                $email = $_POST['email'];
                                                $id = auth::user()->id;
                                                $bid = auth()->user()->BedrijfsID;
                                                if(auth::user()->rank=="Bedrijf")
                                                    {
                                                        $Bedrijfsnaam = $_POST['BedrijfsNaam'];
                                                        $tlf = $_POST['telefoonnr'];
                                                        $Adres = $_POST['adres'];
                                                        $PCode = $_POST['Postcode'];
                                                        DB::table('bedrijven')
                                                            ->where('id', $bid)
                                                            ->update(['postcode' => $PCode, 'adres' => $Adres, 'naam' => $Bedrijfsnaam, 'Telefoonnr' => $tlf]);
                                                    }
                                                DB::table('users')
                                                ->where('id', $id)
                                                ->update(['name' => $name, 'email' => $email]);
                                                //If the logged in user is admin then execute the following:
                                                if (auth::user()->rank=="Admin") {
                                                    #Posting the variables that only appear for an admin.
                                                    $LogoLink = $_POST['Path_Logo'];
                                                    $LogoSize = $_POST['Size_Logo'];
                                                    $emailStudent = $_POST['emailStudent'];
                                                    $emailDocent =  $_POST['emailDocent'];
                                                    #Updating the settings in the database
                                                    DB::table('settings')->update(
                                                        ['Logo_Size'=>$LogoSize, 'Logo'=> $LogoLink, 'emailStudent'=>$emailStudent, 'emailDocent'=>$emailDocent]);
                                                }
                                                echo '<div class="alert alert-success">Wijziging gelukt</div>';
                                            }?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Naam</span>
                                    </div>
                                    <?php
                                            $bed = DB::table('bedrijven')->where('id', auth()->user()->BedrijfsID)->first();   
                                                echo '<input type="text" name="Name" id="name" value="'. auth()->user()->name .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">';
                                        ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Email adres</span>
                                    </div>
                                    <?php
                                            $bed = DB::table('bedrijven')->where('id', auth()->user()->BedrijfsID)->first(); 
                                            echo '<input type="text" name="email" id="email" value="'. auth()->user()->email .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">';
                                        ?>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Rang</span>
                                    </div>
                                        <?php
                                            $bed = DB::table('bedrijven')->where('id', auth()->user()->BedrijfsID)->first();   
                                            echo '<input type="text" value="'. auth()->user()->rank .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" Readonly>';
                                        ?>
                                </div>
                                <?php
                                    $Settings = DB::table('settings')->first();
                                    if(auth()->user()->rank == 'Admin')
                                    {   
                                        echo '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Student email provider</span>
                                            </div>';
                                        echo '<input type="text" placeholder="studenten email provider" name="emailStudent" id="emailStudent" value="'. $Settings->emailStudent .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>';

                                        echo '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Docent email provider</span>
                                            </div>'; 
                                        echo '<input type="text" placeholder="Docenten email provider" name="emailDocent" id="emailDocent" value="'. $Settings->emailDocent .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>';

                                        echo '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary input-group-text" type="button">Logo &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; /public</button>
                                            </div>'; 
                                        echo '<input type="text" placeholder="Link naar Logo" name="Path_Logo" id="Path_Logo" value="'. $Settings->Logo .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>';

                                    }

                                        $bed = DB::table('bedrijven')->where('id', auth()->user()->BedrijfsID)->first();
                                        ?>
                                        @if(auth()->user()->rank == 'Bedrijf')
                                        {   
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">Bedrijfsnaam</span>
                                                </div>
                                            <input type="text" placeholder="Bedrijfsnaam" name="BedrijfsNaam" id="BedrijfsNaam" value="'. $bed->naam .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
                                            <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Adres</span>
                                                    </div>
                                            <input type="text" placeholder="Contact adres" name="adres" id="adres" value="'. $bed->adres .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>

                                            <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Postcode</span>
                                                    </div>
                                            <input type="text" placeholder="uw postcode" name="Postcode" id="Postcode" value="'. $bed->postcode .'" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
  
                                            <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Telefoon nummer</span>
                                                </div>
                                            <input type="text" placeholder="Telefoon nummer" value="'. $bed->telefoonnr .'" name="telefoonnr" id="telefoonnr" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
                                        @endif
                                        
                                        @if(auth()->user()->rank=="Admin")
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Logo Grootte</span>
                                                </div>
                                                @php($Size=$Settings->Logo_Size)
                                                
                                                <input type="text" placeholder="Logo grootte" value=" {{ $Size }} " name="Size_Logo" id="Size_Logo" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                            </div>
                                        @endif
                                <div style="text-align: center">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="varname" value="var_value">

                                    <button class="btn btn-primary" type="submit">
                                        <i class="far fa-save fa-3x"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
