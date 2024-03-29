@props(['listing'])
<x-card>
   <div class="flex ">
      <img 
         class="hidden w-48 mr-8 md:block !w-64 !h-25"
         src=" {{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
         alt=""
      />
      <div>
         <h3 class="text-2xl ">
            <a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a>
         </h3>
         <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
         {{-- :tagsCsv provides posibility of passing values  attributes --}}
         <x-listing-tags :tagsCsv="$listing->tags" />
         <div class="text-lg mt-4">
            <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
         </div>
      </div>
   </div>

</x-card>