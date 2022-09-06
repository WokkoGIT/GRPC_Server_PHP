<?php
// GENERATED CODE -- DO NOT EDIT!

namespace RefundService;

/**
 */
class GreetingServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \RefundService\HelloRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function greeting(\RefundService\HelloRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/RefundService.GreetingService/greeting',
        $argument,
        ['\RefundService\HelloResponse', 'decode'],
        $metadata, $options);
    }

}
