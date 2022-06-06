<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ str()->headline(last(request()->segments())) }}</li>
    </ol>
</nav>