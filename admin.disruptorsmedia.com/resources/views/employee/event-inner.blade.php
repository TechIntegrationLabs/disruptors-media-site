@extends('employee/partials/master')
@section('content')

		<section class="secEvtInner secWithNav">
			<div class="container-fluid">
            @include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="bord_box half_bord">
							<div class="evtBox">
								<h4>Event 1  - McDonalds</h4>
								<h2>Sed ut <br>perspiciatis</h2>
								<div class="dt">20 <br> 23</div>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</p>
								<div class="evt_list_type">
									<h5>Event 1  - McDonalds</h5>
									<p>5 November   -   Monday</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="bord_box half_bord">
							<div class="evt_time">
								<div id="countdown">
							    <ul>
							      <li><span id="days"></span>days</li>
							      <li><span id="hours"></span>Hours</li>
							      <li><span id="minutes"></span>Minutes</li>
							      <li><span id="seconds"></span>Seconds</li>
							    </ul>
							  </div>
							</div>
							<div class="evt_vector">
								<img src="{{asset('front/assets/images/evt_vector.png')}}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script type="text/javascript">
			(function () {
  const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

  //I'm adding this section so I don't have to keep updating this pen every year :-)
  //remove this if you don't need it
  let today = new Date(),
    dd = String(today.getDate()).padStart(2, "0"),
    mm = String(today.getMonth() + 1).padStart(2, "0"),
    yyyy = today.getFullYear(),
    nextYear = yyyy,
    dayMonth = "11/30/",
    birthday = dayMonth + yyyy;

  today = mm + "/" + dd + "/" + yyyy;
  if (today > birthday) {
    birthday = dayMonth + nextYear;
  }
  //end

  const countDown = new Date(birthday).getTime(),
    x = setInterval(function () {
      const now = new Date().getTime(),
        distance = countDown - now;

      (document.getElementById("days").innerText = Math.floor(distance / day)),
        (document.getElementById("hours").innerText = Math.floor(
          (distance % day) / hour
        )),
        (document.getElementById("minutes").innerText = Math.floor(
          (distance % hour) / minute
        )),
        (document.getElementById("seconds").innerText = Math.floor(
          (distance % minute) / second
        ));

      //do something later when date is reached
      if (distance < 0) {
        document.getElementById("headline").innerText = "It's my birthday!";
        document.getElementById("countdown").style.display = "none";
        document.getElementById("content").style.display = "block";
        clearInterval(x);
      }
      //seconds
    }, 0);
})();
		</script>

@endsection