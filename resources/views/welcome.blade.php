<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html {
            font-family: 'Noto Sans Bengali', sans-serif;
        }

        /* ===== Main site ===== */
        #main-site-language-toggle {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 1000;
        }

        #main-site-language-button {
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            background: #fff;
            color: #334155;
            cursor: pointer;
            font: 600 14px/1.2 system-ui, -apple-system, "Segoe UI", sans-serif;
            padding: 10px 16px;
            box-shadow: 0 4px 12px rgb(15 23 42 / 12%);
        }

        #main-site-language-button:hover {
            border-color: #0f766e;
            color: #0f766e;
        }

        .main-site-content {
            box-sizing: border-box;
            max-width: 760px;
            min-height: 100vh;
            margin: 0 auto;
            padding: 18vh 24px 120px;
            color: #0f172a;
            font-family: system-ui, -apple-system, "Segoe UI", "Noto Sans Bengali", sans-serif;
        }

        .main-site-eyebrow {
            color: #0f766e;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .main-site-content h1 {
            margin: 12px 0;
            font-size: clamp(2rem, 5vw, 4rem);
            line-height: 1.1;
        }

        .main-site-content p:last-child {
            max-width: 560px;
            color: #475569;
            font-size: 1.1rem;
            line-height: 1.7;
        }
    </style>
</head>
<body>

    <div id="main-site-language-toggle">
        <button type="button" id="main-site-language-button" aria-label="Switch website language"></button>
    </div>

    <main class="main-site-content">
        <p class="main-site-eyebrow" id="main-site-eyebrow"></p>
        <h1 id="main-site-title"></h1>
        <p id="main-site-description"></p>
    </main>

    <script>
        (function () {
            var translations = {
                en: {
                    eyebrow: 'Orange BD',
                    title: 'Welcome to our website',
                    description: 'Explore our services and get help from SAKI whenever you need it.',
                    toggle: 'বাংলা'
                },
                bn: {
                    eyebrow: 'অরেঞ্জ বিডি',
                    title: 'আমাদের ওয়েবসাইটে স্বাগতম',
                    description: 'আমাদের সেবাসমূহ দেখুন এবং সাকির সাহায্য নিন।',
                    toggle: 'English'
                }
            };

            var storageKey = 'main-website-language';
            var language = localStorage.getItem(storageKey) === 'bn' ? 'bn' : 'en';

            function render() {
                var copy = translations[language];
                document.getElementById('main-site-eyebrow').textContent = copy.eyebrow;
                document.getElementById('main-site-title').textContent = copy.title;
                document.getElementById('main-site-description').textContent = copy.description;
                document.getElementById('main-site-language-button').textContent = copy.toggle;
                document.documentElement.lang = language;
            }

            document.getElementById('main-site-language-button').addEventListener('click', function () {
                language = language === 'en' ? 'bn' : 'en';
                localStorage.setItem(storageKey, language);
                render();
                window.dispatchEvent(new CustomEvent('main-website-language-change', {
                    detail: { language: language }
                }));
            });

            render();
        }());
    </script>

    @include('components.chatbot')

</body>
</html>