<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/invoice.css"/>
    <style>

        table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.invoiceContainer {
  padding: 1rem;
}
.logoinvoice {
  display: flex;
  justify-content: space-between;
  line-height: normal;
  flex-wrap: wrap
}
p {
  font-size: 1rem;
  line-height: 0.3;
}
.senderadd {
  margin-top: 2rem;
  margin-bottom: 3rem;
}

.description{
    line-height:1.5;
}
@media print {
  th {
    border: 1px solid #858383;
  }
  tr:nth-child(even) {
    background-color: #faf6f6;
  }

  .invoiceContainer {
    color: black;
  }
}

    </style>
    <title>Document</title>
</head>
<body>


       <div class="invoiceContainer">
        {{-- <h1>{{$data[0]["subject"]}}</h1>
            <h2>{{$data[0]["body"]}}</h2> --}}
        <div class="logoinvoice">
          <div>
            <img src="/NewWavelogo.jpg" alt="new wave logo" />
          </div>
          <div>
            <div>
              <h1>Invoice</h1>
            </div>
            <p>TIN # {{$data[0]["invoice_tin"]}}</p>
            <p>INVOICE {{$data[0]["invoice_id"]}}</p>
            {{-- <p>DATE: {{$data[0]["moment().format("lll")"]}}</p> --}}
            <p>DATE: {{$data[0]["service_states_end_date"]}}</p>

          </div>
        </div>
        <div>
          <div>
            <p>{{$data[0]["invoice_company_name"]}}</p>
            <p>{{$data[0]["invoice_address"]}}</p>
            <p>{{$data[0]["invoice_pobox"]}}</p>
            <p>{{$data[0]["invoice_phonenumber"]}}</p>
            <p>{{$data[0]["invoice_email"]}}</p>
          </div>
          <div class="senderadd">
            <h3>INVOICE:</h3>
            <p>{{$data[0]["client_name"]}}</p>
            <p>{{$data[0]["client_address"]}}</p>
            <p>{{$data[0]["client_pobox"]}}</p>
            <p>{{$data[0]["client_email"]}}</p>
          </div>
        </div>
        <div>
          <table>
            <tr>
              <th>QUANTITY</th>
              <th>DESCRIPTION</th>
              <th>UNIT PRICE (UGX)</th>
              <th>TOTAL (UGX)</th>
            </tr>
            <tr>
              <td>{{$data[0]["service_states_quantity"]}}</td>
              <td>{{$data[0]["service_states_description"]}}</td>
              <td>{{$data[0]["service_states_price"]}}</td>
              <td>
               {{ (int)$data[0]["service_states_quantity"] *
                  (int)$data[0]["service_states_price"] }}
              </td>
            </tr>
            <tr>
              <td rowspan="3" colspan="2">
                PAYMENT
              </td>
              <td>SUBTOTAL</td>
              <td>

                {{ (int)$data[0]["service_states_quantity"] *
                  (int)$data[0]["service_states_price"] }}
              </td>
            </tr>
            <tr>
              <td>TAX ({{$data[0]["service_states_tax"]}}% VAT)</td>
              <td>
               {{((int)$data[0]["service_states_tax"] / 100) *
                   (int)$data[0]["service_states_price"] }}
              </td>
            </tr>
            <tr>
              <td>TOTAL DUE</td>
              <td>
                {{(int)$data[0]["service_states_quantity"] *
                  (int)$data[0]["service_states_price"] +
                  ((int)$data[0]["service_states_tax"] / 100) *
                    (int)$data[0]["service_states_price"]}}
              </td>
            </tr>
            <tr>
              <td colspan="4">
                <div>
                  <h1>Note</h1>
                  <p class="description">{{$data[0]["invoice_note"]}}</p>

                </div>
              </td>
            </tr>
            <tr>

              <td colspan="4">
                <center>Thank you for your business!</center>
              </td>
            </tr>
          </table>
        </div>
      </div>


</body>
</html>
