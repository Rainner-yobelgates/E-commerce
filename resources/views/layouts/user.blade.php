<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- fontawesome -->
  <link rel="stylesheet" href="/fontawesome/css/all.min.css">

  <!-- Owlcarousel -->
  <link rel="stylesheet" href="/plugins/owlcarousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="/plugins/owlcarousel/dist/assets/owl.theme.default.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="/css/user.css">

  <!-- DataTable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

  <!-- IziToast -->
  <link rel="stylesheet" href="/plugins/izitoast/dist/css/iziToast.min.css">
  <script src="/plugins/izitoast/dist/js/iziToast.min.js" type="text/javascript"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Revarvealt</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.products') }}">Product</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach(categories() as $category)
              <li><a class="dropdown-item" href="{{ route('home.category', $category->slug) }}">{{$category->name}}</a></li>
              @endforeach
            </ul>
          </li>

          <li class="nav-item">
            @if(session()->get('cart') == null)
            <a class="nav-link text-light" href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i><span class="badge bg-success">0</span></a>
            @else
            <a class="nav-link text-light" href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i><span class="badge bg-success">{{count(session()->get('cart'))}}</span></a>
            @endif
          </li>
        </ul>
        <div class="d-none d-lg-block ms-auto">
          <form class="d-flex justify-content-between" action="{{ route('home.products') }}" method="get">
            <input class="srch form-control me-2" name="search" autocomplete="off" type="search" placeholder="Type To Search" aria-label="Search">
            <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>

            <div class="box shadow-sm" style="display: none;">
              <div class="search-h5 container" style="overflow: hidden;">
                <h5 class="text-light mt-2"><i class="bi bi-search"></i> "<span class="text"></span>"</h5>
              </div>
              <h6 class="search-link text-light rounded"></h6>
            </div>
          </form>
        </div>

        <ul>
          <li class="nav-item dropdown">
            <a class="nav-link p-0 dropdown-toggle" style="margin-top: 10px;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="/image/user/profile/user.png" style="object-fit: cover; width: 35px;" alt="">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(Auth::check())
              <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
              <li><a class="dropdown-item" href="{{ route('transaction') }}">Transaction</a></li>
              <li><a class="dropdown-item" href="{{ route('transaction.history') }}">History</a></li>
              <li><a class="dropdown-item" href="{{ route('payment.confirm') }}">Confirm Payment</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Log Out</a></li>
              @else
              <li><a class="dropdown-item text-success" href="{{ route('login') }}">Log In</a></li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- content -->
  @yield('content')
  <!-- footer -->
  <div class="footer mt-3">
    <div class="bg-light py-5 footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h6 class="text-bold">OVERVIEW</h6>
            <a href="" class="nav-link px-0 pt-0">About</a>
            <a href="" class="nav-link px-0 pt-0">Cart</a>
            <a href="" class="nav-link px-0 pt-0">Cara Belanja</a>
          </div>
          <div class="col-lg-6">
            <h6 class="text-bold">CONNECT WITH US</h6>
            <a href="mailto:revarvealt@gmail.com" class="nav-link px-0 pt-0">revarvealt@gmail.com</a>
            <a href="https://wa.me/6287720641120" class="nav-link px-0 pt-0">+62 877 2064 1120</a>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-dark text-white py-4 footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            Copyright &copy; {{ date('Y') }} Revarvealt &middot; All Right Reserved
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <!-- Owlcarousel -->
  <script src="/plugins/owlcarousel/dist/owl.carousel.min.js"></script>
  <script src="/plugins/owlcarousel/dist/setting.js"></script>

  <!-- DataTable -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

  @yield('script')
  <!-- Owlcarousel -->
  <script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      items: 6,
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 6,
          loop: true
        }
      }
    });
    $('.play').on('click', function() {
      owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function() {
      owl.trigger('stop.owl.autoplay')
    })
  </script>
  <!-- DataTable -->
  <script>
    $(document).ready(function() {
      $('.dataTable').DataTable({
        fixedHeader: true
      });
    });
  </script>

  <!-- Cart -->
  <script>
    $('.update-cart').change(function() {
      let id = $(this).data("id");
      let amount = $(this).val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/cart/update/amount',
        data: {
          id: id,
          amount: amount
        },
        type: 'patch',
        success: function(res) {
          window.location.reload();
        }
      })
    })
    $(".remove-from-cart").click(function(e) {
      let id = $(this).data("id");
      console.log(id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      if (confirm("Are you sure want to remove?")) {
        $.ajax({
          url: '/cart/delete',
          type: 'delete',
          data: {
            id: id
          },
          success: function(response) {
            window.location.reload();
          }
        });
      }
    });
  </script>

  <!-- Search -->
  <script>
    $('.srch').keyup(function() {
      $('.text').text($(this).val())
      if ($(this).val() == '') {
        $('.box').css('display', 'none');
      } else {
        $('.box').css('display', 'block');
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{ route('search') }}",
        data: 'keyword=' + $(this).val(),
        method: 'post',
        datatype: 'html',
        success: function(res) {
          console.log(res)
          $('.search-link').html(res)
        }
      })
    })
  </script>
</body>

</html>