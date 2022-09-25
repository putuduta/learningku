<x-app title="Join Class">

    <x-slot name="navbar"></x-slot>

    <div id="content" class="container my-5 py-5">
         <div class="row justify-content-center">
              <div class="col-md-6">
                   <h3>Join Class</h3>
                   <hr>
                   <form method="POST" action="{{route('class-request-join')}}">
                        @csrf
                        <div class="my-3">
                             <label for="class_name" class="form-label">Class Name - {{ $classes->name }}</label>
                        </div>

                        <input type="text" name="class_id" id="class_id" value="{{ $classes->id }}" hidden>
                        
                        <div class="my-3">
                             <label for="comment" class="form-label">Comment</label>
                             <textarea type="text" class="form-control" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                   </form>
              </div>
         </div>
    </div>
</x-app>