<form method="GET" action="{{ route('search') }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input value="{{ request('search') }}" type="text" id="search" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary m-2" type="button"  id="search-button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-button').on('click', function(e) {
            e.preventDefault(); 
            $('#search').closest('form').submit(); 
        });
    });
</script>
    
