<nav class="navbar navbar-light bg-light">
    <form class="form-inline" action="{{ route($route ?? 'search') }}" method="GET">
        <input class="form-control mr-sm-2"
            name="query"
            value="{{ request('query') }}"
            type="text"
            placeholder="{{ $placeholder ?? 'Search...'}}"
            aria-label="Search">
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button> -->
    </form>
</nav>