
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chatbot Test Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 p-10">

    <div class="fixed right-4 top-4 z-[99999] sm:right-6 sm:top-6">
        <button type="button" id="test-page-language-toggle"
            class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-md transition hover:border-teal-600 hover:text-teal-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600"
            aria-label="Switch test page language"></button>
    </div>


    {{-- Test Page Content --}}
    <div class="max-w-4xl mx-auto pt-20">

        <h1 id="test-page-title" class="text-3xl font-bold text-slate-800">
            {{ session('locale', 'bn') === 'en'
                ? 'Chatbot Test Page'
                : 'চ্যাটবট টেস্ট পেজ'
            }}
        </h1>

        <p id="test-page-description" class="mt-2 text-slate-600">
            {{ session('locale', 'bn') === 'en'
                ? 'The chatbot should appear at the bottom-right corner.'
                : 'নিচের ডান পাশে chatbot দেখা যাওয়ার কথা।'
            }}
        </p>

    </div>


    @include('components.chatbot')


</body>

<script>
(function () {
    var translations = {
        en: {
            title: 'Chatbot Test Page',
            description: 'The chatbot should appear at the bottom-right corner.',
            toggle: 'বাংলা'
        },
        bn: {
            title: 'চ্যাটবট টেস্ট পেজ',
            description: 'চ্যাটবটটি নিচের ডান পাশে দেখা যাবে।',
            toggle: 'English'
        }
    };
    var storageKey = 'saki-test-page-language';
    var language = localStorage.getItem(storageKey) === 'bn' ? 'bn' : 'en';
    var title = document.getElementById('test-page-title');
    var description = document.getElementById('test-page-description');
    var toggle = document.getElementById('test-page-language-toggle');

    function render() {
        var copy = translations[language];
        title.textContent = copy.title;
        description.textContent = copy.description;
        toggle.textContent = copy.toggle;
        document.documentElement.lang = language;
        document.title = copy.title;
    }

    toggle.addEventListener('click', function () {
        language = language === 'en' ? 'bn' : 'en';
        localStorage.setItem(storageKey, language);
        render();
    });
    render();
}());
</script>

</html>
