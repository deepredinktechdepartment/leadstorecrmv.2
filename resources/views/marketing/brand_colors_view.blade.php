@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')



<div class="row card">
<div class="col-md-12">

    <h2 class="mb-2">Primary:</h2>
    <div id="primaryColors"></div>
<hr class="mt-4">
    <h2 class="mb-2">Secondary:</h2>
    <div id="secondaryColors"></div>

    <script>
        var jsonData = @json($jsonData);

        function hexToRgb(hex) {
            // Remove the "#" symbol if it's present
            hex = hex.replace(/^#/, '');

            // Parse the HEX value to RGB components
            var bigint = parseInt(hex, 16);
            var r = (bigint >> 16) & 255;
            var g = (bigint >> 8) & 255;
            var b = bigint & 255;

            return `RGB(${r}, ${g}, ${b})`;
        }

        function displayColorsWithRgb(colorArray, containerId) {
            var container = document.getElementById(containerId);

            colorArray.forEach(function (color, index) {
                if (color) {
                    var colorBox = document.createElement("div");
                    colorBox.className = "color-box";
                    colorBox.style.backgroundColor = color;

                    var colorText = document.createElement("div");
                    colorText.className = "color-text";
                    colorText.textContent = `${color}---${hexToRgb(color)}`;

                    container.appendChild(colorBox);
                    container.appendChild(colorText);
                }
            });
        }

        displayColorsWithRgb(jsonData.primary_colors, "primaryColors");
        displayColorsWithRgb(jsonData.secondary_colors, "secondaryColors");
    </script>

    <style>
        .color-box {
            width: 30px;
            height: 30px;
            display: inline-block;
            margin-right: 5px;
            font-size:12px;
        }

        .color-text {
            display: inline-block;
            margin-right: 5px;
            color:#000;
            font-weight: 500;
            font-size:12px;
        }
    </style>


</div>
</div>








@endsection
@push('scripts')

@endpush