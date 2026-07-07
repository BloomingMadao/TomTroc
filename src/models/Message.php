<?php

class Message
{
    private ?int $id;
    private int $idConversation;
    private int $idSender;
    private string $message;
    private string|DateTime $dateCreate;
}