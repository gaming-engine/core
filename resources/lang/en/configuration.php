<?php
return [
    "exceptions" => [
        "invalid-property" => "The key \":key\" was found for category \":category\" but no matching value was found in the configuration object.",
        "invalid-value" => "The specified value (:value) for the key \":key\" does not match the actual type it is supposed to be.",
        "locked" => "Attempted to update the default value for \":key\" to \":value\", but the configurations are currently locked.  Are you trying to set the running value?",
    ],
];
