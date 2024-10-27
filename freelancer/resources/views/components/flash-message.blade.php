@if (session()->has('message'))
  <div x-data="{show : true}" x-init="setTimeout(() => show = false , 3000)" x-show="show" class="fixed top-0 left-1/2 tranform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>{{session('message')}}</p>
  </div>
@endif


{{-- Alpine js --}}
{{-- x-data="{variables}" --}}
{{-- x-init="code js" --}}
{{-- x-show="the condition that show the flash message when it achives(when it becomes true)" --}}