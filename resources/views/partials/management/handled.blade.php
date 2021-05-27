
<!-- show reported things -->
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Content</th>
            <th scope="col">Author</th>
            <th scope="col">x Reported</th>
            <th scope="col">Current State</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    @each('partials.reportedpost', $reportedPosts, 'report')
    @each('partials.reportedcomment', $reportedComments, 'report')
    </tbody>
</table>