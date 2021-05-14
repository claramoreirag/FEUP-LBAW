@extends('layouts.admin_header')
@section('content')
<div class=" row" style="margin-top: 3em; ">
</div>

<div class="row" style="margin-right:0rem !important; margin-left:0rem !important; ">
    <div class="col-1 "></div>
    <div class="col-10 ">

        <h1 class="title">Reported Activity</h1>

        <div class="table-responsive">

            <!-- show reported things -->
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">x Reported</th>
                        <th scope="col">Date</th>
                        <th scope="col">Written By</th>
                        <th scope="col">Content</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                @each('partials.reportedpost', $reportedPosts, 'report')
                @each('partials.reportedcomment', $reportedComments, 'report')
                </tbody>
            </table>
        </div>
        <div class=" col-1 "></div>

    </div>
</div>

<script defer src="../js/admin.js"></script>
  
@endsection
