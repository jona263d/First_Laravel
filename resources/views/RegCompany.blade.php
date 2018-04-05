@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                @csrf
                <div class="card-body">
                <?php
                    if (!empty($_GET)){
                        if ($_GET['Password']==$_GET['password_confirm']) {
                            $date = new \DateTime();
                            $tijd = date_format($date, 'Y-m-d H:i:s');
                            $Name = $_GET['Name'];
                            $Bedrijfsnaam = $_GET['Bedrijfsnaam'];
                            $email = $_GET['email'];
                            $Telefoonnummer = $_GET['Telefoonnummer'];
                            $Adres = $_GET['Adres'];
                            $Password = Hash::make($_GET['Password']);
                            $Role = 'Bedrijf';   
                            $date = date('m/d/Y h:i:s a', time());
                            $cid = DB::table('bedrijven')
                            ->insertGetId(
                                array('email' => $email, 'adres' => $Adres, 'naam' => $Bedrijfsnaam, 'telefoonnr' => $Telefoonnummer));
                            DB::table('users')
                            ->insert(
                                array('Name' => $Name, 'email' => $email, 'Password' => $Password, 'BedrijfsID' => $cid, 'rank' => $Role, 'created_at' => $tijd, 'updated_at' => $tijd));
                            echo '<div class="alert alert-success">Wijziging gelukt</div>';

                        }
                        else
                        {
                        unset($_GET);
                        echo '<div class="alert alert-danger">Wachtwoorden komen niet overeen</div>';
                        }
                    }else{

                    }
                ?>
                        <form method="get" action="RegCompany">
                            @csrf
                            <div class="container">
                                <div class="form-group row">
                                    <label for="Naam" class="col-md-4 col-form-label text-md-right">{{ __('Naam:') }}</label>
                                    <div class="col-md-6">
                                        <input placeholder="Naam" type="text" name="Name" id="Name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="BedrijfsNaam" class="col-md-4 col-form-label text-md-right">{{ __('Bedrijfsnaam:') }}</label>
                                    <div class="col-md-6">
                                        <input placeholder="Bedrijfsnaam" type="text" name="Bedrijfsnaam" id="Bedrijfsnaam" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Adres" class="col-md-4 col-form-label text-md-right">{{ __('Adres') }}</label>
                                    <div class="col-md-6">
                                        <input placeholder="[Straatnaam] [Huisnr], [Postcode] [Plek]" type="text" name="Adres" id="Adres" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adres:') }}</label>
                                    <div class="col-md-6">
                                        <input placeholder="example@example.com" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="TelefoonNr" class="col-md-4 col-form-label text-md-right">{{ __('Telefoonnummer:') }}</label>
                                    <div class="col-md-6">
                                        <input placeholder="+316-12345678" type="text" name="Telefoonnummer" id="Titel" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Wachtwoord') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="wachtwoord" id="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="Password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Wachtwoord bevestigen') }}</label>

                                    <div class="col-md-6">
                                        <input placeholder="wachtwoord bevestigen" id="password_confirm" type="password" class="form-control" name="password_confirm" required>
                                    </div>
                                </div>
                                <div class="col-sm-10 text-center"> 
                                        {{ csrf_field() }}
                                    <input type="hidden" name="varname" value="var_value">
                                    <input class="btn btn-primary" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
