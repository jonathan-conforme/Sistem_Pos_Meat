<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace);font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width>=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:"*";inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:"*";inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:"*";inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:"*";inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
        <x-navbar />
  <!-- Modal -->
<section class="w-full max-w-4xl mx-auto">
  <div id="modal-postulate" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Postúlate</h3>
          <button type="button" class="text-gray-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:text-white" data-modal-hide="modal-postulate">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13l12-12" />
            </svg>
            <span class="sr-only">Cerrar</span>
          </button>
        </div>

        <!-- Modal body -->
        <form action="#" class="space-y-6 px-4 py-6">
          <div>
            <label for="nombre" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-user"></i> Nombre completo</label>
            <input type="text" id="nombre" placeholder="Juan Pérez" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
          </div>

          <div>
            <label for="email" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-envelope"></i> Correo</label>
            <input type="email" id="email" placeholder="correo@email.com" class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
          </div>

          <div>
            <label for="cv" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-file"></i> Enlace a tu CV (Google Drive, LinkedIn, etc.)</label>
            <input type="url" id="cv" placeholder="https://..." class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
          </div>

          <div>
            <label for="mensaje" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-comment-dots"></i> ¿Por qué te gustaría unirte?</label>
            <textarea id="mensaje" rows="4" placeholder="Cuéntanos brevemente..." class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
          </div>

          <!-- Modal footer -->
          <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button type="submit" class="w-full py-3 px-5 text-sm font-medium text-white bg-[#2AA4D9] hover:bg-[#1e80b4] rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Enviar postulación
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
  <section class="bg-gray-100 dark:bg-gray-900">
    <div data-aos="zoom-in-up" class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <!-- Badge destacado (puede cambiar según el enfoque) -->
        <div class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-200 rounded-full dark:bg-gray-800 dark:text-white">
            <span class="text-xs bg-[#2AA4D9] rounded-full text-white px-4 py-1.5 mr-3">🔥 Oferta</span> 
            <span class="text-sm font-medium">¡Descuento especial para proyectos universitarios!</span>
        </div>

        <!-- Título principal adaptable -->
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
           <span class="block">Soluciones de software a medida</span>
            <span class="text-[#2AA4D9]">para negocios y proyectos académicos</span>
           </h1>
        
        <!-- Subtítulo dual (negocios + académico) -->
         <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
            Creamos <strong>herramientas digitales personalizadas</strong>, desde <strong>dashboards analíticos para empresas</strong> 
            hasta <strong>plataformas tecnológicas para tesis universitarias</strong>, con asesoría experta en cada etapa.
        </p>

        <!-- Botones CTA segmentados -->
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <!-- CTA Empresas -->
            <a href="#soluciones-empresas" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-[#2AA4D9] hover:bg-[#075985] focus:ring-4 focus:ring-blue-300 transition-colors">
                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Soluciones para empresas
            </a>
            
            <!-- CTA Tesis -->
            <a href="#asesoria-tesis" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 transition-colors">
                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Asesoría para tesis
            </a>
        </div>
        </section>
</div>


        <!-- Tarjetas flotantes (hover para explicar servicios) -->
         <section id="soluciones-empresas" class="bg-white rounded-lg shadow-lg p-8 dark:bg-gray-800 dark:rounded-lg dark:shadow-lg p-10">
            <h2 class="text-3xl text-center font-bold mb-6 text-gray-900 dark:text-white">Nuestros Servicios</h2>
            <p class="mb-8 text-center text-gray-500 dark:text-gray-400">Ofrecemos una variedad de servicios diseñados para mejorar la eficiencia y competitividad de tu negocio.</p>

        <div class="grid text-center grid-cols-1 md:grid-cols-3 gap-6 px-4 mt-12">

            <!-- Tarjeta 1: Software -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
            <div class="flex justify-center mb-2">    
            <svg class="w-10 h-10 mb-2 text-[#2AA4D9]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 3 3 3 0 016 3z"></path>
                </svg>
               </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Software Personalizado</h3>

                <p class="text-gray-500 dark:text-gray-400">Sistemas para automatizar procesos empresariales o <strong>plataformas especializadas para investigación académica</strong>.</p>
</div>
            <!-- Tarjeta 2: Dashboards -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
            <div class="flex justify-center mb-2">    
            <svg class="w-10 h-10 mb-2 text-[#2AA4D9]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Dashboards Académicos</h3>
                
                <p class="text-gray-500 dark:text-gray-400">Visualización profesional de datos para tesis de ingeniería, economía o ciencias de la salud.</p>
            </div>
            
            <!-- Tarjeta 3: Web -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
            <div class="flex justify-center mb-2"> 
                 
            <svg class="w-10 h-10 mb-2 text-[#2AA4D9]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Desarrollo Web</h3>
           
                <p class="text-gray-500 dark:text-gray-400">Portales interactivos para presentar resultados de tesis o plataformas de recolección de datos.</p>
            </div>
       
<!-- Tarjeta Arduino -->
<div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow text-center">
    <div class="flex justify-center mb-2">
        <!-- Icono tipo microchip -->
        <svg class="w-10 h-10 text-[#2AA4D9]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8H8V8h8zm4-3v2m0 10v2m-4-18v2m0 14v2m-4-18v2m0 14v2m-4-18v2m0 14v2M4 5v2m0 10v2" />
        </svg>
        </div>
    <h3 class="mb-2 text-xl font-bold dark:text-white">Proyectos con Arduino</h3>

    <p class="text-gray-500 dark:text-gray-400">
        Soluciones con sensores, automatización y prototipos electrónicos para investigación o educación.
    </p>
</div>


<!-- Tarjeta 5: App Mobile -->
<div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
<div class="flex justify-center mb-2">    
<svg class="w-10 h-10 mb-2 text-[#2AA4D9]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10a1 1 0 011 1v14a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 18h2" />
    </svg>
</div>
    <h3 class="mb-2 text-xl font-bold dark:text-white">Apps Móviles</h3>
    
    <p class="text-gray-500 dark:text-gray-400">Desarrollo de aplicaciones móviles híbridas o nativas para Android y iOS con enfoque académico o empresarial.</p>
</div>

<!-- Tarjeta 6: Consultoría -->
<div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-shadow">
    <div class="flex justify-center mb-2">
        <svg class="w-10 h-10 mb-2 text-[#2AA4D9]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 16.5a2.5 2.5 0 01-2.5 2.5H5.5A2.5 2.5 0 013 16.5v-9A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9z" />
        </svg>
     </div>
    <h3 class="mb-2 text-xl font-bold dark:text-white">Consultoría Web</h3>
   
    <p class="text-gray-500 dark:text-gray-400">Asesoría técnica para universidades, grupos de investigación o emprendedores en temas de desarrollo y arquitectura web.</p>
</div>
 </div>
         </section>
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 text-center">
        <!-- Foto del fundador -->
        <img class="w-32 h-32 rounded-full mx-auto mb-4 shadow-md border"
             src="{{ asset('images/fundador.jpg') }}" 
             alt="Fundador - Tu Nombre">

        <!-- Nombre -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Tu Nombre Completo</h1>
        <p class="text-gray-500 dark:text-gray-400">Fundador & CEO</p>

        <!-- Reutilizando tu estilo --
        <!-- Descripción -->
        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
            Fundé 
            <span>
                <strong class="text-[#2AA4D9]">Guayaco</strong>
                <strong class="text-[#075985]">Dev</strong>
            </span> 
            en 2025 con la misión de crear software innovador para Ecuador y el mundo. 
            Nos enfocamos en desarrollo full stack, aplicaciones web y consultoría tecnológica.
        </p>

        <!-- Links sociales -->
        <div class="flex justify-center space-x-4 mt-6">
            <a href="https://www.linkedin.com/in/tu-perfil" target="_blank" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <i class="fab fa-linkedin mr-2"></i> LinkedIn
            </a>
            <a href="https://github.com/tu-usuario" target="_blank" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                <i class="fab fa-github mr-2"></i> GitHub
            </a>
        </div>

        <!-- Fecha de fundación -->
        <p class="mt-6 text-sm text-gray-400">
            Fundada en 2025 – Guayaquil, Ecuador
        </p>
    </div>
</div>
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 text-center">
        <img class="w-32 h-32 rounded-full mx-auto mb-4 shadow-md border"
             src="{{ asset('images/fundador.jpg') }}" 
             alt="Fundador - Tu Nombre">

        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">JONATHAN MARCELO CONFORME TOMALÁ</h1>
        <p class="text-gray-500 dark:text-gray-400">Fundador & CEO</p>

        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            En  
            <span>
                <strong class="text-[#2AA4D9] dark:text-[#2AA4D9]">Guayaco</strong>
                <strong class="text-[#075985] dark:text-gray-300">Dev</strong>
            </span> 
            ofrecemos soluciones digitales adaptadas a tus necesidades.
        </p>

        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
            Fundé 
            <span>
                <strong class="text-[#2AA4D9]">Guayaco</strong>
                <strong class="text-[#075985]">Dev</strong>
            </span> 
            en 2025 con la misión de crear software innovador para Ecuador y el mundo.
        </p>

        <div class="flex justify-center space-x-4 mt-6">
            <a href="https://www.linkedin.com/in/tu-perfil" target="_blank" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                LinkedIn
            </a>
            <a href="https://github.com/tu-usuario" target="_blank" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                GitHub
            </a>
        </div>

        <p class="mt-6 text-sm text-gray-400">Fundada en 2025 – Guayaquil, Ecuador</p>
    </div>
</div>
<section class="bg-gray-100 dark:bg-gray-900 py-12">
    <div class="max-w-6xl mx-auto text-center px-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Conoce al Fundador</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-300">
            Descubre quién está detrás de <span class="font-semibold text-[#2AA4D9]">Guayaco</span><span class="font-semibold text-[#075985]">Dev</span> y cómo empezó todo.
        </p>
        <a href="/fundador" 
           class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Leer más
        </a>
    </div>
</section>

<section class="my-12">
<div class="hero bg-gray min-h-screen">
  <div class="hero-content flex-col lg:flex-row-reverse gap-10">
    <!-- Imagen -->
    <img
      src="{{ asset('image/requerimientos.gif') }}"
      class="max-w-sm rounded-lg shadow-2xl hidden sm:block"
      alt="Equipo desarrollando software"
    />
    
    <!-- Texto -->
    <div class="max-w-xl">
      <h1 class="text-3xl font-bold mb-4">¿Como te ayudamos?</h1>
      <p class="text-lg mb-8 text-gray-600">
        Tu proyecto, nosotros lo desarrollamos por ti.  
        Sigue nuestro proceso simple y obtén resultados excepcionales.
      </p>

      <!-- Pasos -->
      <div class="space-y-6">
        <!-- Paso 1 -->
        <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
          <div class="bg-[#2AA4D9] text-white p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-7-4h8a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
</svg>

          </div>
          <div>
            <h3 class="text-xl font-semibold">1. Consultas</h3>
            <p class="text-gray-500">
              Tráenos tu requerimiento y un representante de <strong><span class="text-[#2AA4D9] dark:text-[#2AA4D9]">Guayaco</span><span class="text-[#075985] dark:text-gray-300">Dev</span></strong> te guiará paso a paso.
            </p>
          </div>
        </div>

        <!-- Paso 2 -->
        <div class="flex items-start gap-4 p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
          <div class="bg-[#2AA4D9] text-white p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 7h18M3 12h18M3 17h18" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold">2. Escoger el servicio</h3>
            <p class="text-gray-500">
              Luego de la consulta, buscamos la solución que mejor se ajuste a tus necesidades.
            </p>
          </div>
        </div>

        <!-- Paso 3 -->
        <div class="flex items-start gap-4 p-4 bg-white rounded-lg shadow hover:shadow-lg transition">
          <div class="bg-[#2AA4D9] text-white p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-semibold">3. Comienza tu proyecto</h3>
            <p class="text-gray-500">
              Una vez aprobada la propuesta, nuestro equipo se encargará de hacer realidad tu visión.
            </p>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>
</section>

<section 
    class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-8"
    x-data="{
        activo: 0,
        testimonios: [
            {
                nombre: 'Michael Gough',
                puesto: 'Desarrollador web en Google',
                imagen: 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png',
                titulo: '¡Fue una gran experiencia!',
                texto1: 'Flowbite es simplemente genial. Contiene muchísimos componentes y páginas prediseñados, desde la pantalla de inicio de sesión hasta un panel de control complejo. La opción perfecta para tu próxima aplicación SaaS.',
                texto2: 'No tengo ninguna duda de que sin Flowbite, no habría podido dar el salto a Ueno, una agencia digital que fundé en 2014. El trabajo que conseguí a través de Flowbite me permitió tener un punto de partida para seguir creciendo. Ahora tenemos unas 45 personas en nuestro equipo, muchas de las cuales encontramos y reclutamos a través de Flowbite.'
            },
            {
                nombre: 'Bonnie Green',
                puesto: 'Director ejecutivo de Facebook',
                imagen: 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png',
                titulo: 'Excelente herramienta para crecer',
                texto1: 'Flowbite es simplemente genial. Contiene muchísimos componentes y páginas prediseñados, desde la pantalla de inicio de sesión hasta un panel de control complejo. La opción perfecta para tu próxima aplicación SaaS.',
                texto2: 'No tengo ninguna duda de que sin Flowbite, no habría podido dar el salto a Ueno, una agencia digital que fundé en 2014. El trabajo que conseguí a través de Flowbite me permitió tener un punto de partida para seguir creciendo. Ahora tenemos unas 45 personas en nuestro equipo, muchas de las cuales encontramos y reclutamos a través de Flowbite.'
             },
            {
                nombre: 'Lana Byrd',
                puesto: 'Director de tecnología de Microsoft',
                imagen: 'https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/lana-byrd.png',
                titulo: 'La mejor inversión que he hecho',
               texto1: 'Flowbite es simplemente genial. Contiene muchísimos componentes y páginas prediseñados, desde la pantalla de inicio de sesión hasta un panel de control complejo. La opción perfecta para tu próxima aplicación SaaS.',
                texto2: 'No tengo ninguna duda de que sin Flowbite, no habría podido dar el salto a Ueno, una agencia digital que fundé en 2014. El trabajo que conseguí a través de Flowbite me permitió tener un punto de partida para seguir creciendo. Ahora tenemos unas 45 personas en nuestro equipo, muchas de las cuales encontramos y reclutamos a través de Flowbite.'
             }
        ]
    }"
