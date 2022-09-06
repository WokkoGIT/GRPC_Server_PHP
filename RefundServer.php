<?php

require dirname(__FILE__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

class RefundService_server extends \RefundService\RefundServiceStub
{
    public function greeting(
        \RefundService\HelloRequest $request,
        \Grpc\ServerContext $serverContext
    ): ?\RefundService\HelloResponse {
        $this->clientInfoToConsole($request);
        $response = new \RefundService\HelloResponse();
        $response->setGreeting("Response from server to client: " . $request->getName());
        return $response;
    }

    public function refundRequest(\RefundService\RefundRequest $refundRequest, \Grpc\ServerContext $serverContext): ?\RefundService\RefundResponse {
        $refundResponse = new \RefundService\RefundResponse();
        if ($this->validKeyChecker($refundRequest)) /*Сравниваем хэши клиента и хэш из доверенного ключа сервера */ {
            echo "\nАвторизация клиента ".$refundRequest->getName().": успешно\n";
            if ($this->refundServiceImplementation($refundRequest)) /*Ожидаем ответа от имплементации возврата платежа*/{
                $refundResponse->setRefundResponse("\nТранзакция "
                    .$refundRequest->getTxid()." успешно возвращена на указанный для возврата адрес "
                    .$refundRequest->getRefundAddress().". \n");
            } else $refundResponse->setRefundResponse("\nВозникли проблемы при возврате, убедитесь в корректности введенных данных\n");
        } else $refundResponse->setRefundResponse("\nНет соответствующего доступа для возврата транзакции.\n");
        return $refundResponse;
    }

    private function clientInfoToConsole(\RefundService\HelloRequest $request){
        echo    "Информация о клиенте:\n\n".
            "Client name: ".$request->getName()."\n".
            "Client txid: ".$request->getTxid()."\n".
            "Client refund Address: ".$request->getRefundAddress()."\n".
            "Client orderID: ".$request->getOrderID()."\n".
            "Client userID:".$request->getUserID()."\n";
    }

    private function refundServiceImplementation (\RefundService\RefundRequest $refundRequest): ?bool {
        //Возвращаем платеж клиента, при успехе возвращаем 0, при проблеме - 1;
        return true;
    }

    private function validKeyChecker (\RefundService\RefundRequest $request): ?bool {
        $key = md5(getenv("TRUSTED_SECRET_KEY").$request->getUnixTime(), false);
        if ($request->getAccessHash()==$key) return true;
        else return false;
    }
}

$server = new \Grpc\RpcServer();
$server->addHttp2Port('0.0.0.0:8083');
$server->handle(new RefundService_server());
$server->run();
