@extends('layouts.admin_header')
@section('content')


<div class="row" style="margin: 2em;"></div>

<div class="container-fluid">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 col-md-10">

            <div class="row mb-4">
                <div class="col-8 ">
                    <h1 class="title">User Manager</h1>
                </div>
                <div class="col align-self-center">
                    <div class="input-group rounded search-container">
                        <input id = "searchbarusers2" type="search" class="form-control rounded searchbar" style=" border-radius: 2rem;color: var(--text-color); background-color: var(--background-color);" id="searchbar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0 search-icon">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                    <th scope="col">Profile Picture</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Current State</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="userslist">
                    @each('partials.user', $users, 'user')
                </tbody>
            </table>

        </div>
        <div class="col-1"></div>
    </div>
</div>

  
@endsection

<script defer type="text/javascript" src="{{ URL::asset('js/search.js') }}" ></script>