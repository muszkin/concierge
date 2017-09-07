<?php

class Agents extends ApiAbstract
{
    const BASE_URL = "/agents";

    public function getAgents()
    {
        $this->setUrl(self::BASE_URL);
        $this->setMethod("GET");
        return $this->doRequest();
    }

    /**
     * @param $agent
     * @return Agent
     */
    public function getAgentInfo($agent)
    {
        $this->setUrl(self::BASE_URL."/{$agent}");
        $this->setMethod("GET");
        $result = $this->doRequest();
        $agent = $this->serializer->deserialize($result,Agent::class,'json');
        return $agent;
    }

    public function getAgentLastCall($agent)
    {
        $this->setUrl(self::BASE_URL."/{$agent}/last_queue_connection");
        $this->setMethod("GET");
        return $this->doRequest();
    }

    public function getAgentsStatuses()
    {
        $this->setUrl(self::BASE_URL."_statuses");
        $this->setMethod("GET");
        return $this->doRequest();
    }

    public function addAgent($agent)
    {
        $this->setUrl(self::BASE_URL);
        $this->setMethod("POST");
        $this->setFormParams($agent);
        return $this->doRequest();
    }



}