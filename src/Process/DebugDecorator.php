<?php

declare(strict_types=1);

namespace BitWasp\PinEntry\Process;

class DebugDecorator implements ProcessInterface
{
    /**
     * @var ProcessInterface
     */
    private $process;

    public function __construct(ProcessInterface $process)
    {
        $this->process = $process;
    }

    public function close(): bool
    {
        echo sprintf("%s()\n", __METHOD__);
        return $this->process->close();
    }

    public function recv(): string
    {
        $recv = $this->process->recv();
        return $recv;
    }

    public function waitFor(string $text)
    {
        echo sprintf("%s(%s)\n", __METHOD__, trim($text));
        $recv = $this->process->waitFor($text);
        echo sprintf("%s(%s) received\n%s\n", __METHOD__, trim($text), $recv);
        return $recv;
    }

    public function send(string $data)
    {
        echo sprintf("%s(%s)\n", __METHOD__, trim($data));
        $send = $this->process->send($data);
        return $send;
    }
}
