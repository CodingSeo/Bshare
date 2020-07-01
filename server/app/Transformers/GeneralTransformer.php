<?php
class GeneralTransformer{
    //decorated pattern
    protected function successFormat(){

    }
    protected function errorFormat(){

    }
    protected function createFormat(){

    }
    protected function noContentFormat(){

    }
// 200 - Ok                                // 성공
// 201 - Created                           // 새로운 리소스 생성 요청에 대한 응답
// 204 - No Content                        // 리소스 삭제 요청 성공 등에 사용
// 304 - Not Modified                      // 클라이언트에 캐시된 리소스 대비 서버 리소스의 변경이 없을 때
// 400 - Bad Request                       // 클라이언트 쪽에서 뭔가 잘못했을 때
// 401 - Unauthorized                      // 인증 필요 (실제로는 Unauthenticated 의 의미)
// 403 - Forbidden                         // 권한 부족 (실제로는 Unauthorized 의 의미)
// 404 - Not Found                         // 요청한 리소스가 없을 때
// 405 - Method Not Allowed                // 서버에 없는 Endpoint 일 때
// 406 - Not Acceptable                    // Accept* 헤더 또는 본문의 내용이 수용할 수 없을 경우
// 409 - Conflict                          // 기존 리소스와 충돌
// 410 - Gone                              // 404 가 아니라, 리소스가 삭제되어 응답을 줄 수 없을 경우
// 422 - Unprocessable Entity,             // 유효성 검사 오류 등에 사용
// 429 - Too Many Requests,                // Rate Limit 에 걸렸을 경우
// 500 - Internal Server Error             // 서버 쪽 오류
// 503 - Service Unavailable               // 점검 등으로 서버가 일시적으로 응답할 수 없는 경우
}
