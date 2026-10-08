<?php
$chatbotLocale = app()->getLocale() === 'en' ? 'en' : 'bn';

$chatbotCopy = [
    'en' => [
        'name'        => 'Saki',
        'title'       => 'Saki here',
        'online'      => 'Online',
        'offline'     => 'Offline',
        'chat'        => 'Chat',
        'minimize'    => 'Minimize chat',
        'close'       => 'Close chat',
        'placeholder' => 'Write your message...',
        'message'     => 'Write your message',
        'send'        => 'Send',
        'open'        => 'Open chat',
        'powered'     => 'Powered by',
        'welcome'     => 'Hello! How can I help you today?',
        'error'       => 'Sorry, something went wrong. Please try again.',
        'unknown'     => 'Sorry, I could not get a response.',
        'launcher'    => '/images/SAKI_English.png',
    ],
    'bn' => [
        'name'        => 'সাকি',
        'title'       => 'সাকি বলছি',
        'online'      => 'অনলাইনে আছি',
        'offline'     => 'অফলাইনে আছি',
        'chat'        => 'চ্যাট',
        'minimize'    => 'চ্যাট ছোট করুন',
        'close'       => 'চ্যাট বন্ধ করুন',
        'placeholder' => 'আপনার বার্তা লিখুন...',
        'message'     => 'আপনার বার্তা লিখুন',
        'send'        => 'পাঠান',
        'open'        => 'চ্যাট খুলুন',
        'powered'     => 'পরিচালিত',
        'welcome'     => 'আমি কীভাবে আপনাকে সাহায্য করতে পারি?',
        'error'       => 'দুঃখিত, এই মুহূর্তে একটি সমস্যা হয়েছে। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।',
        'unknown'     => 'দুঃখিত, আপনার প্রশ্নের উত্তর খুঁজে পাচ্ছি না। অনুগ্রহ করে অন্যভাবে প্রশ্নটি করুন।',
        'launcher'    => '/images/SAKI_bangla.png',
    ],
];
$chatbotText = $chatbotCopy[$chatbotLocale];

