<?php

interface ValidateInterface
{

    public function validateCreate();

    public function validateCheck();

    public function verify();

    public function recover();

    public function validateUpdate();

    public function confirm();
}
