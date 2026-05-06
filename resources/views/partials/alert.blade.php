    @if (session('success'))
    <div class="alert-custom alert-success-custom">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert-custom alert-error-custom">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ session('error') }}
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert-custom alert-error-custom">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ $errors->first() }}
        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
            <i class="bi bi-x"></i>
        </button>
    </div>
@endif