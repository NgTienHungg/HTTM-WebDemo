<?php
class Sample
{
    private $id;
    private $name;
    private $audioId;
    private $transcriptId;
    private $date;
    private $lastUpdate;

    private $audioName;
    private $transcriptContent;

    public function __construct($id, $audioName, $transcriptContent)
    {
        $this->id = $id;
        $this->audioName = $audioName;
        $this->transcriptContent = $transcriptContent;
    }

    // public function __construct($id, $name, $audioId, $transcriptId, $date, $lastUpdate)
    // {
    //     $this->id = $id;
    //     $this->name = $name;
    //     $this->audioId = $audioId;
    //     $this->transcriptId = $transcriptId;
    //     $this->date = $date;
    //     $this->lastUpdate = $lastUpdate;
    // }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAudioId()
    {
        return $this->audioId;
    }

    public function getTranscriptId()
    {
        return $this->transcriptId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function getAudioName()
    {
        return $this->audioName;
    }

    public function getTranscriptContent()
    {
        return $this->transcriptContent;
    }
}

?>