<div class="inline-flex items-center gap-1 rounded-full border border-slate-300 bg-white p-1 shadow-lg">

    <a
        href="{{ route('language.switch', ['locale' => 'bn']) }}"
        class="rounded-full bg-green-600 px-4 py-2 text-sm font-bold text-white hover:bg-green-700"
    >
        বাংলা
    </a>

    <a
        href="{{ route('language.switch', ['locale' => 'en']) }}"
        class="rounded-full bg-blue-600 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700"
    >
        English
    </a>

</div>