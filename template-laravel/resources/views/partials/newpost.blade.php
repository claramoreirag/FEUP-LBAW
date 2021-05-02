
<head>
  
  <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
      tinymce.init({
          selector: '#mytextarea'
      });
  </script>

</head>


  <div class="container" id="fullNewsForm" >
      <div class="row mt-3 pb-5 mb-2">
          <div class="col-md-1 col-xs-0"></div>
          <div class="col-md-10 col-xs-12 newsFormContent">

              <form action = "{{ route('create_new_post') }}" method="POST">
              {{ csrf_field() }}
                  <div class="title-section">
                      <label for="title">News Title</label>
                      <input type="title" class="form-control" id="title" placeholder="This is a cool title">
                      <small id="titleHelp" class="form-text text-muted">Tip: Try a catchy name</small>
                  </div>
                  <div class="row ">
                      <div class="col-md-6 col-xs-12 header-section mt-3">
                          <label for="header">Header</label>
                          <input type="header" class="form-control" id="header" placeholder="This is where you summarize your post">
                      </div>
                      <div class="col-md-6 col-xs-12 tags-section mt-5">
                          <select class="form-select" aria-label="Topic">
                          <option selected>Select the topic here</option>
                                @foreach($categories as $cat)
                                        <option value={{$cat->id}}>{{$cat->name}}</option>
                                @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="row my-4 mx-1">
                      <form method="post">
                          <textarea id="mytextarea">Write your post here!</textarea>
                      </form>
                  </div>
                  <div class="form-group source-section">
                      <label for="source">News Source</label>
                      <input type="source" class="form-control" id="source" placeholder="Where did you get this content?">
                      <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                  </div>
                  <button onclick="changePage()" type="submit" class="btn btn-primary" formaction="{{ route('create_new_post') }}">Publish</button>
              </form>
          </div>
          <div class="col-md-1 col-xs-0"></div>
      </div>
  </div>

  <script defer src="../js/newPost.js"></script>