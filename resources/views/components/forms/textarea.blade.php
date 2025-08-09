@props(['label', 'name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full',
        'rows' => '6'
    ];

    $value = $attributes->get('value') ?? old($name);
    if ($value) {
        $defaults['value'] = $value;
    }
@endphp

<x-forms.field :$label :$name>
    <!-- Markdown Toolbar -->
   <div class="bg-white/5 border border-white/10 rounded-xl p-4">
       <div class="mb-2 flex flex-wrap gap-1 justify-end">
           <button type="button" onclick="insertMarkdown('{{ $name }}', '**', '**')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Bold">
               <strong>B</strong>
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '*', '*')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Italic">
               <em>I</em>
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '### ', '')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Heading">
               H
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '- ', '')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="List">
               •
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '1. ', '')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Numbered List">
               1.
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '`', '`')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Code">
               &lt;/&gt;
           </button>
           <button type="button" onclick="insertMarkdown('{{ $name }}', '[', '](url)')" class="px-2 py-1 bg-white/10 hover:bg-white/20 text-white text-xs rounded transition-colors" title="Link">
               🔗
           </button>
       </div>

       <textarea {{ $attributes->merge($defaults) }}>{{ $value ?? '' }}</textarea>
   </div>
</x-forms.field>

<script>
function insertMarkdown(textareaId, before, after) {
    const textarea = document.getElementById(textareaId);
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);

    const newText = before + selectedText + after;
    textarea.value = textarea.value.substring(0, start) + newText + textarea.value.substring(end);

    // cursor position
    textarea.selectionStart = start + before.length;
    textarea.selectionEnd = start + before.length + selectedText.length;

    // Focus back to textarea
    textarea.focus();
}
</script>
