<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Termwind\Components\Raw;

class CheckoutController extends Controller
{

    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }


    //melakukan request order dan menciptakan link payment
    public function bayar(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $quantity = $request->input('quantity');
        $currency_code = $request->input('currency_code');
        $value = $request->input('value');

        $url = 'https://api-m.sandbox.paypal.com/v2/checkout/orders'; // Ganti dengan URL produksi jika sudah siap
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withBasicAuth($clientId, $clientSecret)->post($url, [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "items" => [
                        [
                            "name" => $name,
                            "description" => $description,
                            "quantity" => $quantity,
                            "unit_amount" => [
                                "currency_code" => $currency_code,
                                "value" => $value
                            ]
                        ]
                    ],
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $value,
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => $value
                            ]
                        ]
                    ]
                ]
            ],
            "application_context" => [
                //jika pembayaran berhasil alihkan ke route return karena paypal membawa nilai token pada /return
                //otomatis memanggil method cekpayment dan mengkonfirmasi nya
                "return_url" =>  route('return'),
                "cancel_url" => "https://example.com/cancel"
            ]
        ]);

        $responseData = json_decode($response->getBody()->getContents()); // Menggunakan getBody() getContent() untuk mendapatkan isi respons JSON.
        $redirectUrl = collect($responseData->links)->where('rel', 'approve')->first()->href; 

        //Simpan data ke DB transaksi

        transaksi::create([
            'id_inv' => $responseData->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'currency_code' => $request->input('currency_code'),
            'value' => $request->input('value'),
            'status' => 'created'
        ]);

        //arahkan ke link pembayaran yang di ektraksi dari respon
        return redirect($redirectUrl);
    }

    //menampilkan keterangan sudah dibayar atau belum (proses update menajadi approve terjadi otomatis saat user melakukan transfer)
    public function cekpayment(Request $request)
    {
        $orderId =  $request->query('token');
        $orderUrl = "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}";
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withBasicAuth($clientId, $clientSecret)->get($orderUrl);

        // Ambil status pembayaran dari respons
        $paymentStatus = data_get($response->json(), 'status', '');

        if ($paymentStatus === 'APPROVED') {

            //DB statusnya menjadi Approve berdasarkan IDtransksi/TOKEN yang ada
            transaksi::where('id_inv', $orderId)->update(['status' => 'Approve']);

            echo "<span style='font-size: 180px;'>Pembayaran Telah Berhasil!</span>";
        } else {
            echo "Pembayaran Gagal atau Belum Dilakukan status masih :" . $paymentStatus;
        }
    }


    //menampilkan detail orderan terkini seperti status ,nama orang yang transfer dll
    public function detail($orderId)
    {
        $orderUrl = "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}";
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withBasicAuth($clientId, $clientSecret)->get($orderUrl);

        $result = $response->json();

        // Tampilkan detail pesanan
        dd($result);
    }
}
