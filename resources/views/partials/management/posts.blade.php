
@each('partials.switchposts', $posts, 'post')
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>