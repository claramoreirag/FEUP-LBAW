<head>

    <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#mytextarea'
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
                    <div class="col-md-6 col-xs-12 header-section mt-3">
                        <label for="inputNewsHeader">Header</label>
                        <input type="header" class="form-control" name="header" id="inputNewsHeader" placeholder="This is where you summarize your post">
                    </div>
                    <div class="col-md-6 col-xs-12 tags-section mt-5">
                        <select class="form-select" aria-label="Topic" name="categories">
                           
                            @foreach($categories as $cat)
                            <option value={{$cat->id}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row my-4 mx-1">
                   
                        <textarea id="mytextarea"   name="body">Write your post here!</textarea>
                       
                </div>
                {{-- <div class="form-group source-section">
                    <label for="source">News Source</label>
                    <input type="source" class="form-control" name="source" id="source" placeholder="Where did you get this content?">
                    <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                </div> --}}
                <div class="form-group source-section">
                    <label for="inputNewsSource">News Source</label>
                 
                    <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                    <div class="container">
                        <div class="row">
                            <input type="hidden" name="count" value="1" />
                            <div class="control-group" id="fields">
                                <div class="controls" id="profs">
                                        <div id="source"><input autocomplete="off" class=" form-text form-control" id="source1" name="source[]" type="text" placeholder="Type something" data-items="8" /><button id="b1" class=" py-0 px-1 btn btn-primary add-more" type="button">+</button></div>
                                  
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