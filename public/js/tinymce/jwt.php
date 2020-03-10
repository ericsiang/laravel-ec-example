<?php
require '../../../vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDE8SLbSo1O35cP
4rIIcwYXFXvLVIk0ch+Ts+KdahAYWsRrT/nG3J6+RpCA6mZF4LaYRFR+vy2tg1T5
TdakEwdA53/Vmh0B8UueZ6LlA5L7s01sdj/nSz7oZc7HcXT+RDNrVg3uh4GC8T7F
Q9zpTOBv8jLqWXyQkiIhoe9K8YNTdaN81c9MKGbKMkOyos1zdS4wv2NMNnvUj4rR
36OQsTFkCw7vXAWD9NKqO0U8M2e1JRnk6IEEsCZCbaEtnPztuoBOh5JmoQKq3idz
1IXj4ZoAZw7SmluiKEaOkk+YR4RaNhFiSHckhc5bmmS4Td8tv+vBvJ+lVgSgd+UN
O2pmgsxhAgMBAAECggEBAKca1DCt+WjLXyojeFyi/K/pkrjcae8ORqzVHZvjuvRv
T+qeWZna6PcaeNJqEY2JNmXM1MUXAnMP1LIU0eM2Ihl4VIex1JspWrh1x0n61mSr
py44x9BBkIcwm1uvcU2uINMamYejgsjQWiqXgoKSsH1MTNd8Rq2E0WEoPhqhAoV0
9YX8ZjPIyitUgr3J4i3VkQA9oKoem0Wz6QBYG7UzhuvO5zg5wBGkpV3n4HRhrdhW
jrA3TdWzKn7FB4L8PpMqdxzBwv3ROw1ntWauyBikXIHQQ41aOQJcIoxzU+TAgeqg
i1M0gHwXXvCWYfoZCKUmMmiXFpYFHtYcHVzuZKoW7GECgYEA88jdy789olrIr6Uh
nCvzu/u3XeejmQBw2lQRKmEkL805n6Mx4Sp5/Q7F9kw8D8sSmjbsrvgL6AWOqQ4y
ifPBR06uH7jsOID6eEisorJ92omSAf5pmuENvVxO7WW/oP/qpsuM3EvF/i9+dPtV
r/gRmbnOZVO2Stk6JI4vKz1cKssCgYEAzs9l0cGpQe4l27Y8I0kXKY2cqOEF6m6y
KN3aIS0fpCgLuLPCws9ipGRDj0IowgwCMBjofn9lmH9QJ0OaBnrx2KhgPn5TCnlH
z11fIw62er/OSSEZobkWiSglG74hUybeodoq/w5o/iKoBeg63plPMUudpjR5lcgA
RJkRnc9FZAMCgYEA0rzoJrI6CHgsFdJM3KEOAInXeGC+hovgAow7joQM8RmaX4qG
mtvKOlyj+obqQMjOWutx7MrWGAt9yFxSifhiM08rrJaB9VJhsss4GSjtLJZR1lFk
XxN/ehsqy4NyhS3VXbyGFwWVsWbDDUMbTpPGOzpo1iToZ4mi/mi/E8TmQMMCgYAI
xctv5mMjpNJ+S3CpnoQZAyTOFR2HIEL2cNK77YoWEIzOvPFaCioJByfGf+vyr0e4
epYCJ61Llrrzr25tL/HqWtoaTImBPDvLlA5hElKzSkeZ2omXzp4iG03Xq20GdfOj
sfl48EeL4DR4a61zm9U8JhT94+P0cpNwVX3lz9EFuQKBgHjWFLLhB5zic1C6+bL4
8PFcXoBKLIITvvaKXs1AieVMeIwpY2d+YWjeBZwo9sZu5xrmv9zlN5HM0ANJihXq
ruikG+9/cTcGWQPJGJ5e+vFGEhTCiIq+otuZF6xW8sKm6Ppsnxek8GJi3N0oN7A/
rkdpSEmbDjzrj/sbny20ZYs7
-----END PRIVATE KEY-----
EOD;

// NOTE: Before you proceed with the TOKEN, verify your users session or access.

$payload = array(
  "sub" => "123", // unique user id string
  "name" => "John Doe", // full name of user

  // Optional custom user root path
  // "https://claims.tiny.cloud/drive/root" => "/johndoe",

  "exp" => time() + 60 * 10 // 10 minute expiration
);

try {
  $token = JWT::encode($payload, $privateKey, 'RS256');
  http_response_code(200);
  header('Content-Type: application/json');
  echo json_encode(array("token" => $token));
} catch (Exception $e) {
  http_response_code(500);
  header('Content-Type: application/json');
  echo $e->getMessage();
}
?>