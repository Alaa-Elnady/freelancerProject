{{-- Tags that appear in each listing in home & show listing pages --}}

{{-- Recieving the tags of listing as props --}}
@props(['tagsCsv'])
{{-- Now tagsCsv is a string each tag separated by ,   -> to trim them we will use explode() function to convert the string into array each tag in index --}}
@php
  // echo $tagsCsv;
  $tags = explode(',' , $tagsCsv);
@endphp

<ul class="flex">
  @foreach ($tags as $tag)
  <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
    <a href="/?tag={{$tag}}">{{$tag}}</a>
  </li>
  @endforeach
</ul>