>
      <div class="text-center lg:block lg:col-span-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">Testimonios</h1>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Lo que dicen nuestros clientes</p>
    </div>

    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
      
        <!-- Lista -->
        <div class="mr-auto place-self-center lg:col-span-4">
            <ul class="space-y-4">
                <template x-for="(t, index) in testimonios" :key="index">
                    <li @click="activo = index"
                        class="flex items-center p-4 rounded-lg cursor-pointer transition-colors duration-200"
                        :class="activo === index 
                            ? 'bg-blue-50 dark:bg-blue-900 border border-blue-300 dark:border-blue-700' 
                            : 'hover:bg-gray-100 dark:hover:bg-gray-800'">
                        <img class="w-10 h-10 rounded-full mr-4" :src="t.imagen" :alt="t.nombre">
                        <div>
                            <p class="text-sm font-semibold" x-text="t.nombre"></p>
                            <p class="text-xs text-gray-500" x-text="t.puesto"></p>
                        </div>
                    </li>
                </template>
            </ul>
        </div>

        <!-- Testimonio activo -->
        <div class="lg:col-span-8">
            <blockquote class="text-gray-500 dark:text-gray-400">
                <svg class="w-8 h-8 mb-4 text-gray-400" fill="currentColor" viewBox="0 0 24 27">
                    <path d="M14.017 18.09c0-3.078..."></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" 
                    x-text="testimonios[activo].titulo"></h3>
                <p class="mt-2" x-text="testimonios[activo].texto1"></p>
                <p class="mt-2" x-text="testimonios[activo].texto2"></p>
            </blockquote>
        </div>
        
    </div>
