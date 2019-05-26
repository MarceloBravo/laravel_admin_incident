@if(Session::has("message-primary"))
<div class="alert alert-primary" role="alert">
  {{ Session::get("message-primary") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-secundary"))
<div class="alert alert-secondary" role="alert">
  {{ Session::get("message-secundary") }}  
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-ok"))
<div class="alert alert-success" role="alert">
  {{ Session::get("message-ok") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-error"))
<div class="alert alert-danger" role="alert">
  {{ Session::get("message-error") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-warning"))
<div class="alert alert-warning" role="alert">
  {{ Session::get("message-warning") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-info"))
<div class="alert alert-info" role="alert">
  {{ Session::get("message-info") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-light"))
<div class="alert alert-light" role="alert">
  {{ Session::get("message-light") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(Session::has("message-dark"))
<div class="alert alert-dark" role="alert">
  {{ Session::get("message-dark") }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif