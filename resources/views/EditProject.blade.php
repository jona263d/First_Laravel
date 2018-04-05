@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">Project aanpassen</div>
                    <div class="card-body">
                        <form method="post" action="#">
                        @csrf
                         @if(!empty($_POST))
                            @php
                                $Bedrijfsnaam = $_POST['Bedrijfsnaam'];
                                $Titel = $_POST['Titel'];
                                $ShortDesc = $_POST['ShortDesc'];
                                $LongDesc = $_POST['LongDesc'];
                                $ContentID = $cid->id; 
                                $Updated = DB::table('content')
                                    ->where('id', $ContentID)
                                    ->update(['Bedrijf' => $Bedrijfsnaam, 'Titel' => $Titel, 'ShortDesc' => $ShortDesc, 'LongDesc' => $LongDesc, 'Goedkeuring' => '0']);
                            @endphp
                            <div class="alert alert-success">Wijziging gelukt</div>
                            <?php echo '<script>
                                            function ReloadNewProject(URL)
                                            {
                                                //reloading page
                                                window.setTimeout(function(){
                                                // Move to a new location or you can do something else
                                                window.location.href = URL;
                                                }, 500);
                                            };
                                            ReloadNewProject("/project/'.$ContentID.'")
                                        </script>';?>
                         @endif
                            <div class="container">
                                <div class="row">
                                    <div class="input-group mb-3">
                                        @php
                                            $id = auth()->user()->BedrijfsID;
                                            $ContentID = $cid->id; 
                                        @endphp
                                        @if($id == NULL)
                                            <input type="text" Value="{{ $cid->Bedrijf }}"  placeholder="Bedrijfsnaam" value="" name="Bedrijfsnaam" id="Bedrijfsnaam" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                        @else
                                            <input type="text" value="{{ $cid->Bedrijf }}" name="Bedrijfsnaam" id="Bedrijfsnaam" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" Readonly>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <input value="{{ $cid ->Titel }}" type="text" placeholder="Titel van opdracht"  name="Titel" id="Titel" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <input type="text" value="{{ $cid ->ShortDesc }}" placeholder="Korte beschrijving van opdracht"  name="ShortDesc" id="ShortDesc" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-group mb-3">
                                        <textarea rows="20" placeholder="Uitgebreide bescrijving van opdracht" class="form-control" id="LongDesc" name="LongDesc" aria-label="With textarea">{{ $cid ->LongDesc }}</textarea>
                                    </div>
                                </div>
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
@endsection