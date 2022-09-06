<?php
// GENERATED CODE -- DO NOT EDIT!

namespace RefundService;

/**
 */
class RefundServiceStub {

    /**
     * @param \RefundService\RefundRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \RefundService\RefundResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function refundRequest(
        \RefundService\RefundRequest $request,
        \Grpc\ServerContext $context
    ): ?\RefundService\RefundResponse {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Get the method descriptors of the service for server registration
     *
     * @return array of \Grpc\MethodDescriptor for the service methods
     */
    public final function getMethodDescriptors(): array
    {
        return [
            '/RefundService.RefundService/refundRequest' => new \Grpc\MethodDescriptor(
                $this,
                'refundRequest',
                '\RefundService\RefundRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
        ];
    }

}
