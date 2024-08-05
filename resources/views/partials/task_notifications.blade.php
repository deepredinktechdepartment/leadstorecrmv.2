@php

    $totalCount= $totalCount??0;
@endphp
<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <span class="badge bg-danger">{{ $totalCount > 0 ? $totalCount : '' }}</span>
        </a>

        @if ($totalCount > 0)
        <ul class="dropdown-menu dropdown-menu-end notification-menu" aria-labelledby="notificationDropdown">
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=not_started,started&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">5 tasks pending</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=rework&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">2 tasks rework</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=internally approved,approved&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">3 tasks approved</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=completed&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">1 tasks completed</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=in_review&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">4 tasks in review</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=scheduled&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">6 tasks scheduled</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('tasks?type=mytasks&actionWidget=headerNavAlert&status=sent_to_client&start_date=' . $lastLoginDate . '&end_date=' . $currentDate) }}">7 tasks sent to client</a></li>
        </ul>
        @endif
    </li>
</ul>