</section>
<section class="my-1 rounded-lg bg-gray dark:bg-gray-900 p-8" x-data="marquee()">
  <div class="overflow-hidden py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
    
    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 dark:text-white">
      Estudiantes de estas universidades confiaron en nuestros servicios
    </h2>

    <p class="text-gray-600 dark:text-gray-300 text-base sm:text-lg mb-10">
      <span class="text-[#2AA4D9] dark:text-[#2AA4D9]">Guayaco</span><span class="text-[#075985] dark:text-gray-300">Dev</span> ha realizado 
      <span id="contadorEstudiantes" class="font-bold text-blue-600">0</span> proyectos de estudiantes de titulación con CRMs, páginas web y plataformas personalizadas.
    </p>

    <!-- Carrusel de logos -->
    <div class="relative overflow-hidden">
      <div 
        class="flex gap-4 sm:gap-8 items-center"
        :style="{ transform: `translateX(${position}px)` }"
        @mouseenter="paused = true"
        @mouseleave="paused = false"
      >
        <template x-for="logo in logos" :key="logo.alt">
          <img :src="logo.src" :alt="logo.alt" class="h-10 sm:h-12 md:h-16 w-auto flex-shrink-0" />
        </template>
        <template x-for="logo in logos" :key="'dup-' + logo.alt">
          <img :src="logo.src" :alt="logo.alt" class="h-10 sm:h-12 md:h-16 w-auto flex-shrink-0" />
        </template>
      </div>
    </div>

  </div>
