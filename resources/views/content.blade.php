@extends('layouts.app')

@section('content')
<script>
    //Thumbsup
function Up()
{
    document.form.thumbs.value = 2;
    document.forms["form"].submit();
}
    //Thumbsdown
function Down(){
    document.form.thumbs.value = 1;
    document.forms["form"].submit();
}
</script>
<?php
#Get the content ID
$id = $cid->id;
//If the user is admin then execute the following php.
if(auth()->user()->rank == "Admin" || auth()->user()->rank == "Assessor" || auth()->user()->rank == "Docent")
    {
        if(isset($_GET['delete']))
        {
            if($_GET['delete']==$id)
            {   
                $bid = DB::table('content')->where('id', $id)->first();
                $Admin = "Admin";
                $Assessor = "Assessor";
                if(auth::user()->BedrijfsID === $bid->BedrijfsID || auth()->user()->rank === $Admin || auth()->user()->rank === $Assessor)
                {
                    #Deleting the selected project
                    DB::table('content')
                        ->where('id', $id)
                        ->delete();
                }
                echo '<script type="text/javascript">
                    function ReloadNewProject(URL){
                                        //reloading page
                                        window.setTimeout(function(){
                                        // Move to a new location or you can do something else
                                        window.location.href = URL;
                                        }, 500);
                                    };
                    alert("Project nr"+" '.$id.' "+"is verwijderd");
                    ReloadNewProject("/");
                </script>';
                die();
            }
            else{
                abort(401, '$_GET[\'delete\'] is not equal to $contentID: $_GET[\'delete\']: '.$_GET['delete'].' & $id: '.$id.'');
            }
        }
        #If the GET attribute is not empty then execute the following code
        if(!empty($_GET))
        {
            #If the GET attribute is 2 then update the goedkeuring to 2
            if ($_GET['thumbs']==2){
            DB::table('content')
                ->where('id', $id)
                ->update(['Goedkeuring' => 2]);
            echo '<div class="alert alert-success">Wijziging gelukt</div>';
            }
            #If the GET attribute is 1 then update the goedkeuring to 1
            elseif($_GET['thumbs']==1)
            {
                DB::table('content')
                    ->where('id', $id)
                    ->update(['Goedkeuring' => 1]);
                echo '<div class="alert alert-success">Wijziging gelukt</div>';
            }
        }
    }
    else
    {
        #Do nothing
    }
