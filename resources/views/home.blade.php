@extends('layouts.main')
@section('title','Royal Hotel')
@section('custom-css')
<style>
  .heading p{
    font-size:20px;
    text-align:justify
  }
  .text h2{
    font-size:28px;
  }
  .text p{
    font-size:17px;
    text-align:justify;
  }
  .content span{
    font-size:20px;
  }

</style>
@endsection
@section('content')
<section class="home" id="home">
    <div class="head_container">
      <div class="box">
        <div class="text">
          <h1>Hello.Salut.Hola</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
          <button>MORE INFO</button>
        </div>
      </div>
      <div class="image">
        <img src="{{asset('home/image/home1.jpg')}}" class="slide">
      </div>
      <div class="image_item">
        <img src="{{asset('home/image/home1.jpg')}}" alt="" class="slide active" onclick="img('home/image/home1.jpg')">
        <img src="{{asset('home/image/home2.jpg')}}" alt="" class="slide" onclick="img('home/image/home2.jpg')">
        <img src="{{asset('home/image/home3.jpg')}}" alt="" class="slide" onclick="img('home/image/home3.jpg')">
        <img src="{{asset('home/image/home4.jpg')}}" alt="" class="slide" onclick="img('home/image/home4.jpg')">
      </div>
    </div>
  </section>
  <script>
    function img(anything) {
      document.querySelector('.slide').src = anything;
    }

    function change(change) {
      const line = document.querySelector('.image');
      line.style.background = change;
    }
  </script>
  <section class="book">
    <div class="container flex">
      <div class="input grid">
        <div class="box">
          <label>Check-in:</label>
          <input type="date" placeholder="Check-in-Date">
        </div>
        <div class="box">
          <label>Check-out:</label>
          <input type="date" placeholder="Check-out-Date">
        </div>
        <div class="box">
          <label>Adults:</label> <br>
          <input type="number" placeholder="0">
        </div>
        <div class="box">
          <label>Children:</label> <br>
          <input type="number" placeholder="0">
        </div>
      </div>
      <div class="search">
        <input type="submit" value="SEARCH">
      </div>
    </div>
  </section>
  <section class="about top" id="about">
    <div class="container flex">
      <div class="left">
        <div class="img">
          <img src="{{asset('home/image/a1.jpg')}}" alt="" class="image1">
          <img src="home/image/a2.jpg" alt="" class="image2">
        </div>
      </div>
      <div class="right">
        <div class="heading">
          <h5>RAISING COMFOMRT TO THE HIGHEST LEVEL</h5>
          <h2>Welcome to Royal Hotel Resort</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <button class="btn1">READ MORE</button>
        </div>
      </div>
    </div>
  </section>
  <section class="wrapper top">
    <div class="container">
      <div class="text">
        <h2>Our Amenities</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

        <div class="content">
          <div class="box flex">
            <i class="fas fa-swimming-pool"></i>
            <span>Swimming pool</span>
          </div>
          <div class="box flex">
            <i class="fas fa-dumbbell"></i>
            <span>Gym & yogo</span>
          </div>
          <div class="box flex">
            <i class="fas fa-spa"></i>
            <span>Spa & massage</span>
          </div>
          <div class="box flex">
            <i class="fas fa-ship"></i>
            <span>Boat Tours</span>
          </div>
          <div class="box flex">
            <i class="fas fa-swimmer"></i>
            <span>Surfing Lessons</span>
          </div>
          <div class="box flex">
            <i class="fas fa-microphone"></i>
            <span>Conference room</span>
          </div>
          <div class="box flex">
            <i class="fas fa-water"></i>
            <span>Diving & smorking</span>
          </div>
          <div class="box flex">
            <i class="fas fa-umbrella-beach"></i>
            <span>Private Beach</span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="room top" id="room">
    <div class="container">
      <div class="heading_top flex1">
        <div class="heading">
          <h5>RAISING COMFORT TO THE HIGHEST LEVEL</h5>
          <h2>Rooms $ Suites</h2>
        </div>
        <div class="button">
          <button class="btn1" onclick="window.location.href = '/bookingRoom';">VIEW ALL</button>
        </div>
      </div>

      <div class="content grid">
        <div class="box">
          <div class="img">
            <img src="{{asset('home/image/r1.jpg')}}" alt="">
          </div>
          <div class="text">
            <h3>Superior Soble Rooms</h3>
            <p> <span>$</span>129 <span>/per night</span> </p>
          </div>
        </div>
        <div class="box">
          <div class="img">
            <img src="{{asset('home/image/r2.jpg')}}" alt="">
          </div>
          <div class="text">
            <h3>Superior Soble Rooms</h3>
            <p> <span>$</span>129 <span>/per night</span> </p>
          </div>
        </div>
        <div class="box">
          <div class="img">
            <img src="{{asset('home/image/r3.jpg')}}" alt="">
          </div>
          <div class="text">
            <h3>Superior Soble Rooms</h3>
            <p> <span>$</span>129 <span>/per night</span> </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="wrapper wrapper2 top">
    <div class="container">
      <div class="text">
        <div class="heading">
          <h5>AT THE HEART OF COMMUNICATION</h5>
          <h2>People Say</h2>
        </div>

        <div class="para">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

          <div class="box flex">
            <div class="img">
              <img src="{{asset('home/image/c.jpg')}}" alt="">
            </div>
            <div class="name">
              <h5>KATE PALMER</h5>
              <h5>IDAHO</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="restaurant top" id="restaurant">
    <div class="container flex">
      <div class="left">
        <img src="{{asset('home/image/re.jpg')}}" alt="">
      </div>
      <div class="right">
        <div class="text">
          <h2>Our Restaurant</h2>
          <p> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="accordionWrapper">
          <div class="accordionItem open">
            <h2 class="accordionIHeading">Italian Kitchen</h2>
            <div class="accordionItemContent">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="accordionItem close">
            <h2 class="accordionIHeading">Mexican Kitchen</h2>
            <div class="accordionItemContent">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="accordionItem close">
            <h2 class="accordionIHeading">Italian Kitchen</h2>
            <div class="accordionItemContent">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
          <div class="accordionItem close">
            <h2 class="accordionIHeading">Mexican Kitchen</h2>
            <div class="accordionItemContent">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    var accItem = document.getElementsByClassName('accordionItem');
    var accHD = document.getElementsByClassName('accordionIHeading');

    for (i = 0; i < accHD.length; i++) {
      accHD[i].addEventListener('click', toggleItem, false);
    }

    function toggleItem() {
      var itemClass = this.parentNode.className;
      for (var i = 0; i < accItem.length; i++) {
        accItem[i].className = 'accordionItem close';
      }
      if (itemClass == 'accordionItem close') {
        this.parentNode.className = 'accordionItem open';
      }
    }
  </script>
  <section class="gallary mtop " id="gallary">
    <div class="container">
      <div class="heading_top flex1">
        <div class="heading">
          <h5>WELCOME TO OUR PHOTO GALLERY</h5>
          <h2>Photo Gallery of Our Hotel</h2>
        </div>
        <div class="button">
          <button class="btn1">VIEW GALLERY</button>
        </div>
      </div>
      <div class="owl-carousel owl-theme">
        <div class="item">
          <img src="{{asset('home/image/g1.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g2.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g3.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g4.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g5.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g6.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g7.jpg')}}" alt="">
        </div>
        <div class="item">
          <img src="{{asset('home/image/g8.jpg')}}" alt="">
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      dots: false,
      navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        1000: {
          items: 4
        }
      }
    })
  </script>
@endsection