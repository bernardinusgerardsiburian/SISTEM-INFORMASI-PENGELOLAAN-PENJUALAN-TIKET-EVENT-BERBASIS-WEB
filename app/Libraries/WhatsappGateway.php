<?php
namespace App\Libraries;

use Exception;
use zepson\Whatsapp\WhatsappClass;

class WhatsappGateway{
    private $client;
    private $apikey;
    private $headers;
    private $endpoint;


    public function __construct()
    {
//        $this->client = \Config\Services::curlrequest(['verify' => false]);

        $this->apikey = 'IWFrcdgQeOi5';
        $this->token = 'EAAv0pBsbUZBABAO6BpVcMgURxZCepMn95kQGYv4OA6co8syMxu0aZBZAIBLVztR2F11LeRFJIBe4rWSBxho69tgGC1NUuDgZAef4EvmKnSDcVZCSHOR0hZCiq2LSte5JHLwzk3DUfOAKMv7XSSLtOv8gwQgdUbuaZCYMwzQngZB2OPX5ZBYQbRKYQa';
        $this->client = new WhatsappClass('103269859368424', $this->token);
//        $this->endpoint = 'https://whatsva.com/api';
    }

    public function setApiKey(string $apikey){
        $this->apikey = $apikey;
    }

    public function setHeaders(array $headers){
        $this->headers = $headers;
    }

    public function setEndpoint(string $endpoint){
        $this->endpoint = $endpoint;
    }

    private function sendRequest($method,$url,array $json){
        $option = [
            'headers'=>$this->headers,
            'json'=>$json,
        ];
        return json_decode($this->client->request($method,$url,$option)->getBody(),true);
    }

//    function sendMessage(string $no,string $message){
//        $json = [
//            'apikey'=>$this->apikey,
//            'jid'=>$no,
//            'message'=>$message
//        ];
//        return $this->sendRequest('POST',$this->endpoint.'/sendMessageText',$json);
//    }

    function sendMessage(string $no,string $message){
        if($no[0]==0){
            $no = '62'.substr($no, 1);
        }
        return $this->client->send_message($message, $no);
    }


    function sendNotifTunggakan(string $no,string $nama,string $tunggakan, string $bulan){
        if($no[0]==0){
            $no = '62'.substr($no, 1);
        }
        
        $component = [
            [
                "type"=>"body",
                "parameters"=>[
                    [
                        "type"=>"text",
                        "text"=>$nama
                    ],
                    [
                        "type"=>"text",
                        "text"=>$tunggakan
                    ],
                    [
                        "type"=>"text",
                        "text"=>$bulan
                    ],
                ]
            ]
        ];
        return $this->client->send_template('pengingat_tunggakan ',$no,"id",$component);
    }

    function sendNotifKonfirmasi(string $no,string $kode, string $url){
        if($no[0]==0){
            $no = '62'.substr($no, 1);
        }
        
        $component = [
            [
                "type"=>"body",
                "parameters"=>[
                    [
                        "type"=>"text",
                        "text"=>$kode
                    ],
                    [
                        "type"=>"text",
                        "text"=>$url
                    ]
                ]
            ]
        ];
        return $this->client->send_template('pembayaran_dikonfirmasi ',$no,"id",$component);
    }

    function sendNotifBatal(string $no,string $kode, string $url){
        if($no[0]==0){
            $no = '62'.substr($no, 1);
        }
        
        $component = [
            [
                "type"=>"body",
                "parameters"=>[
                    [
                        "type"=>"text",
                        "text"=>$kode
                    ],
                    [
                        "type"=>"text",
                        "text"=>$url
                    ]
                ]
            ]
        ];
        return $this->client->send_template('pembayaran_batal ',$no,"id",$component);
    }

   
    function sendMessages(array $arrno,string $message){
        foreach($arrno as $no){
            try{
                $this->sendMessage($no,$message);
            }catch (Exception $e){}
        }
    }

}