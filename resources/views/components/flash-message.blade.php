@if (session('message'))
   <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white lg:px-48 md:px-20 sm:px-15 py-2">
      <p>
         {{ session('message') }}
      </p>
   </div>
@endif

{{-- @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif --}}