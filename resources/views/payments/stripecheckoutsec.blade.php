@extends('layouts.app')

@section('meta')
    <meta id="csrfToken" name="csrf-token" content="{{csrf_token()}}">
@endsection

@section('content')
  <div class="checkout" style="height: 100vh; display:grid; place-items: center;">
    <button id="checkoutBtn" class="btn btn-success">Checkout</button>
  </div>


  <script>

      const checkoutBtn = document.getElementById("checkoutBtn");

      const csrfToken = document.getElementById("csrfToken");

      const csrf = csrfToken.getAttribute("content");

      checkoutBtn.addEventListener("click", async e => {
          alert("ok")
         try {
            const req = await fetch('/stripe/s/checkout', {
              method: "post",
              body: JSON.stringify({
                _token: csrf,
              }),

            body: JSON.stringify({_token: csrf}),

             headers: {
                "Content-Type": "application/json"
             },

          });

          const json = await req.json();

        //  console.log(json);

        window.location = json.url;

         } catch (error) {
             console.log(error);
         }
      });

  </script>
@endsection