$chatbotPoweredBy     = $chatbotPoweredBy ?? 'Orange BD';
$chatbotAvatar        = $chatbotAvatar ?? asset('images/logo-1.png');
$chatbotLauncherImage = $chatbotLauncherImage ?? asset(ltrim($chatbotText['launcher'], '/'));
$chatbotPosition      = ($chatbotPosition ?? 'right') === 'left' ? 'left' : 'right';
?>
    <style>
        #ai-chatbot-root,
        #ai-chatbot-root * {
            box-sizing: border-box;
        }

        #ai-chatbot-root button,
        #ai-chatbot-root input,
        #ai-chatbot-root textarea {
            font-family: inherit;
        }

        #ai-chatbot-root {
            position: fixed !important;
            visibility: hidden;
            bottom: 0;
            z-index: 2147483000;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Noto Sans Bengali", "Helvetica Neue", Arial, sans-serif;
            font-size: 15px;
            line-height: 1.4;
            transform: translateY(10px);
            color: #18262b;
        }

        #ai-chatbot-root[data-position="right"] { right: max(20px, env(safe-area-inset-right)); }
        #ai-chatbot-root[data-position="left"]  { left: max(20px, env(safe-area-inset-left)); }

        #ai-chatbot-root .ai-chatbot-scroll {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #ai-chatbot-root .ai-chatbot-scroll::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        @keyframes ai-chatbot-pop {
            0%   { opacity: 0; transform: translateY(14px) scale(.96); }
            100% { opacity: 1; transform: none; }
        }

        @keyframes ai-chatbot-launcher-in {
            0%   { opacity: 0; transform: translateY(12px) scale(.92); }
            100% { opacity: 1; transform: none; }
        }

        @keyframes ai-chatbot-typing {
            0%, 60%, 100% { opacity: .35; transform: translateY(0); }
            30%           { opacity: 1; transform: translateY(-3px); }
        }

        #ai-chatbot-root[data-open="true"] .ai-chatbot-window {
            animation: ai-chatbot-pop .2s ease-out;
        }

        #ai-chatbot-root:not([data-open="true"]) .ai-chatbot-launcher {
            animation: ai-chatbot-launcher-in .25s ease-out;
        }

        #ai-chatbot-root .ai-chatbot-window {
            position: absolute;
            bottom: 88px;
            width: min(390px, calc(100vw - 28px));
            height: min(650px, calc(100vh - 125px));
            height: min(650px, calc(100dvh - 125px));
            min-height: 420px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, .10);
            border-radius: 22px;
            box-shadow:
                0 22px 60px rgba(15, 23, 42, .18),
                0 5px 18px rgba(15, 23, 42, .08);
        }

        #ai-chatbot-root[data-position="right"] .ai-chatbot-window {
            right: 0;
            transform-origin: bottom right;
        }

        #ai-chatbot-root[data-position="left"] .ai-chatbot-window {
            left: 0;
            transform-origin: bottom left;
        }

        #ai-chatbot-root .ai-chatbot-header {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 16px;
            background: #16a34a;
            border-bottom: 1px solid #eef1f2;
        }

        #ai-chatbot-root .ai-chatbot-header-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        #ai-chatbot-root .ai-chatbot-avatar {
            position: relative;
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            border: 3px solid #16a34a;
            border-radius: 9999px;
            background: #fff;
            box-shadow: 0 3px 10px rgba(22, 163, 74, .12);
        }

        #ai-chatbot-root .ai-chatbot-avatar img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            border-radius: 9999px;
        }

        #ai-chatbot-root .ai-chatbot-avatar-status {
            position: absolute;
            right: -4px;
            bottom: -4px;
            width: 13px;
            height: 13px;
            border: 2px solid #fff;
            border-radius: 9999px;
            background: #22c55e;
        }

        #ai-chatbot-root[data-server="offline"] .ai-chatbot-avatar-status {
            background: #ef4444;
        }

        #ai-chatbot-root .ai-chatbot-title {
            min-width: 0;
        }

        #ai-chatbot-root .ai-chatbot-title-name {
            display: block;
            color: #162126;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.25;
        }

        #ai-chatbot-root .ai-chatbot-title-status {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 3px;
            color: #000;
            font-size: 12px;
            line-height: 1.2;
        }

        #ai-chatbot-root .ai-chatbot-header-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        #ai-chatbot-root .ai-chatbot-icon-button {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #000;
            cursor: pointer;
            transition: background .15s ease, color .15s ease;
        }

        #ai-chatbot-root .ai-chatbot-icon-button:hover {
            background: #f1f5f5;
        }

        #ai-chatbot-root .ai-chatbot-messages-wrap {
            flex: 1 1 auto;
            min-height: 0;
            position: relative;
            overflow: hidden;
            isolation: isolate;
            background-color: #f8faf9;
        }

        #ai-chatbot-root .ai-chatbot-messages-wrap::before {
            content: "";
            position: absolute;
            z-index: 0;
            inset: 0;
            pointer-events: none;
            background-image: url('/images/bg-1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(1px);
            opacity: 0.45;
        }

        #ai-chatbot-root .ai-chatbot-messages {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow-y: auto;
            padding: 18px 15px;
            background: transparent;
        }

        #ai-chatbot-root .ai-chatbot-messages > * {
            position: relative;
            z-index: 1;
        }

        #ai-chatbot-root .ai-chatbot-message-row {
            width: 100%;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 12px;
        }

        #ai-chatbot-root .ai-chatbot-message-row.user {
            justify-content: flex-end;
        }

        #ai-chatbot-root .ai-chatbot-msg-avatar {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 9999px;
            background: #fff;
            border: 1px solid #16a34a;
        }

        #ai-chatbot-root .ai-chatbot-msg-avatar img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            border-radius: 9999px;
        }

        #ai-chatbot-root .ai-chatbot-msg-avatar.user {
            background: #dcfce7;
            color: #16a34a;
        }

        #ai-chatbot-root .ai-chatbot-message-wrap {
            max-width: calc(100% - 44px);
            min-width: 0;
        }

        #ai-chatbot-root .ai-chatbot-message {
            display: inline-block;
            max-width: 100%;
            padding: 11px 13px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.55;
            overflow-wrap: anywhere;
            word-break: break-word;
            white-space: pre-wrap;
        }

        #ai-chatbot-root .ai-chatbot-message.bot {
            color: #26363b;
            background: #fff;
            border: 1px solid #e7eded;
            border-top-left-radius: 5px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .04);
        }

        #ai-chatbot-root .ai-chatbot-message.user {
            color: #fff;
            background: #16a34a;
            border-top-right-radius: 5px;
            box-shadow: 0 3px 8px rgba(22, 163, 74, .15);
        }

        #ai-chatbot-root .ai-chatbot-message-row.user .ai-chatbot-message-wrap {
            text-align: right;
        }

        #ai-chatbot-root .ai-chatbot-time {
            margin-top: 4px;
            color: #8a969b;
            font-size: 10px;
        }

        #ai-chatbot-root .ai-chatbot-message-row.bot .ai-chatbot-time  { text-align: left; }
        #ai-chatbot-root .ai-chatbot-message-row.user .ai-chatbot-time { text-align: right; }

        #ai-chatbot-root .ai-chatbot-typing {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            min-width: 54px;
        }

        #ai-chatbot-root .ai-chatbot-typing span {
            width: 6px;
            height: 6px;
            border-radius: 9999px;
            background: #9aa7aa;
            animation: ai-chatbot-typing 1.2s infinite ease-in-out;
        }

        #ai-chatbot-root .ai-chatbot-typing span:nth-child(2) { animation-delay: .15s; }
        #ai-chatbot-root .ai-chatbot-typing span:nth-child(3) { animation-delay: .30s; }

        #ai-chatbot-root .ai-chatbot-input-area {
            flex: 0 0 auto;
            padding: 10px 12px 9px;
            background: #f2fff6;
            border-top: 1px solid #eef1f2;
        }

        #ai-chatbot-root .ai-chatbot-input-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            padding: 7px 7px 7px 13px;
            border: 1px solid #dce4e5;
            border-radius: 15px;
            background: #fff;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        #ai-chatbot-root .ai-chatbot-input-row:focus-within {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, .08);
        }

        #ai-chatbot-root .ai-chatbot-input {
            width: 100%;
            min-width: 0;
            max-height: 100px;
            padding: 5px 0;
            resize: none;
            border: 0;
            outline: none;
            background: transparent;
            color: #1f2d31;
            font-size: 14px;
            line-height: 1.45;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #ai-chatbot-root .ai-chatbot-input::-webkit-scrollbar { display: none; }
        #ai-chatbot-root .ai-chatbot-input::placeholder { color: #9aa6aa; }

        #ai-chatbot-root .ai-chatbot-send {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 11px;
            background: #16a34a;
            color: #fff;
            cursor: pointer;
            transition: background .15s ease, transform .15s ease;
        }

        #ai-chatbot-root .ai-chatbot-send:hover { background: #15803d; }
        #ai-chatbot-root .ai-chatbot-send:active { transform: scale(.94); }
        #ai-chatbot-root .ai-chatbot-send:disabled { opacity: .55; cursor: not-allowed; }

        #ai-chatbot-root button:focus-visible,
        #ai-chatbot-root textarea:focus-visible {
            outline-offset: 2px;
        }

        #ai-chatbot-root .ai-chatbot-footer {
            flex: 0 0 auto;
            padding: 3px 12px 8px;
            text-align: center;
            color: #a0aaad;
            font-size: 10px;
            line-height: 1.3;
            background: #fff;
        }

        #ai-chatbot-root .ai-chatbot-launcher {
            position: relative;
            left: 20px;
            top: -15px;
            z-index: 10;
            display: block;
            width: min(200px, calc(100vw - 40px));
            height: 82px;
            overflow: hidden;
            padding: 0;
            border: 0;
            background: transparent;
            cursor: pointer;
            line-height: 0;
            transition: none;
        }

        #ai-chatbot-root .ai-chatbot-launcher-art {
            position: absolute;
            left: 0;
            top: 50%;
            z-index: 2;
            width: 100%;
            aspect-ratio: 355 / 133;
            transform: translateY(-50%) scale(.9);
            transform-origin: center;
            filter: drop-shadow(0 0 6px rgba(66, 48, 202, 0.9));
        }

        #ai-chatbot-root .ai-chatbot-launcher-art:hover {
            filter: drop-shadow(0 0 8px rgb(6, 152, 62));
        }

        #ai-chatbot-root .ai-chatbot-launcher-img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        #ai-chatbot-root .ai-chatbot-launcher-text-bg {
            position: absolute;
            z-index: 1;
            left: 34%;
            top: 9%;
            width: 58%;
            height: 74%;
            background-color: #fff;
            mix-blend-mode: multiply;
            border-radius: 0 18px 18px 0;
            pointer-events: none;
        }

        #ai-chatbot-root[data-locale="en"] .ai-chatbot-launcher-text-bg {
            -webkit-mask-image: radial-gradient(ellipse 10% 50% at 0% 52%, transparent 98%, #000 100%);
            mask-image: radial-gradient(ellipse 11% 43% at 0% 51%, transparent 98%, #000 100%);
        }

        #ai-chatbot-root[data-locale="bn"] .ai-chatbot-launcher-text-bg {
            -webkit-mask-image: radial-gradient(ellipse 25% 60% at -23% 48%, transparent 98%, #000 100%);
            mask-image: radial-gradient(ellipse 11% 43% at 0% 51%, transparent 98%, #000 100%);
        }

        #ai-chatbot-root .ai-chatbot-launcher-fallback {
            width: 64px;
            height: 64px;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background: #16a34a;
            color: #fff;
            box-shadow: 0 8px 24px rgba(22, 163, 74, .35);
        }

        @media (max-width: 640px) {
            #ai-chatbot-root {
                bottom: max(12px, env(safe-area-inset-bottom));
            }

            #ai-chatbot-root[data-position="right"] { right: max(12px, env(safe-area-inset-right)); }
            #ai-chatbot-root[data-position="left"]  { left: max(12px, env(safe-area-inset-left)); }

            #ai-chatbot-root[data-position="right"] .ai-chatbot-window,
            #ai-chatbot-root[data-position="left"] .ai-chatbot-window {
                position: fixed;
                left: max(10px, env(safe-area-inset-left));
                right: max(10px, env(safe-area-inset-right));
                bottom: max(10px, env(safe-area-inset-bottom));
                width: auto;
                height: calc(100vh - 20px);
                height: calc(100dvh - 20px);
                min-height: 0;
                border-radius: 20px;
            }

            #ai-chatbot-root .ai-chatbot-message-wrap {
                max-width: calc(100% - 42px);
            }
        }

        @media (max-width: 380px) {
            #ai-chatbot-root .ai-chatbot-header { padding: 12px; }

            #ai-chatbot-root .ai-chatbot-avatar {
                width: 43px;
                height: 43px;
                flex-basis: 43px;
            }

            #ai-chatbot-root .ai-chatbot-title-name { font-size: 15px; }
        }

        @media (prefers-reduced-motion: reduce) {
            #ai-chatbot-root,
            #ai-chatbot-root * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <div id="ai-chatbot-root"
         data-open="false"
         data-position="{{ $chatbotPosition }}"
         data-locale="{{ $chatbotLocale }}"
         data-avatar="{{ $chatbotAvatar }}">

        <section class="ai-chatbot-window"
                 aria-label="{{ $chatbotText['name'] }} {{ $chatbotText['chat'] }}"
                 style="display:none;">

            <header class="ai-chatbot-header">
                <div class="ai-chatbot-header-left">
                    <div class="ai-chatbot-avatar">
                        <img src="{{ $chatbotAvatar }}" alt="{{ $chatbotText['name'] }}">
                        <span class="ai-chatbot-avatar-status"></span>
                    </div>

                    <div class="ai-chatbot-title">
                        <span class="ai-chatbot-title-name">{{ $chatbotText['title'] }}</span>
                        <span class="ai-chatbot-title-status">{{ $chatbotText['online'] }}</span>
                    </div>
                </div>

                <div class="ai-chatbot-header-actions">
                    <button type="button"
                            class="ai-chatbot-icon-button"
                            data-chatbot-minimize
                            aria-label="{{ $chatbotText['minimize'] }}"
                            title="{{ $chatbotText['minimize'] }}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M6 12h12"/>
                        </svg>
                    </button>

                    <button type="button"
                            class="ai-chatbot-icon-button"
                            data-chatbot-close
                            aria-label="{{ $chatbotText['close'] }}"
                            title="{{ $chatbotText['close'] }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M6 6l12 12"/>
                            <path d="M18 6L6 18"/>
                        </svg>
                    </button>
                </div>
            </header>

            <div class="ai-chatbot-messages-wrap">
                <div class="ai-chatbot-messages ai-chatbot-scroll"
                     data-chatbot-messages
                     role="log"
                     aria-live="polite"></div>
            </div>

            <div class="ai-chatbot-input-area">
                <div class="ai-chatbot-input-row">
                    <textarea class="ai-chatbot-input ai-chatbot-scroll"
                              data-chatbot-input
                              rows="1"
                              placeholder="{{ $chatbotText['placeholder'] }}"
                              autocomplete="off"
                              spellcheck="false"
                              aria-label="{{ $chatbotText['message'] }}"></textarea>

                    <button type="button"
                            class="ai-chatbot-send"
                            data-chatbot-send
                            aria-label="{{ $chatbotText['send'] }}"
                            title="{{ $chatbotText['send'] }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 2L11 13"/>
                            <path d="M22 2L15 22L11 13L2 9L22 2Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            @if ($chatbotPoweredBy)
                <div class="ai-chatbot-footer">
                    {{ $chatbotText['powered'] }}
                    <span style="font-weight:600;">{{ $chatbotPoweredBy }}</span>
                </div>
            @endif
        </section>

        <button type="button"
                class="ai-chatbot-launcher"
                data-chatbot-open
                aria-label="{{ $chatbotText['open'] }}: {{ $chatbotText['name'] }}">
            <span class="ai-chatbot-launcher-art">
                <img class="ai-chatbot-launcher-img"
                     src="{{ $chatbotLauncherImage }}"
                     alt="{{ $chatbotText['name'] }}"
                     onerror="this.parentNode.style.display='none';this.closest('button').querySelector('.ai-chatbot-launcher-fallback').style.display='flex';">
                <span class="ai-chatbot-launcher-text-bg" aria-hidden="true"></span>
            </span>

            <span class="ai-chatbot-launcher-fallback" style="display:none;" aria-hidden="true">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </span>
        </button>
    </div>

    <script>
        (function () {
            'use strict';

            var root = document.getElementById('ai-chatbot-root');
            if (!root) return;

            if (root.parentNode !== document.documentElement) {
                document.documentElement.appendChild(root);
            }

            var windowEl    = root.querySelector('.ai-chatbot-window');
            var launcher    = root.querySelector('[data-chatbot-open]');
            var closeBtn    = root.querySelector('[data-chatbot-close]');
            var minimizeBtn = root.querySelector('[data-chatbot-minimize]');
            var messagesEl  = root.querySelector('[data-chatbot-messages]');
            var inputEl     = root.querySelector('[data-chatbot-input]');
            var sendBtn     = root.querySelector('[data-chatbot-send]');

            var botAvatar     = root.dataset.avatar || '';
            var generation    = 0;

            var CHAT_API_URL         = 'https://chat.orangebd.com/ngoab/api/v1/chat';
            var HEALTH_API_URL       = CHAT_API_URL.replace(/\/chat$/, '/health');
            var STATUS_CHECK_TIMEOUT = 5000;
            var STATUS_POLL_INTERVAL = 15000;
            var sessionId            = null;
            var serverOnline         = true;
            var statusTimer          = null;

            var websiteLanguageKey = 'main-website-language';
            var translations  = @json($chatbotCopy);

            function getCopy() {
                return translations[root.dataset.locale] || translations.bn;
            }

            function newSessionId() {
                if (window.crypto && typeof window.crypto.randomUUID === 'function') {
                    return window.crypto.randomUUID();
                }
                return 'sess-' + Date.now().toString(36) + '-' + Math.random().toString(36).slice(2, 10);
            }

            function applyServerStatus() {
                var copy = getCopy();
                var statusEl = root.querySelector('.ai-chatbot-title-status');
                root.dataset.server = serverOnline ? 'online' : 'offline';
                if (statusEl) {
                    statusEl.textContent = serverOnline ? copy.online : copy.offline;
                }
            }

            function setServerOnline(isOnline) {
                isOnline = !!isOnline;
                if (serverOnline === isOnline) return;
                serverOnline = isOnline;
                applyServerStatus();
            }

            async function checkServerStatus() {
                var controller = (typeof AbortController === 'function') ? new AbortController() : null;
                var timer = setTimeout(function () {
                    if (controller) controller.abort();
                }, STATUS_CHECK_TIMEOUT);

                try {
                    var res = await fetch(HEALTH_API_URL, {
                        method: 'GET',
                        cache: 'no-store',
                        headers: { 'Accept': 'application/json' },
                        signal: controller ? controller.signal : undefined
                    });
                    setServerOnline(res.status < 500);
                } catch (e) {
                    setServerOnline(false);
                } finally {
                    clearTimeout(timer);
                }
            }

            function startStatusPolling() {
                stopStatusPolling();
                checkServerStatus();
                statusTimer = setInterval(checkServerStatus, STATUS_POLL_INTERVAL);
            }

            function stopStatusPolling() {
                if (statusTimer) {
                    clearInterval(statusTimer);
                    statusTimer = null;
                }
            }

            function syncChatbotLanguage(nextLanguage) {
                var copy = translations[nextLanguage] || translations.bn;

                root.dataset.locale = nextLanguage;

                windowEl.setAttribute('aria-label', copy.name + ' ' + copy.chat);
                root.querySelector('.ai-chatbot-title-name').textContent = copy.title;
                applyServerStatus();

                inputEl.placeholder = copy.placeholder;
                inputEl.setAttribute('aria-label', copy.message);

                sendBtn.setAttribute('aria-label', copy.send);
                sendBtn.title = copy.send;

                minimizeBtn.setAttribute('aria-label', copy.minimize);
                minimizeBtn.title = copy.minimize;

                closeBtn.setAttribute('aria-label', copy.close);
                closeBtn.title = copy.close;

                launcher.setAttribute('aria-label', copy.open + ': ' + copy.name);
                launcher.querySelector('.ai-chatbot-launcher-img').src = copy.launcher;

                var initialMessages = root.querySelectorAll('.ai-chatbot-message-row.bot .ai-chatbot-message');
                if (initialMessages.length === 1 && !root.querySelector('.ai-chatbot-message-row.user')) {
                    initialMessages[0].textContent = copy.welcome;
                }

                var footer = root.querySelector('.ai-chatbot-footer');
                if (footer && footer.firstChild) {
                    footer.firstChild.textContent = copy.powered + ' ';
                }

                root.style.visibility = 'visible';
            }

            function openChat() {
                root.dataset.open = 'true';
                windowEl.style.display = 'flex';
                launcher.style.display = 'none';

                startStatusPolling();

                setTimeout(function () {
                    inputEl.focus();
                    scrollToBottom();
                }, 80);
            }

            function hideChat() {
                root.dataset.open = 'false';
                windowEl.style.display = 'none';
                launcher.style.display = 'block';
                stopStatusPolling();
                launcher.focus();
            }

            function resetChat() {
                generation++;
                sessionId = null;

                messagesEl.innerHTML = '';
                inputEl.value = '';
                inputEl.style.height = 'auto';
                sendBtn.disabled = false;

                addMessage(getCopy().welcome, 'bot');
            }

            function closeChat() {
                hideChat();
                resetChat();
            }

            function scrollToBottom() {
                requestAnimationFrame(function () {
                    messagesEl.scrollTop = messagesEl.scrollHeight;
                });
            }

            function getTime() {
                return new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function createAvatar(isUser) {
                var avatar = document.createElement('div');
                avatar.className = 'ai-chatbot-msg-avatar ' + (isUser ? 'user' : 'bot');

                if (isUser) {
                    avatar.innerHTML =
                        '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
                            '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>' +
                            '<circle cx="12" cy="7" r="4"/>' +
                        '</svg>';
                } else {
                    var img = document.createElement('img');
                    img.src = botAvatar;
                    img.alt = '';
                    avatar.appendChild(img);
                }

                return avatar;
            }

            function addMessage(message, type) {
                var isUser = type === 'user';

                var row = document.createElement('div');
                row.className = 'ai-chatbot-message-row ' + (isUser ? 'user' : 'bot');

                var wrap = document.createElement('div');
                wrap.className = 'ai-chatbot-message-wrap';

                var bubble = document.createElement('div');
                bubble.className = 'ai-chatbot-message ' + (isUser ? 'user' : 'bot');
                bubble.textContent = String(message);

                var time = document.createElement('div');
                time.className = 'ai-chatbot-time';
                time.textContent = getTime();

                wrap.appendChild(bubble);
                wrap.appendChild(time);

                if (isUser) {
                    row.appendChild(wrap);
                    row.appendChild(createAvatar(true));
                } else {
                    row.appendChild(createAvatar(false));
                    row.appendChild(wrap);
                }

                messagesEl.appendChild(row);
                scrollToBottom();
            }

            function showTyping() {
                var row = document.createElement('div');
                row.className = 'ai-chatbot-message-row bot';
                row.dataset.typing = 'true';

                var wrap = document.createElement('div');
                wrap.className = 'ai-chatbot-message-wrap';

                var bubble = document.createElement('div');
                bubble.className = 'ai-chatbot-message bot';
                bubble.innerHTML =
                    '<div class="ai-chatbot-typing">' +
                        '<span></span><span></span><span></span>' +
                    '</div>';

                wrap.appendChild(bubble);
                row.appendChild(createAvatar(false));
                row.appendChild(wrap);

                messagesEl.appendChild(row);
                scrollToBottom();
            }

            function removeTyping() {
                var typing = messagesEl.querySelector('[data-typing="true"]');
                if (typing) typing.remove();
            }

            function resizeInput() {
                inputEl.style.height = 'auto';
                inputEl.style.height = Math.min(inputEl.scrollHeight, 100) + 'px';
            }

            async function sendMessage() {
                var message = inputEl.value.trim();
                if (!message || sendBtn.disabled) return;

                addMessage(message, 'user');

                inputEl.value = '';
                inputEl.style.height = 'auto';
                sendBtn.disabled = true;

                var gen = generation;
                showTyping();

                try {
                    if (!sessionId) sessionId = newSessionId();

                    var response = await fetch(CHAT_API_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            query: message,
                            session_id: sessionId
                        })
                    });

                    setServerOnline(response.ok);

                    if (gen !== generation) return;

                    removeTyping();

                    if (!response.ok) {
                        throw new Error('Request failed: ' + response.status);
                    }

                    var data = await response.json();

                    if (gen !== generation) return;

                    var reply = getCopy().unknown;

                    if (data && typeof data.answer === 'string' && data.answer.trim() !== '') {
                        reply = data.answer;
                    }

                    if (data && typeof data.session_id === 'string' && data.session_id) {
                        sessionId = data.session_id;
                    }

                    addMessage(reply, 'bot');

                } catch (error) {
                    console.error('Chatbot error:', error);

                    if (!response) setServerOnline(false);

                    if (gen !== generation) return;

                    removeTyping();
                    addMessage(getCopy().error, 'bot');

                } finally {
                    if (gen === generation) {
                        sendBtn.disabled = false;
                        inputEl.focus();
                    }
                }
            }

            window.addEventListener('main-website-language-change', function (event) {
                syncChatbotLanguage(event.detail.language);
            });

            launcher.addEventListener('click', openChat);
            closeBtn.addEventListener('click', closeChat);
            minimizeBtn.addEventListener('click', hideChat);
            sendBtn.addEventListener('click', sendMessage);
            inputEl.addEventListener('input', resizeInput);

            inputEl.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey && !e.isComposing) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && root.dataset.open === 'true') {
                    hideChat();
                }
            });

            syncChatbotLanguage(localStorage.getItem(websiteLanguageKey) === 'bn' ? 'bn' : 'en');
            addMessage(getCopy().welcome, 'bot');
        })();
    </script>