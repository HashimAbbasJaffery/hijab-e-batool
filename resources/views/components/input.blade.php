@props([
    "type" => "text",
    "name",
    "label" => "",
    "value" => "",
    "id" => ""
])
<label for="name" class="mb-10" style="width: 100%">
    <p style="font-weight: normal;">{{ $label }}</p>
    <input id="{{ $id }}" type="{{ $type }}" value="{{ $value }}" class="border-2 border-slate-300 py-2 px-2 rounded text-light inputs" style="width: 100%;" name="{{ $name }}" id="{{ $name }}">
</label>