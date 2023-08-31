  <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>ダッシュボード</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#notification-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-newspaper"></i><span>お知らせ</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="notification-nav" class="nav-content collapse @if(strpos(url()->current(), "notification") == true && strpos(url()->current(), "board") == False) show @endif" data-bs-parent="#sidebar-nav">
        <li>
        <a href="{{ route('notification-index') }}">
          <i class="bi bi-circle"></i><span>お知らせ全部</span>
        </a>
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('enquete-index') }}">
        <i class="ri-survey-line"></i>
        <span>アンケート一覧</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#rule-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-ruled"></i><span>管理規約・使用細則</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="rule-nav" class="nav-content collapse @if(strpos(url()->current(), "rule") == true && strpos(url()->current(), "board") == False) show @endif" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('rule-index', 'manage') }}">
            <i class="bi bi-circle"></i><span>管理規約</span>
          </a>
        </li>
        <li>
          <a href="{{ route('rule-index', 'handbook') }}">
            <i class="bi bi-circle"></i><span>使用細則</span>
          </a>
        </li>
        <li>
          <a href="{{ route('rule-index', 'car') }}">
            <i class="bi bi-circle"></i><span>駐車場使用細則</span>
          </a>
        </li>
        <li>
          <a href="{{ route('rule-index', 'bike') }}">
            <i class="bi bi-circle"></i><span>駐輪場使用細則</span>
          </a>
        </li>
        <li>
          <a href="{{ route('rule-index', 'delivery_box') }}">
            <i class="bi bi-circle"></i><span>宅配ボックス使用細則</span>
          </a>
        </li>
        <li>
          <a href="{{ route('rule-index', 'meeting_room') }}">
            <i class="bi bi-circle"></i><span>集会室使用細則</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('board-index') }}">
        <i class="bi bi-circle"></i>
        <span>役員</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('general_meeting-index') }}">
        <i class="bi bi-circle"></i>
        <span>総会資料・議事録</span>
      </a>
    </li>
    @can('board')
      <hr>
      @include('common.board')
    @endcan
  </ul>
</aside><!-- End Sidebar-->
