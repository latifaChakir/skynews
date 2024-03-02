@extends('layouts.layout')

@section('title', 'news-letters')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center px-4">
                            <h6 class="text-white text-capitalize ps-3">Newsletter table</h6>
                            <a href="{{ route('newsletters.create') }}" class="btn btn-info btn-sm mt-3">Add New</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div>
                            <form method="GET" action="/newsletters/search"
                                class="d-flex align-items-center gap-2 justify-content-start mb-2 px-4">
                                @csrf
                                <input type="text" name="search" class="form-control me-2 border px-2"
                                    placeholder="Search..." aria-label="Search">
                                <select name="category_id" class="form-select me-2 px-2" aria-label="Select Category">
                                    <option value="" selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button style="min-width: 120px" type="submit"
                                    class="d-inline-block btn btn-primary btn-sm mt-3">Search</button>
                            </form>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-4 px-4">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description</th>
                                        <th colspan="2" class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newsletters as $newsletter)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $newsletter->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $newsletter->description }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('newsletters.edit', $newsletter->id) }}"
                                                    class="text-secondary font-weight-bold text-xs">
                                                    Edit
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('newsletters.destroy', $newsletter->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="text-secondary font-weight-bold text-xs" type="submit"
                                                        value="Delete">
                                                </form>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $newsletters->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
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
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                    Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
