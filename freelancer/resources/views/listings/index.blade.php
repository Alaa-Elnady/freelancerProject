<x-layout>
  {{-- Include the hero section in our home page --}}
  @include('partials._hero')

  {{-- Include the Search section in our home page --}}
  @include('partials._search')

  {{-- Show whole listings --}}
  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @if (count($listings) == 0)
      <h1>No Listings Found!</h1>
    @else
      @foreach ($listings as $listing)
        {{-- Using listing-card component here --}}
        <x-listing-card :listing="$listing"/>
      @endforeach
    @endif
  </div>

  {{-- Pagination --}}
  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>

</x-layout>
