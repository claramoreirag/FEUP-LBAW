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
            {{ method_field('PUT') }}
            <form action="/post/{{$post->id}}" method="Post">
                <input name="_method" type="hidden" value="PUT">
                <div class="title-section">
                    <label for="inputNewsTitle">News Title</label>
                    <input type="text-box" class="form-control" name="title" id="inputNewsTitle" placeholder={{$post->title}} value="{{$post->title}}">
                    <small id="titleHelp" class="form-text text-muted">Tip: Try a catchy name</small>
                </div>
                <div class="row ">
                    <div class="col-md-6 col-xs-12 header-section mt-3">
                        <label for="inputNewsHeader">Header</label>
                        <input type="header" class="form-control" name="header" id="inputNewsHeader" placeholder="{{$post->header}}" value="{{$post->header}}">
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
                   
                        <textarea id="mytextarea"   name="body">{{$post->body}}</textarea>
                       
                </div>
                {{-- <div class="form-group source-section">
                    <label for="source">News Source</label>
                    <input type="source" class="form-control" name="source" id="source" placeholder="Where did you get this content?">
                    <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                </div> --}}
                <div class="form-group source-section">
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
                <div class="row">
                <div class="col-10">
                <input  type="submit" class="btn btn-primary" value="Publish"  formaction="{{ route('editpost', ['post_id'=>$post->id])}}">
                @method('put')
                @csrf
            </form>
                                            </div>
                                            <div class="col-2 ">
           
            <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#deletemodal" title="Delete Post" ><i class="fas fa-trash"></i> Delete Post</button>
                                            </div>
                                            </div>
        </div>
        <div class="col-md-1 col-xs-0"></div>
    </div>
</div>


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Are you sure?</h5>
        </div>
        <div class="modal-body">
        Are you sure you want to delete this post? This is a permanent action.
        </div>
       
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <form action="/post/{{$post->id}}" method="post">
                <button type="submit" class="btn btn-outline-secondary" title="Delete Post" ><i class="fas fa-trash"></i> Delete Post</button>
                @method('delete')
                @csrf
            </form>
      </div>
    </div>
  </div>
</div>


<script defer type="text/javascript" src="{{ URL::asset('js/sources.js') }}"></script>
{{-- <script defer type="text/javascript" src="{{ URL::asset('js/tinymce.js') }}"></script> --}}
