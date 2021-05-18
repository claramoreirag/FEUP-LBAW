<head>

    <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#mytextarea',
            menubar: false
        });
    </script>

</head>
<div class="container" id="fullNewsForm">
    <div class="row mt-3 pb-5 mb-2">
        <div class="col-md-1 col-xs-0"></div>
        <div class="col-md-10 col-xs-12 newsFormContent">
            {{ method_field('POST') }}
            <form action="{{ route('create_new_post') }}" method="Post">
                <input name="_method" type="hidden" value="POST">
                <div class="title-section">
                    <label for="inputNewsTitle">News Title</label>
                    <input type="text-box" class="form-control" name="title" id="inputNewsTitle" placeholder="This is a cool title">
                    <small id="titleHelp" class="form-text text-muted">Tip: Try a catchy name</small>
                    @if ($errors->has('title'))
                        <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                     @endif
                </div>
                <div class="row ">
                    <div class="col header-section mt-3">
                        <label for="inputNewsHeader">Abstract</label>
                        <textarea type="header" class="form-control input-lg" name="header" aria-label="Large"​ id="inputNewsHeader" placeholder="This is where you summarize your post" ></textarea>
                    </div>
                </div>
                <div class="row ">
                    <div class="col my-4 tags-section mt-3">
                    <label for="categories">Category</label>
                        <select class="form-select text-muted" aria-label="Topic" name="categories">
                            @foreach($categories as $cat)
                            <option value={{$cat->id}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div >
                    <label for="body">News body</label>
                    <textarea id="mytextarea" class="text-muted" name="body" >Write your post here!</textarea>
                </div>
                
                <div class="form-group source-section mt-4">
                    <label for="inputNewsSource">News Source</label>
                    <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                    <div class="row">
                            <input type="hidden" name="count" value="1" />
                            <div class="control-group" id="fields">
                                <div class="controls" id="profs">
                                        <div id="source">
                                            <input  class=" form-text form-control" id="source1" name="source[]" type="text" placeholder="http://" data-items="8" />
                                            <button id="b1" class="py-1 px-1 btn btn-light add-more" type="button">Add another source</button>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
      
                <input  type="submit" class="btn btn-primary" value="Publish" formaction="{{ route('create_new_post') }}">
                @method('POST')
                @csrf
            </form>
        </div>
        <div class="col-md-1 col-xs-0"></div>
    </div>
</div>
<script defer type="text/javascript" src="{{ URL::asset('js/sources.js') }}"></script>
{{-- <script defer type="text/javascript" src="{{ URL::asset('js/tinymce.js') }}"></script> --}}