?>
<div class="container">
    <?php 
    #Get the contentID
        $id = $cid->id;
        #display the form with action referring to /project/$id
        echo '<form id="form" name="form" method="get" action="/project/'.$id.'">'
    ?>
    <div class="row">
        @csrf
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <!-- Display the project title -->
                <div class="card-header mb-3"><h1>{{ $cid ->Titel }}</h1></div>
                    <div class="card-body">                          
                        <!--If goedkeuring is NULL then display the circle.-->
                        @if (DB::table('content')->where('id', $id)->value('Goedkeuring') == NULL)
                            <div class="d-md-none alert alert-warning col-md-2 text-center" name="Thumbs" role="alert"><i class="fas fa-spinner fa-3x"></i></div>
                            <div class="d-none d-md-block alert alert-warning col-md-2 text-center topright" name="Thumbs" role="alert"><i class="fas fa-spinner fa-3x"></i></div>

                        <!--If goedkeuring is 1 then display the thumbsUp.-->
                        @elseif (DB::table('content')->where('id', $id)->value('Goedkeuring') === 2)
                            <div class="d-md-none alert alert-danger col-md-2 text-center" name="Thumbs" role="alert"><i class="fas fa-thumbs-down fa-3x"></i></div>
                            <div class="d-none d-md-block alert alert-danger col-md-2 text-center topright" name="Thumbs" role="alert"><i class="fas fa-thumbs-down fa-3x"></i></div>

                         <!--If goedkeuring is 2 then display the thumbsDown.-->
                        @elseif (DB::table('content')->where('id', $id)->value('Goedkeuring') === 1) 
                            <div class="d-md-none alert alert-success col-md-2 text-center" name="Thumbs" role="alert"><i class="fas fa-thumbs-up fa-3x"></i></div>
                            <div class="d-none d-md-block alert alert-success col-md-2 text-center topright" name="Thumbs" role="alert"><i class="fas fa-thumbs-up fa-3x"></i></div>
                        @endif


                    <div class="row row1"><h3> Bedrijf: {{ $cid->Bedrijf }} 
                    </div>

                    <div class="row row1">Korte opdrachtdescriptie: {{ $cid->ShortDesc }} </div>
                        <div class="row row1"><span>Uitgebreide opdrachtdecriptie: 
                            <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" /><td></div>
                        </h3></span>
                        <div class="input-group mb-3">
                            <textarea rows="20" class="form-control" id="LongDesc" name="LongDesc" aria-label="With textarea" Readonly>{{$cid->LongDesc}}</textarea>
                            @php($BedID = auth()->user()->BedrijfsID)
                            @if($BedID != $cid->BedrijfsID && auth()->user()->rank == "Bedrijf")
                            </div>
                            @endif
                            @if(auth()->user()->rank != "Bedrijf" || $BedID === $cid->BedrijfsID)
                                <div class="input-group-append">
                                    <span class="input-group-text" style="min-width: 10px; display: inline-block; text-align:center;">
                                        @if($BedID === $cid->BedrijfsID)
                                            <br/>
                                            <a href="../edit/{{$cid->id}}"><i class="fas fa-edit fa-2x"></i></a>
                                        @endif
                                        @if(auth()->user()->rank == "Admin" || auth()->user()->rank == "Assessor")
                                        <div style="margin-bottom: 150px">
                                            <a href="../edit/{{$cid->id}}"><i class="fas fa-edit fa-2x"></i></a>
                                            <a data-toggle="modal" data-target="#ContactInformatie" ><i style="color: #007bff;" class="fas fa-phone fa-2x"></i></a>
                                        </div>
                                        <div style="margin-bottom: 150px">
                                            <br/>
                                            <a href="#" onclick="Down()"><i class="fas fa-thumbs-up fa-2x fa-flip-horizontal"></i></a>
                                            <a href="#" onclick="Up()"><i class="fas fa-thumbs-down fa-2x"></i></a>
                                            <input type="hidden" name="thumbs" id="thumbs" value="">
                                        </div>
                                        <div>
                                            <a href='?delete={{$id}}'><i class="fas fa-trash-alt fa-4x"></i></a>
                                        </div>

                                        @endif
                                        @if(auth()->user()->rank == "Docent")
                                        <div style="margin-bottom: 150px">
                                            <a data-toggle="modal" data-target="#ContactInformatie" ><i style="color: #007bff;" class="fas fa-phone  fa-3x"></i></a>
                                        </div>
                                            <br/>
                                            <a href="#" onclick="Down()"><i class="fas fa-thumbs-up fa-2x "></i></a>
                                            <a href="#" onclick="Up()"><i class="fas fa-thumbs-down fa-2x"></i></a>
                                            <input type="hidden" name="thumbs" id="thumbs" value="">
                                        @endif
                                        @if(auth()->user()->rank == "Student")  
                                            <br/>
                                            <a data-toggle="modal" data-target="#ContactInformatie" ><i style="margin-top: 300%; color: #007bff;" class="fas fa-phone fa-2x"></i></a>
                                        @endif
                                    </span>
                            @endif
                                </div>
                            </div>

                        <div class="modal fade" id="ContactInformatie" tabindex="-1" role="dialog" aria-labelledby="ContactInformatie" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="ContactInformatieLabel">Contact:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <b>{{ $cid->Bedrijf }}</b> <br/>
                                        <?php 
                                        //$cid = DB::table('content')->find($id //OpdrachtID);
                                        $id = $cid->id;
                                        $OpdrachtsBedrijfsID = $cid->BedrijfsID;
                                        $Bedrijf = DB::table('content')->where('id', $id)->get();
                                        $contact = DB::table('bedrijven')->where('id', $OpdrachtsBedrijfsID)->get();
                                        $users = DB::table('users')->get();
                                        foreach($contact as $s)
                                        {
                                            echo "Telefoon nummer: ";
                                            echo $s->telefoonnr;
                                            echo "<br/> Adres: ";
                                            echo $s->adres;
                                            echo "<br/> postcode: ";
                                            echo $s->postcode;
                                            echo '<br/> Email adres: ';
                                            echo $s->email;
                                        }
                                        
                                        ?>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
            	   </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection