@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registreren als bedrijf</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registerBedrijf') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Naam</label>

                            <div class="col-md-6">
                                <input id="name" placeholder="naam" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ CUSTOM FIELDS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  -->


                        <div class="form-group row">
                            <label for="Bedrijfsnaam" class="col-md-4 col-form-label text-md-right">Bedrijfsnaam</label>

                            <div class="col-md-6">
                                <input id="Bedrijfsnaam" placeholder="bedrijfsnaam" type="text" class="form-control{{ $errors->has('Bedrijfsnaam') ? ' is-invalid' : '' }}" name="Bedrijfsnaam" value="{{ old('Bedrijfsnaam') }}" required>

                                @if ($errors->has('Bedrijfsnaam'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('Bedrijfsnaam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Adres" class="col-md-4 col-form-label text-md-right">Adres</label>

                            <div class="col-md-6">
                                <input id="Adres" type="text" placeholder="straatnaam 1" class="form-control{{ $errors->has('Adres') ? ' is-invalid' : '' }}" name="Adres" value="{{ old('Adres') }}" required>

                                @if ($errors->has('Adres'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('Adres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>

                            <div class="col-md-6">
                                <input id="Postcode" type="text" placeholder="Postcode" class="form-control{{ $errors->has('Postcode') ? ' is-invalid' : '' }}" name="Postcode" value="{{ old('Postcode') }}" required>

                                @if ($errors->has('Postcode'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('Postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Telefoonnummer" class="col-md-4 col-form-label text-md-right">Telefoonnummer</label>

                            <div class="col-md-6">
                                <input id="Telefoonnummer" type="text" placeholder="+31612345678" class="form-control{{ $errors->has('Telefoonnummer') ? ' is-invalid' : '' }}" name="Telefoonnummer" value="{{ old('Telefoonnummer') }}" required>

                                @if ($errors->has('Telefoonnummer'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('Telefoonnummer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END OF CUSTOM FIELDS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~  -->


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email adres</label><div class="col-md-6">
                            <input id="email" type="email" placeholder="voorbeeld@provider.nl" class="form-control" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Wachtwoord</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="wachtwoord" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Wachwoord bevestigen</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="wachtwoord" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button style="width:30%" type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane fa-2x"></i>
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
