<?php
// GENERATED CODE -- DO NOT EDIT!

namespace RefundService;

/**
 */
class RefundServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \RefundService\RefundRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function refundRequest(\RefundService\RefundRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/RefundService.RefundService/refundRequest',
        $argument,
        ['\RefundService\RefundResponse', 'decode'],
        $metadata, $options);
    }

}
