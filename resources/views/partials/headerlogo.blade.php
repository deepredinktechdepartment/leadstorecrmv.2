<div class="header-left d-flex">
<div class="logo">
<a href="{{ url('/dashboard') }}" class="">
@php
use App\Models\Themeoptions;
$theme_options_data = Themeoptions::get()->first();
$licence_id = auth()->user()->licence_id ?? 0;
$logo = ($theme_options_data && !empty($theme_options_data->header_logo) ) ? URL::to($theme_options_data->header_logo) : URL::to('assets/uploads/default_logo.png');
// If the selected logo is empty or null, use another default image
if (empty($logo)) {
$logo = URL::to('assets/uploads/default_logo.png');
}
@endphp
<img src="https://leadstore.in/clientlogos/2017-12-04_(1).png" alt="Intranet" class="img-fluid"  />
</a>
</div>
<a href="#" class="sidebarCollapse" id="toggleSidebar" data-placement="bottom">
<i class="fa-solid fa-bars-staggered"></i>
</a>
</div>
