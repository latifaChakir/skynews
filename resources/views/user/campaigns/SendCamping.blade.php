@extends('layouts.layout')

@section('title', 'campaigns')

@section('content')



    <div class="container-fluid py-4">
        @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
        </div>
        @endif
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="flx">
                  <h6 class="text-white text-capitalize ps-3">Send Campaigns</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <form class="campaing-form" method="POST" action="{{route('Campaigns.store')}}"> 
                @csrf
                @method('post')
                <label for="password" class="label">News Letter</label>
                <span class="input-span">   
                    <select id="select-state" placeholder="Pick a state..." name="newsletter">
                        <option value="">Select a newsLetter...</option>
                       @foreach($news as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                </span>
                <label for="password" class="label">News Letter</label>
                <span class="input-span">
                  <div class="add-contacts-groube">
                      <select class="js-example-basic-multiple" name="groups[]" multiple="multiple" id="the-select">
                                               
                        @foreach($groups as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                      <div class="btn" onclick="addGroubs()">Add</div>
                  </div>     
                </span>
                <span class="input-span-btns">
                     <div class="add-contacts-"  id="groubs-selected">
                     </div>
                </span>
                 <div class="emails">
                    <button class="accordion" type="button">All Contacts</button>
                    <div class="panel" >
                      <div id="checklist">
                        {{-- <label><input type="checkbox" name="emails[]" value="mbarekelaadraoui@gmail.com" checked >mbarekelaadraoui@gmail.com</label> --}}
                      </div>
                    </div>
                 </div>
                <div class="submit">
                  <button class="button-send me-3 form-button-send " type="submit">
                  <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                      >
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path
                          fill="currentColor"
                          d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                        ></path>
                      </svg>
                    </div>
                  </div>
                  <span>Send</span>
                  </button> 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
   
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
@endsection
