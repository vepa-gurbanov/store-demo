@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check me-1"></i>
        {!! session('success') !!}
    </div>
@elseif(!empty($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check me-1"></i>
        {!! $success !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi-fas fa-exclamation-triangle me-1"></i>
        {!! session('error') !!}
    </div>
@elseif(!empty($error))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi-fas fa-exclamation-triangle me-1"></i>
        {!! $error !!}
    </div>
@elseif($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi-fas fa-exclamation-triangle me-1"></i>
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<script>$("#alertModal").on('shown.bs.modal', function () {$("#contactModal #c-name").focus();});</script>

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>
            </div>
            <form action="{{ route('admin.auth.logout') }}" method="POST" id="logoutForm">
                @csrf
                @honeypot
            </form>
        </div>
    </div>
</div>
