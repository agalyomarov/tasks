 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Панель управления</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Илья Даниленок</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 <li class="nav-item">
                     <a href="{{ route('PhotoController.index') }}" class="nav-link">
                         <i class="nav-icon far fa-calendar-alt"></i>
                         <p>
                             Рабочий стол
                             <span class="badge badge-info right">2</span>
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('main') }}" class="nav-link">
                         <i class="nav-icon far fa-calendar-alt"></i>
                         <p>
                             Хошин Матрица
                             <span class="badge badge-info right">2</span>
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Конструктор
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="/category" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     + Цели
                                     <span class="badge badge-info right">7</span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="/category/create" class="nav-link">
                                 <i class="nav-icon "></i>
                                 <p>
                                     Создать цель
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('tacticIndex') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     Задачи
                                     <span class="badge badge-info right">8</span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('tacticCreate') }}" class="nav-link">
                                 <i class="nav-icon "></i>
                                 <p>
                                     Создат задачу
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('projectIndex') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     + Проект
                                     <span class="badge badge-info right">25</span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('projectCreate') }}" class="nav-link">
                                 <i class="nav-icon "></i>
                                 <p>
                                     Создать проект
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('memberIndex') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     + Человек
                                     <span class="badge badge-info right">6</span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('memberCreate') }}" class="nav-link">
                                 <i class="nav-icon "></i>
                                 <p>
                                     Добавить человек
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/strategy" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     + Результат
                                     <span class="badge badge-info right">6</span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="/strategy/create" class="nav-link">
                                 <i class="nav-icon "></i>
                                 <p>
                                     Создат результат
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="{{ route('x5.index') }}" class="nav-link">
                                 <i class="nav-icon far fa-plus-square"></i>
                                 <p>
                                     Сотрудники
                                     <span class="badge badge-info right">4</span>
                                 </p>
                             </a>
                         </li>
                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             CatchBall
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('viewpanel.index') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     Обзорная панель
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('MailController.index') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     Почтовый ящик
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('category.index') }}" class="nav-link">
                                 <i class="nav-icon fas fa-chart-pie"></i>
                                 <p>
                                     Kanban карты
                                     <span class="badge badge-info right"></span>
                                 </p>
                             </a>
                         </li>









         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
 <script src="{{ asset('admin/admin.js') }}"></script>
