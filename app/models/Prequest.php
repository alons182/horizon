<?php

class Prequest extends Eloquent {
	 public function property()
    {
        return $this->belongsTo('Property');
    }
}