</section>



<section class="bg-white rounded-lg dark:bg-gray-900 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12 mt-12">
    <h2 class="mb-6 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">¿Listo para llevar tu proyecto al siguiente nivel?</h2>
    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Contáctanos hoy mismo y descubre cómo podemos ayudarte a alcanzar tus objetivos.</p>
    
<div class="flex justify-center">
<!-- Modal toggle -->
<button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block items-center text-white bg-[#2AA4D9] hover:bg-[#075985]  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Contáctanos
</button>
</div>
<!-- Main modal -->
<div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
Contáctanos                </h3>
                <button type="button" class="text-gray-400 bg-[#2AA4D9] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

      
        <form action="#" class="space-y-6 px-4 py-6">
  <div>
    <label for="email" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-at"></i> Tu correo</label>
    <input type="email" id="email" placeholder="ejemplo@email.com"
      class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required>
  </div>
<div>
  <label for="number" class="block text-left mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
    <i class="fa-brands fa-whatsapp"></i> Número
  </label>
  <div class="flex items-center bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-blue-500">
    
    <!-- Código de país -->
    <select class="bg-transparent p-3 pr-1 text-gray-900 dark:text-white text-sm border-none focus:ring-0 focus:outline-none">
     <option value="+593" selected> 🇪🇨 Ecuador (+593)</option>
        <option value="+1">🇺🇸 USA (+1)</option>
        <option value="+34">🇪🇸 España (+34)</option>
        <option value="+52">🇲🇽 México (+52)</option>
        <option value="+54">🇦🇷 Argentina (+54)</option>
        <option value="+51">🇵🇪 Perú (+51)</option>
    </select>

    <!-- Número -->
    <input
      type="tel"
      placeholder="987654321"
      class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
      required
    />

  </div>
</div>

  <div>
    <label for="message" class="block mb-1 text-left text-sm font-medium text-gray-900 dark:text-gray-300"><i class="fa-solid fa-envelope-circle-check"></i>

mensaje</label>
    <textarea id="message" rows="5" placeholder="Déjanos un mensaje..."
      class="w-full p-3 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" required></textarea>
  </div>

 


  
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                 <button type="submit"
    class="w-full py-3 px-5 text-sm font-medium text-white bg-[#2AA4D9] hover:bg-[#1e80b4] rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Enviar mensaje
  </button>  
</form>
 </div>
        </div>
    </div>
</div>
</section>


@include('components.toggle')
@include('components.footer')



        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let ejecutado = false;

        const el = document.getElementById("contadorEstudiantes");
        const target = 25;
        let count = 0;

        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting && !ejecutado) {
                ejecutado = true;
                const interval = setInterval(() => {
                    count++;
                    el.innerText = count;
                    if (count >= target) clearInterval(interval);
                }, 200);
            }
        });

        observer.observe(el);
    });
