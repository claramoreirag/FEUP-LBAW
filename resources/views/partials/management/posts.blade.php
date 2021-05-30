
@each('partials.post', $posts, 'post')

<div class="d-flex justify-content-center">
    {!! $posts->links() !!}
</div>