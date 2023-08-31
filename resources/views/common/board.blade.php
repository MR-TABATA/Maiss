<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#user-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>組合員管理</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="user-board-nav" class="nav-content collapse @if(strpos(url()->current(), "user") == true && strpos(url()->current(), "board") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('users-list-board') }}">
        <i class="bi bi-circle"></i><span>一覧</span>
      </a>
    </li>
    @can('chairman')
    <li>
      <a href="{{ route('user-register-board') }}">
        <i class="bi bi-circle"></i><span>新規登録</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#notification-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>お知らせ管理</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="notification-board-nav" class="nav-content collapse @if(strpos(url()->current(), "notification") == true && strpos(url()->current(), "board") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('notification-index-board') }}">
        <i class="bi bi-circle"></i><span>一覧</span>
      </a>
    </li>
    @can('chairman')
    <li>
      <a href="{{ route('notification-show-register-board') }}">
        <i class="bi bi-circle"></i><span>新規登録</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#enquete-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>アンケート管理</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="enquete-board-nav" class="nav-content collapse @if(strpos(url()->current(), "enquete") == true && strpos(url()->current(), "board") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('enquete-index-board') }}">
        <i class="bi bi-circle"></i><span>一覧</span>
      </a>
    </li>
    @can('chairman')
    <li>
      <a href="{{ route('enquete-show-register-board') }}">
        <i class="bi bi-circle"></i><span>新規登録</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#rule-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>管理規約・使用細則</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="rule-board-nav" class="nav-content collapse @if(strpos(url()->current(), "rule") == true && strpos(url()->current(), "board") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('rule-index-board', 'manage') }}">
        <i class="bi bi-circle"></i><span>管理規約</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-index-board', 'handbook') }}">
        <i class="bi bi-circle"></i><span>使用細則</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-index-board', 'car') }}">
        <i class="bi bi-circle"></i><span>駐車場使用細則</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-index-board', 'bike') }}">
        <i class="bi bi-circle"></i><span>駐輪場使用細則</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-index-board', 'delivery_box') }}">
        <i class="bi bi-circle"></i><span>宅配ボックス使用細則</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-index-board', 'meeting_room') }}">
        <i class="bi bi-circle"></i><span>集会室使用細則</span>
      </a>
    </li>
    <li>
      <a href="{{ route('rule-import-export-board') }}">
        <i class="bi bi-circle"></i><span>CSVインポート・エクスポート</span>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#board-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>役員管理</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="board-board-nav" class="nav-content collapse @if(strpos(url()->current(), "board_member") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('board-index-board') }}">
        <i class="bi bi-circle"></i><span>一覧</span>
      </a>
    </li>
    <li>
      <a href="{{ route('board-show-register-board') }}">
        <i class="bi bi-circle"></i><span>新規登録</span>
      </a>
    </li>
  </ul>
</li>


<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#general_meeting-board-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-file-ruled"></i><span>総会・資料・議事録</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="general_meeting-board-nav" class="nav-content collapse @if(strpos(url()->current(), "general_meeting") == true && strpos(url()->current(), "board") == true) show @endif" data-bs-parent="#sidebar-nav">
    <li>
      <a href="{{ route('general_meeting-index-board') }}">
        <i class="bi bi-circle"></i><span>一覧</span>
      </a>
    </li>
    @can('chairman')
    <li>
      <a href="{{ route('general_meeting-show-register-board') }}">
        <i class="bi bi-circle"></i><span>新規登録</span>
      </a>
    </li>
    @endcan
  </ul>
</li>

