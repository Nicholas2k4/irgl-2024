@props(['index'])
<div class="flex my-2">
    <p class="text-green-500 leading-tight">IRGL C:&#92;Users&#92;NamaTim></p>

    @for ($i = 0; $i < 15; $i++)
        <input type="text" maxlength="1"
            class="ml-{{ $i === 6 || $i === 9 ? '8' : '4' }} {{ 'letter-input' . $index }} border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
    @endfor
</div>
