
<!-- show reported things -->
<table class="table table-hover mt-4">
    <thead>
        <tr>
        <th width=10% scope="col">Type</th>
                        <th width=30% scope="col">Content</th>
                        <th width=10% scope="col">Author</th>
                        <th width=10% scope="col">x Reported</th>
                        <th scope="col">Current State</th>
                        <th width=15% scope="col">Actions</th>
       
        </tr>
    </thead>
    <tbody>
    @each('partials.reportedpost', $reportedPosts, 'report')
    @each('partials.reportedcomment', $reportedComments, 'report')
    </tbody>
</table>