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
        if ($refundRequest->getAccessKey()==getenv("TRUSTED_SECRET_KEY")) /*Сравниваем ключ клиента и доверенный ключ сервера */ {
            echo "\nАвторизация клиента ".$refundRequest->getName().": успешно\n";
            if ($this->refundServiceImplementation($refundRequest)==0) /*Ожидаем ответа от имплементации возврата платежа*/{
                $refundResponse->setRefundResponse("\nТранзакция "
                    .$refundRequest->getTxid()." успешно возвращена на указанный для возврата адрес "
                    .$refundRequest->getRefundAddress().". \n");
            } else $refundResponse->setRefundResponse("\nВозникли проблемы при возврате, убедитесь в корректности введенных данных\n");
        } else $refundResponse->setRefundResponse("\nНет соответствующего доступа для возврата транзакции.\n");
        return $refundResponse;
    }

    public function clientInfoToConsole(\RefundService\HelloRequest $request){
        echo    "Информация о клиенте:\n\n".
            "Client name: ".$request->getName()."\n".
            "Client txid: ".$request->getTxid()."\n".
            "Client refund Address: ".$request->getRefundAddress()."\n".
            "Client orderID: ".$request->getOrderID()."\n".
            "Client userID:".$request->getUserID()."\n";
    }

    private function refundServiceImplementation (\RefundService\RefundRequest $refundRequest): ?int {
        //Возвращаем платеж клиента, при успехе возвращаем 0, при проблеме - 1;
        return 0;
    }
}

$server = new \Grpc\RpcServer();
$server->addHttp2Port('0.0.0.0:8080');
$server->handle(new RefundService_server());
$server->run();
