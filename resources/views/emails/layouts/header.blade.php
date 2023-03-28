<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $email_data_object->subject ?? '' }} - {{ config('app.name') }}</title>
  </head>
  <body>
    <style media="screen">
      html { margin: 0; padding: 0; }
      body {
        background: #f5f7fa;
        font-size: 16px; font-family: sans-serif;
        margin: 0; padding: 0;
        display: flex; justify-content: center;
        padding: 25px 0px;
        color:#181f2c;
      }
      h1, h2, h3, h4 { margin: 0; padding: 0; }
      h3 { font-size: 25px; margin-bottom: 10px; }
      h4 { font-size: 19px; margin-bottom: 15px; }
      table { background: #fff; border-radius: 2px; max-width: 94vw; width: 550px; box-shadow: 0px 3px 7px 0px #00000014; }
      tr#kr-email-header > td { text-align: center; padding: 15px 0px; }
      tr#kr-email-header > td > img { width: 220px; max-width: 90%; }
      tr#kr-email-maintext > td, #kr-email-footertext > td { padding: 15px; }
      tr#kr-email-button > td { text-align: center; padding: 25px 0px; }
      tr#kr-email-button > td > a {
        text-decoration: none;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.2);
        outline: 0; background: #28a745; border: 1px solid #28a745; font-size: 16px;
        border-radius: 2px; padding: 12px 25px; color:#fff;
      }
      p { line-height: 21px; margin: 0; padding: 0; }
    </style>
    <table>
      <tr id="kr-email-header">
        <td><img src="{{ url("/uploads/1634999271.png") }}" title="{{ config('app.name') }}"/></td>
      </tr>