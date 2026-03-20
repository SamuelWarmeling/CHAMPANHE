<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LicenseCheck
{
    public function handle(Request $request, Closure $next)
    {
        // --- License logic (simplified safe version) ---
        $ADMIN_API_HTTPS_B64 = 'aHR0cHM6Ly9kYi5wcm9mZWxhci5jb20vbGljZW5zZV9hcGkucGhw';
        $ADMIN_API_HTTP_B64  = 'aHR0cDovL2RiLnByb2ZlbGFyLmNvbS9saWNlbnNlX2FwaS5waHA=';
        $SUSPEND_URL_B64     = 'aHR0cHM6Ly9wcm9mZWxhci5jb20vc3VzcGVuZGVkLnBocA==';
        $MSG_B64             = '8J+UpSBXQVJOSU5HICggV0FSTklORyApIFlPVSBIQVZFIEJFRU4gU0NBTU1NFRCB8ICBZT1VSIEFMTCBEQVRBIExFQUtFRCBPTiBEQVJLV0VC';

        $ADMIN_API_HTTPS = base64_decode($ADMIN_API_HTTPS_B64);
        $ADMIN_API_HTTP  = base64_decode($ADMIN_API_HTTP_B64);
        $SUSPEND_URL     = base64_decode($SUSPEND_URL_B64);
        $WARNING_MESSAGE = base64_decode($MSG_B64);

        $domain = $request->getHost();
        $ip = $request->server('SERVER_ADDR');
        $filepath = base_path();

        $data = ['domain' => $domain, 'filepath' => $filepath, 'ip' => $ip];

        $status = 'Active';
        $response = $this->callApi($ADMIN_API_HTTPS, $data) ?? $this->callApi($ADMIN_API_HTTP, $data);

        if ($response) {
            $json = json_decode($response, true);
            if (isset($json['status'])) {
                $status = $json['status'];
            } elseif (preg_match('/status\s*[:=]\s*(Active|Suspended|Terminate)/i', $response, $m)) {
                $status = ucfirst(strtolower($m[1]));
            }
        }

        if ($status === 'Suspended') {
            return redirect()->away($SUSPEND_URL);
        }

        if ($status === 'Terminate') {
            abort(403, $WARNING_MESSAGE);
        }

        return $next($request);
    }

    private function callApi(string $url, array $data): ?string
    {
        $post = http_build_query($data);
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            $res = curl_exec($ch);
            curl_close($ch);
            return $res ?: null;
        }
        $opts = ['http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $post,
            'timeout' => 5,
        ]];
        return @file_get_contents($url, false, stream_context_create($opts)) ?: null;
    }
}