</script>
<script>
  AOS.init({
    duration: 1000, // duración de la animación en ms
    once: true      // animar solo la primera vez que aparece
  });
</script>


<script>
function marquee() {
  return {
    logos: [
      { src: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/LogoUGcolor.png/960px-LogoUGcolor.png', alt: 'UG' },
      { src: 'https://utm.edu.ec/investigacion/images/logos/logo.png', alt: 'UTM' },
      { src: 'https://webhistorico.epn.edu.ec/wp-content/uploads/2022/08/logo-epn-vertical.png', alt: 'EPN' },
      { src: 'https://www.upse.edu.ec/aulasvirtuales/educacion-continua/pluginfile.php/1/theme_moove/logo/1695242443/UPSE_LOGO-07.png', alt: 'UPSE' },
      { src: 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgYKwSEmIoDoe0iM7pVqJLn6nVStR1hkcXr0-V1ffJT3P65E8JK-OOWGd46gRT7otETHkK11M8_DelEviOX-G59b-bLimmI-QF8gSY119e7Y3mzVFHXiRBfhibQAcujUqv__10ziSC2cMY8/s1600/Logo+UNEMI+5+Estrellas.png', alt: 'UNEMI' },
      { src: 'https://www.idc-latinamerica.com/sites/default/files/2021-07/UEES%20Logo.png', alt: 'UEES' },
      { src: 'https://univercimas.com/wp-content/uploads/2021/05/Logo-de-la-Universidad-San-Francisco-de-Quito-USFQ.png', alt: 'USFQ' },
      { src: 'https://repositorio.unesum.edu.ec/image/logo-unesum.png', alt: 'UNESUM' },
    ],
    position: 0,
    speed: 0.5, // velocidad de desplazamiento
    paused: false,
    init() {
      const container = this.$el.querySelector('div');
      let marqueeWidth = container.scrollWidth / 2;

      const updateMarqueeWidth = () => {
        marqueeWidth = container.scrollWidth / 2;
      }

      window.addEventListener('resize', updateMarqueeWidth);

      const step = () => {
        if (!this.paused) {
          this.position -= this.speed;
          if (Math.abs(this.position) >= marqueeWidth) this.position = 0;
        }
        requestAnimationFrame(step);
      };
      step();
    }
  }
}
</script>
<script src="{{ asset('js/app.js') }}"></script>

    
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
