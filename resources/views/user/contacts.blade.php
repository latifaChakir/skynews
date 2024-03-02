@extends('layouts.layout')

@section('title', 'contacts')

@section('content')

    <div class="container-fluid py-4" >

@if ($errors->any())
<div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
</div>
@endif

    <div class="container-fluid py-4 px-2">

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                <div class="d-flex justify-content-between">
                <h6 class="text-white text-capitalize ps-3">Contacts table</h6>
                <div>
                <a href="#addModal" data-toggle="modal"><i class="material-icons text-white me-3">&#xE147;</i> </a>
                <a href="/export"><i class="material-icons text-white me-3">&#xE2C0;</i></a> 
              </div>
            </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-3">
                <table class="table align-items-center mb-0" id="myTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Groupe Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                      {{-- <th></th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">@if($contact->group_name) {{$contact->group_name}} @else sans group @endif</h6>                            
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <p class="text-sm text-secondary mb-0">{{$contact->email}}</p>                            
                          </div>
                        </div>
                      </td>
                     
                      <td class="align-middle">
                        <div class="buttons">
                        <a class="btn btn-primary" href="{{route('contacts.edit',$contact->id)}}">Edit</a>  
                        <form action="{{route('contacts.destroy',$contact->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="addModal" class="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
                    <div class="modal-header mb-3">
                        <h4 class="modal-title">Add Contact</h4>
                    </div>
                    <div class="row p-4">
                      <div class="col-md-6 mb-4">
                          <div class="card text-center">
                              <div class="card-body">
                                  <h5 class="card-title">Contact Group</h5>
                                  <p class="card-text">You can add a group of contacts using an Excel file.</p>
                                  <button class="btn btn-primary" style="position: relative;" id="test">Add Group</button>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 mb-4">
                          <div class="card text-center">
                              <div class="card-body">
                                  <h5 class="card-title">Contact of a Person</h5>
                                  <p class="card-text">You can add a single contact by entering the person's email address.</p>
                                  <button class="btn btn-primary" style="position: relative;" id="contact">Add Contact</button>
                              </div>
                          </div>
                      </div>
            </div>
        </div>
    </div>
  </div>

  <div id="addContactModal" class="modal">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
        
            <form id="employeeForm" method="post" action="{{route('contacts.store')}}">
              @csrf
              <div class="modal-header">
                  <h4 class="modal-title">Add email Contact</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <input type="email" class="form-control" name="email"  placeholder="Contact" value="{{ old('email') }}">
                  </div>

                  <div class="buttons justify-content-end">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-default" value="Save">
                  </div>
              </div>
            </form>
        </div>
    </div>
  </div>

    <div id="addGroupModal" class="modal">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
             
              <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Contact</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name"  placeholder="Group Name">
                    </div>
                    <div class="form-group">
                      <input type="file" name="excel_file" style="color: rgb(157, 163, 163)"> 
                  </div>

                    <div class="buttons justify-content-end">
                      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                      <input type="submit" class="btn btn-default" value="Save">
                  </div>
            </form>
          </div>
      </div>
    </div>

 
@endsection


