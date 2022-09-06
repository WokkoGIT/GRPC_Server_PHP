<?php
// GENERATED CODE -- DO NOT EDIT!

namespace RefundService;

/**
 */
class GreetingServiceStub {

    /**
     * @param \RefundService\HelloRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \RefundService\HelloResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function greeting(
        \RefundService\HelloRequest $request,
        \Grpc\ServerContext $context
    ): ?\RefundService\HelloResponse {
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
            '/RefundService.GreetingService/greeting' => new \Grpc\MethodDescriptor(
                $this,
                'greeting',
                '\RefundService\HelloRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
        ];
    }

}
