<select
    id="{{ $idSelect ?? '' }}"
    name="{{ $valueName }}"
    @if(isset($notRequired)) @else required @endif
    class="siapae-select text-sm pr-10 sm:pr-20 {{ isset($class) ? $class : '' }} {{ isset($full) ? 'w-full' : 'w-full sm:w-auto' }}"
    onchange="{{ $function ?? '' }}"
    @if (isset($disabled)) disabled @endif
>
    <option value="" class="text-sm">{{ $title }}</option>
 
    {{ $slot }}
 
</select>
 
