<select id="{{$idSelect ?? ''}}" name="{{$valueName}}" @if(isset($notRequired)) @else required @endif class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
        focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 
        dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 sm:pr-12 max-w-full {{isset($full) ? 'w-full' : 'w-full sm:w-auto'}}" onchange="{{$function ?? ''}}">

    {{$slot}}

</select>