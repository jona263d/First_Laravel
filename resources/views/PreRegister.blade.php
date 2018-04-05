@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Kies welke type account u wilt registreren.</div>

                    <div style="text-align: center" class="card-body">      
                                <a class="btn btn-primary" href="{{ route('register') }}">Student</a>
                                &nbsp;
                                <a class="btn btn-primary" href="RegCompany">Bedrijf</a>
                                &nbsp;
                                <a class="btn btn-primary" href="RegDocent">Docent</a>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection