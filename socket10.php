<?php
class Socket {
	public $response=NULL;
	public $from="";
	public $port=0;
	public $host='78.46.64.50';
	public $socket_port='5060';	
    /**
     * Domain type to use when creating the socket
     * @var int
     */
     public $domain = AF_INET;
    /**
     * The stream type to use when creating the socket
     * @var int
     */
    public $type = SOCK_STREAM;
    /**
     * The protocol to use when creating the socket
     * @var int
     */
    public $protocol = SOL_UDP;

    /**
     * Stores a reference to the created socket
     * @var Resource
     */
    private $link = null;
    /**
     * Array of connected children
     * @var array
     */
    private $threads = array();
    /**
     * Bool which determines if the socket is listening or not
     * @var boolean
     */
    private $listening = false;

    /**
     * Creates a new Socket.
     *
     * @param array $args
     * @param int $args[domain] AF_INET|AF_INET6|AF_UNIX
     * @param int $args[type] SOCK_STREAM|SOCK_DGRAM|SOCK_SEQPACKET|SOCK_RAW|SOCK_UDM
     * @param int $args[protocol] SOL_TCP|SOL_UDP
     * @return Socket
     */
    public function __construct(array $args = null) {
        // Default socket info
        $defaults = array(
            "domain" => AF_INET,
            "type" => SOCK_DGRAM,
            "protocol" => 17
        );
        
        // Merge $args in to $defaults
        $args = array_merge($defaults,$args);

        // Store these values for later, just in case
        $this->domain = $args['domain'];
        $this->type = $args['type'];
        $this->protocol = $args['protocol'];

        if(($this->link = socket_create($this->domain, $this->type, $this->protocol)) === false) {
		//	if(($this->link = socket_create(AF_INET, SOCK_STREAM, SOL_UDP)) === false) {
         //   throw new SocketException("Unable to create Socket. PHP said, " . $this->getLastError(), socket_last_error());
         echo "Hata\n";
        }
        if(socket_bind($this->link,$this->host,$this->socket_port)==false)
        echo "Hata2\n";
        
        if(!socket_set_option($this->link, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>7,"usec"=>0)))
        echo "Hata3\n";
        
        if(!socket_set_option($this->link, SOL_SOCKET, SO_SNDTIMEO, array("sec"=>5,"usec"=>0)))
        echo "Hata4\n";
        
$data=
"REGISTER sip:opensips.org SIP/2.0
Via: SIP/2.0/UDP 78.46.64.50:5060;branch=z9hG4bK532328;rport=41124
To: ataybur <sip:ataybur@78.46.64.50>
From: ataybur <sip:ataybur@78.46.64.50>;tag=63660
Call-ID: 4bfcf05ffddec1e8832eb0dc3dcb9f42@78.46.64.50
CSeq: 20 REGISTER
Contact: <sip:ataybur@78.46.64.50>
Authorization: Digest username='ataybur@78.46.64.50', realm='78.46.64.50', nonce='4e144cf596a50ab6248681d01a9ded568d8f7de7', uri='ataybur@78.46.64.50', response='75a06d1c513bd6f58b82288e76a6cbc1', algorithm=MD5
Expires: 7200
Contact-Length: 0
	
";
//Proxy-Authorization: Digest username='kutadgu@opensips.org', realm='opensips.org', nonce='4e0da492a34ff42d045fab0319aa161a44efe534', uri='ataybur@opensips.org', response='f79c6d2282cc3f4b06a32faebcaaae06', algorithm=MD5
        if(!socket_sendto($this->link, $data, strlen($data), 0, $this->host,$this->socket_port))
        echo "Hata5\n";
        $from="";
        $port=0;
         if (!socket_recvfrom($this->link, $this->response, 10000, 0, $this->from, $this->port))
         echo "Hata6\n";
    }

    public function getResponse(){
		echo $this->response;
		}
}

$defaults = array(
"domain" => AF_INET,
"type" => SOCK_DGRAM,
"protocol" => 17
);
                       
$deneme=new Socket($defaults);
$deneme->getResponse();
?>
