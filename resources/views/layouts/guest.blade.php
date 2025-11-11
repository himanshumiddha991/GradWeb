<!-- Set values for the header in the main file -->
@php
    $pageTitle = 'game ';
    $metaDescription = 'game';
    $metaKeywords = 'game';
@endphp
@include('website.layouts.header')
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
         

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
         @include('website.layouts.footer')
    </body>
</html>
