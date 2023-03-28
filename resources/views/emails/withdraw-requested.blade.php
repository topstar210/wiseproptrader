@include('emails.layouts.header')
  <tr id="kr-email-maintext">
    <td>
      <h3>Hi, {{ $email_data_object->user_name ?? '' }} !</h3>
      <h4>Withdraw request confirmation is needed!</h4>
      <p>Please, confirm your request by clicking on the link just bellow.</p>
    </td>
  </tr>
  <tr id="kr-email-button">
    <td>
      <a href="{{ url("/confirm-withdraw/{$email_data_object->confirm_id}") }}">Confirm withdraw</a>
    </td>
  </tr>
@include('emails.layouts.footer')