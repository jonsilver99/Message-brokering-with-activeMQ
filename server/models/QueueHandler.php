<?php
// this class subscribes to, parses and returns all unread messages from an activeMQ queue

class QueueHandler extends StaticClass
{
    private static $Broker_uri = 'tcp://localhost:61613';
    private static $Queue = '/queue/notes';
    private static $NewNotes = [];

    public static function readNewMessages()
    {
        // establish AMQ connection
        $stomp = new Stomp(self::$Broker_uri, 'admin', 'admin');
        // subscribe to queue
        $stomp->subscribe(self::$Queue, array('ack' => 'client'));

        // while there are unread messages on queue - read and parse them 
        while ($stomp->hasFrame()) {

            $frame = $stomp->readFrame();

            if ($frame) {
                self::parseNewNote($frame->body);
                $stomp->ack($frame);
                sleep(1);
            }

        }
        // disconnect AMQ
        unset($stomp);
        
        // return unread, parsed messages
        return self::$NewNotes;
    }

    private static function parseNewNote($noteData)
    {
        array_push(self::$NewNotes, json_decode($noteData));
    }
}