

<x-layout>

   @include('partials._hero')
   @include('partials._search')

   {{-- @php
      $test = 'REPs';
   @endphp
   <h1> {{ $heading }} </h1>
   {{ $test }} --}}

   {{-- @if (!count($listings) > 0) 
      <p>No listing found </p>
      
   @endif --}}

   <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-4 mx-4">


      @unless (!count($listings) > 0) 
         @foreach ($listings as $listing) 

            {{-- Calling component from the views/components --}}
            <x-listing-card :listing="$listing" />
            
         @endforeach

         @else
         <p>No listing found </p>
      @endunless
   </div>
</x-layout>


