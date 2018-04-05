@extends('layouts.app')

@section('content')
<script>
        //Function for later use: You would have to add/remove alot of the user information if you switch between forexample student -> Bedrijf or Bedrijf -> admin.
        function setBedrijf() {
            document.getElementById('rank_text').value = "Bedrijf";
        }
        //Javascript that sets the readonly textbox to either Admin, Assessor or Docent.
        function setDocent() {
            document.getElementById('rank_text').value = "Docent";
        }
        function setAssessor() {
            document.getElementById('rank_text').value = "Assessor";
        }
        function setAdmin() {
            document.getElementById('rank_text').value = "Admin";
        }
        function setStudent() {
            document.getElementById('rank_text').value = "Student";
        }
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Instellingen</div>
                    <div class="card-body">   
                        <?php
                            $uid = DB::table('users')->where('id', $cuid->id)->first();
                            $_URL='/Manage/'.$uid->id.'';
                            $bed = DB::table('bedrijven')->where('id', $uid->BedrijfsID)->first();
                            //Checking if the form has been submitted already.
                            if (!empty($_POST)){
                                //Reloading the page after a change has been made so you can see the updated database variables.
                                $test = '<body onLoad=\'ReloadNewProject("'.$_URL.'")\'>';
                                echo $test;
                                //Getting the variables from the submitted form
                                $_name = $_POST['Name'];
                                $_email = $_POST['email'];
                                $_id = $uid->id;
                                $_Rank = $_POST['rank_text'];
                                $_bid = $uid->BedrijfsID;
                                //if chosen user is a company then execute: 
                                if($uid->rank=="Bedrijf")
                                {
                                    #Getting the variables that would only be submitted if the user is a company.
                                    $Bedrijfsnaam = $_POST['BedrijfsNaam'];
                                    $tlf = $_POST['telefoonnr'];
                                    $Adres = $_POST['adres'];
                                    $_PCode = $_POST['Postcode'];
                                    #Updating the database with the new values.
                                    DB::table('bedrijven')
                                        ->where('id', $_bid)
                                        ->update(['adres' => $Adres, 'postcode' => $_PCode, 'naam' => $Bedrijfsnaam, 'Telefoonnr' => $tlf]);
                                }
                                //Updating the standard variables. (The ones that all users have.)
                                DB::table('users')
                                ->where('id', $_id)
                                ->update(['rank' => $_Rank, 'name' => $_name, 'email' => $_email]);
                                echo '<div class="alert alert-success">Wijziging gelukt</div>';
                        }?>
                        <form method="post" action="{{$_URL}}">
                            @csrf
                            <div class="container">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Naam</span>
                                    </div>
                                        <input type="text" name="Name" id="Name" value="{{$uid->name}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Email adres</span>
                                    </div>
                                    <?php $bed = DB::table('bedrijven')->where('id', $uid->BedrijfsID)->first(); ?>
                                    <input type="text" name="email" id="email" value="{{$uid->email}}" class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button style="background-color: #e9ecef; border: 1px solid #ced4da; text-color: #ffff;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true">Rang</button>
                                    
                                        <?php $bed = DB::table('bedrijven')->where('id', $uid->BedrijfsID)->first()?>
                                        @if($uid->rank != "Bedrijf")
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" onclick="setStudent()">Student</a>
                                                <a class="dropdown-item" onclick="setDocent()">Docent</a>
                                                <div role="separator" class="dropdown-divider"></div>
                                                <a class="dropdown-item" onclick="setAssessor()">Assessor</a>
                                                <a class="dropdown-item" onclick="setAdmin()">Admin</a>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" value="{{$uid->rank}}" id="rank_text" name="rank_text"Readonly>
                                </div>
                                
                                        <?php $bed = DB::table('bedrijven')->where('id', $uid->BedrijfsID)->first() ?>
                                        @if($uid->rank == 'Bedrijf')   
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Bedrijfsnaam</span>
                                                </div>
                                            <input type="text" placeholder="bedrijfsnaam" name="BedrijfsNaam" id="BedrijfsNaam" value="{{$bed->naam}}" class="form-control" aria-label="Default"></div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Adres</span>
                                                </div>
                                            <input type="text" placeholder="contact adres" name="adres" id="adres" value="{{$bed->adres}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Postcode</span>
                                                </div>
                                            <input type="text" placeholder="postcode" name="Postcode" id="Postcode" value="{{$bed->postcode}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">Telefoon nummer</span>
                                                </div>
                                            <input type="text" placeholder="telefoon nummer" value="{{$bed->telefoonnr}}" name="telefoonnr" id="telefoonnr" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>
                                        @endif
                                <div style="text-align: center">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="varname" value="var_value">

                                    <button class="btn btn-primary" type="submit">
                                        <i class="far fa-save fa-3x"></i>
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
