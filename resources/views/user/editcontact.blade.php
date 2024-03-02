@extends('layouts.layout')
@section('content')

<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
        <div class="d-flex justify-content-between">
            <h6 class="text-white text-capitalize ps-3">Edit Contact</h6>
        </div>
      </div>
    </div>
    <div class="card-body px-0 pb-2">
        <form method="post" id="forms" action="{{route('contacts.update',$contact->id)}}">
            @csrf
            @method('PUT')
            <div class="mb-3 mx-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control task-desc" name="email" value="{{ $contact->email }}">
            </div>
            <div class="d-flex w-100 justify-content-center">
                <button type="submit" class="btn btn-primary btn-block mb-4 me-4 save">Save Edit</button>
                <a href="/contacts">
                    <div class="btn btn-danger btn-block mb-4 annuler">Annuler</div>
                </a>
            </div>
        </form>
</div>
@endsection