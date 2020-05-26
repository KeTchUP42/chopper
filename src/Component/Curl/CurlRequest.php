<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl;

/**
 * CurlRequest
 */
class CurlRequest implements ICurlRequest
{
    /**
     * @var string
     */
    protected const USER_AGENT = 'Mozilla/5.0 (Windows; U;Windows NT 5.1; ru; rv:1.8.0.9) Gecko/20061206 Firefox/1.5.0.9';
    /**
     * @var string[]
     */
    protected const HEADER = [
        "Accept: text/xml,application/xml,application/xhtml+xml,text/main;q=0.9,text/plain;q=0.8,image/png,image/jpeg,*/*;q=0.5",
        "Accept-Language: ru-ru,ru;q=0.7,en-us;q=0.5,en;q=0.3",
        "Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
        "Keep-Alive: 300"
    ];

    /**
     * @var
     */
    protected $ch;

    /**
     * Init curl session
     *
     * $params =
     *  [
     *    'url'         => '',
     *    'host'        => '',
     *    'header'      => '',
     *    'method'      => '',
     *    'referer'     => '',
     *    'cookie'      => '',
     *    'post_fields' => '',
     *    'timeout'     => 300,
     *    ['login'      => '',]
     *    ['password'   => '',]
     *  ];
     *
     * @param array $params
     */
    public function init(array $params): void
    {
        $this->ch = curl_init();
        $header   = self::HEADER;
        if (isset($params['host']) && $params['host']) {
            $header[] = "Host: " . $params['host'];
        }
        if (isset($params['header']) && $params['header']) {
            $header[] = $params['header'];
        }
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        if ($params['method'] === "HEAD") {
            curl_setopt($this->ch, CURLOPT_NOBODY, 1);
        }
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);
        if ($params['referer']) {
            curl_setopt($this->ch, CURLOPT_REFERER, $params['referer']);
        }
        curl_setopt($this->ch, CURLOPT_USERAGENT, self::USER_AGENT);
        if ($params['cookie']) {
            curl_setopt($this->ch, CURLOPT_COOKIE, $params['cookie']);
        }
        if ($params['method'] === "POST") {
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params['post_fields']);
        }
        curl_setopt($this->ch, CURLOPT_URL, $params['url']);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, '');

        if (isset($params['login']) & isset($params['password'])) {
            curl_setopt($this->ch, CURLOPT_USERPWD, $params['login'] . ':' . $params['password']);
        }
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $params['timeout']);
    }

    /**
     * Make curl request
     *
     * @return array
     */
    public function exec(): array
    {
        $response = curl_exec($this->ch);
        $error    = curl_error($this->ch);
        $result   = [
            'header'     => '',
            'body'       => '',
            'curl_error' => '',
            'http_code'  => '',
            'last_url'   => ''
        ];
        if ($error !== "") {
            $result['curl_error'] = $error;

            return $result;
        }

        $header_size         = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $result['header']    = substr($response, 0, $header_size);
        $result['body']      = substr($response, $header_size);
        $result['http_code'] = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $result['last_url']  = curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);

        return $result;
    }

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     */
    public function setLogFile(string $logFilePath): void
    {
        if (file_exists($logFilePath)) {
            curl_setopt($this->ch, CURLOPT_STDERR, fopen($logFilePath, 'wb+'));
            curl_setopt($this->ch, CURLOPT_VERBOSE, 1);
        }
    }
}
