<form action="{{ route('checkout.place') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
  @csrf

  {{-- بيانات من البروفايل --}}
  <input type="text" class="form_control" value="{{ $user->name }}" readonly>
  <input type="email" class="form_control" value="{{ $user->email }}" readonly>
  <input type="text" class="form_control" value="{{ $user->phone }}" readonly>
  <input type="text" class="form_control" value="{{ $user->address }}" readonly>

  <input type="hidden" name="payment_method" id="payment_method" value="bank">

  {{-- زر يفتح المودال --}}
  <button type="button" class="theme-btn style-one" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    {{ app()->getLocale()=='en' ? 'Place Order' : 'تأكيد الطلب' }}
  </button>

  {{-- مودال الدفع (نفس تصميمك) --}}
  @include('front.partials.checkout-payment-modal')
</form>
